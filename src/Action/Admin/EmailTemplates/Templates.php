<?php

namespace App\Action\Admin\EmailTemplates;

use App\Domain\EmailTemplates\Service\EmailTemplates;
use App\Domain\Settings\Service\Settings;
use Slim\Routing\RouteContext;
use Symfony\Component\HttpFoundation\Session\Session;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty as View;

final class Templates
{
    private $emailTemplates;
    private $settings;
    private $view;
    private $session;

    public function __construct(
        EmailTemplates $emailTemplates,
        Settings $settings,
        View $view,
        Session $session
    ) {
        $this->emailTemplates = $emailTemplates;
        $this->settings = $settings;
        $this->view = $view;
        $this->session = $session;
    }

    public function viewPage(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $templates = $this->emailTemplates->readAll(['select' => ['ID', 'title']]);
        $generalEmailHeader = $this->settings->generalEmailHeader;
        $generalEmailFooter = $this->settings->generalEmailFooter;
        $this->view->assign('templates', $templates);
        $this->view->assign('generalEmailHeader', $generalEmailHeader);
        $this->view->assign('generalEmailFooter', $generalEmailFooter);
        $this->view->display('admin/email-templates.tpl');

        return $response;
    }

    public function updateHeaderFooter(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $flash = $this->session->getFlashBag();
        $flash->clear();
        // Get RouteParser from request to generate the urls
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        $data = (array) $request->getParsedBody();

        $this->settings->generalEmailHeader = trim($data['generalEmailHeader']);
        $this->settings->generalEmailFooter = trim($data['generalEmailFooter']);

        $url = $routeParser->urlFor('admin-email-templates');

        $flash->set('success', "Template parts updated successfully.");

        return $response->withStatus(302)->withHeader('Location', $url);
    }

    public function viewTemplate(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {
        $ID = $args['id'];
        $template = $this->emailTemplates->readSingle(['ID' => $ID]);
        $this->view->assign('template', $template);
        $this->view->display('admin/email-template.tpl');

        return $response;
    }

    public function updateTemplate(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {
        $flash = $this->session->getFlashBag();
        $flash->clear();
        // Get RouteParser from request to generate the urls
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        $data = (array) $request->getParsedBody();
        $ID = $args['id'];

        if ($ID !== $data['ID']) die();

        $update = $this->emailTemplates->update([
            'ID' => $data['ID'],
            'data' => [
                'content' => $data['content'],
                'subject' => $data['subject'],
                'useGeneralHeader' => $data['useGeneralHeader'],
                'useGeneralFooter' => $data['useGeneralFooter']
            ]
        ]);

        if (empty($update)) {
            $flash->set('error', "Unable to update template at the moment.");
        } else {
            $flash->set('success', "Template updated successfully.");
        }

        $url = $routeParser->urlFor('admin-email-template', ['id' => $ID]);

        return $response->withStatus(302)->withHeader('Location', $url);
    }
}
