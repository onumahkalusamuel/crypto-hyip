<?php

namespace App\Action\Admin;

use App\Domain\Deposits\Service\Deposits;
use App\Domain\Plans\Service\Plans;
use App\Domain\Settings\Service\Settings;
use App\Domain\User\Service\User;
use App\Helpers\SendMail;
use Slim\Routing\RouteContext;
use Symfony\Component\HttpFoundation\Session\Session;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty as View;
use App\Domain\QueuedJobs\Repository\QueuedJobsRepository;

final class NewsletterAction
{

    private $mail;
    private $plans;
    private $user;
    private $deposits;
    private $session;
    private $view;
    private $queuedJobsRepository;
    private $formToken = 'newsletter-xx';

    public function __construct(
        SendMail $mail,
        Plans $plans,
        User $user,
        Deposits $deposits,
        Session $session,
        View $view,
        Settings $settings,
        QueuedJobsRepository $queuedJobsRepository
    ) {
        $this->mail = $mail;
        $this->plans = $plans;
        $this->user = $user;
        $this->deposits = $deposits;
        $this->session = $session;
        $this->view = $view;
        $this->settings = $settings;
        $this->queuedJobsRepository = $queuedJobsRepository;
    }

    public function viewPage(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $plans = $this->plans->readAll(['select' => ['ID', 'title']]);
        $this->view->assign('plans', $plans);
        $this->view->assign('form_token', password_hash($this->formToken, PASSWORD_BCRYPT));
        $this->view->display('admin/newsletter.tpl');

        return $response;
    }

    public function addToQueue(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $flash = $this->session->getFlashBag();
        $flash->clear();

        // Get RouteParser from request to generate the urls
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        $data = (array) $request->getParsedBody();
        $message = "";

        if (empty($data['form_token']) || empty($data['to']) || empty($data['subject']) || empty($data['message'])) {
            $message = "Please provide all required data.";
        }

        // check form_token
        if (empty($message)) {
            if (!password_verify($this->formToken, $data['form_token'])) {
                $message = "A fatal error occured. Please logout and login again to retry";
            }
        }

        if (empty($message) && $data['to'] === "user" && empty($data['userName'])) {
            $message = "You must provide a username to send to user.";
        }

        if (empty($message) && $data['to'] === "user") {
            $user = $this->user->find([
                'params' => [
                    'userName' => $data['userName'],
                    'userType' => 'user'
                ]
            ]);
            if (empty($user->ID)) $message = "User with specified username not found.";
            else $singleRecipient = true;
        }

        // send to single user
        if (empty($message) && !empty($singleRecipient)) {
            $send = $this->mail->sendNewsletter($user, $data);
            if (empty($send['success'])) {
                $message = $send['message'];
            }
        }

        // add to queue if it's a group
        if (empty($message) && $data['to'] !== "user") {

            $userIds = [];

            $userIds = $allUsersIds = $depositUsersIds = $noDepositUsersIds = [];

            // all users
            $allUsers = $this->user->readAll([
                'params' => [
                    'where' => ['userType' => 'user']
                ],
                'select' => ['ID']
            ]);
            foreach ($allUsers as $u) $allUsersIds[] = $u->ID;

            // users with deposit
            $depositUsers = $this->deposits->readAll([
                'select' => ['userID'],
                'group_by' => 'userID',
                'order_by' => 'userID'
            ]);
            foreach ($depositUsers as $u)
                if (!in_array($u->userID, $depositUsersIds))
                    $depositUsersIds[] = $u->userID;

            // those without deposit
            $noDepositUsersIds = array_diff($allUsersIds, $depositUsersIds);
            $noDepositUsersIds = array_values($noDepositUsersIds);

            if ($data['to'] == "all") {
                $userIds = $allUsersIds;
            } elseif ($data['to'] == "active") {
                $userIds = $depositUsersIds;
            } elseif ($data['to'] == "inactive") {
                $userIds = $noDepositUsersIds;
            } else {
                // users that made payment for certain plans 
                $planID = explode("_", $data['to'])[1];
                $plan = $this->plans->readSingle(['ID' => $planID]);
                if (!empty($plan->ID)) {
                    $users = $this->deposits->readAll([
                        'params' => [
                            'where' => [
                                'planID' => $plan->ID,
                            ]
                        ],
                        'select' => ['userID'],
                        'group_by' => 'userID',
                        'order_by' => 'userID'
                    ]);
                    foreach ($users as $u) $userIds[] = $u->userID;
                }
            }

            // save to queue
            if (empty($userIds)) $message = "Sorry, there are no users that match the selected user group.";
            else {
                $save = $this->queuedJobsRepository->create([
                    'data' => [
                        'data' => json_encode([
                            'message' => $data['message'],
                            'subject' => $data['subject'],
                            'useGeneralHeader' => $data['useGeneralHeader'],
                            'useGeneralFooter' => $data['useGeneralFooter'],
                            'to' => implode(",", $userIds),
                            'send_list' => implode(",", $userIds)
                        ])
                    ]
                ]);

                if (empty($save)) $message = "Unable to schedule newsletter sending at the moment. Please try again later.";
            }
        }

        $url = $routeParser->urlFor('admin-newsletter');


        if (empty($message)) {
            $flash->set('success', "Newsletter sent or added to queue successfully.");
        } else {
            $flash->set('error', $message);
        }

        return $response->withStatus(302)->withHeader('Location', $url);
    }
}
