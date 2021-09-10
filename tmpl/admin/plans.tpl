{include file='admin/header.tpl' pageTitle='Plans'}

<div class="main-content">
    <div class="container pb-40 pt-20">
        <div id="accordion" class="panel-group toggle accordion-classic accordion-classic-theme-colored2 accordion-flat">
            <div class="panel panel-default mb-20">
                <div class="panel-heading">
                    <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#accordion1" aria-expanded="true">Plans</a> </div>
                </div>
                <div id="accordion1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <h5 class="help">
                            <a class="btn text-uppercase btn-theme-colored btn-flat" href="<?= $route->urlFor('admin-view-plan', ['id' => 'new']); ?>">Add new plan</a>
                        </h5>
                        <div class="pb-40 pt-sm-5">
                            <div class="section-content">
                                <div class="table-responsive border-theme-colored">
                                    <table class="table table-striped table-hover">
                                        <tr>
                                            <th>Details</th>
                                            <th>Action</th>
                                        </tr>

                                        <?php if (!empty($data['plans'])) : ?>
                                            <?php foreach ($data['plans'] as $index => $plan) : ?>
                                                <tr>
                                                    <td class="text-uppercase">
                                                        <strong class="font-18">
                                                            <?= $plan->title; ?>
                                                        </strong>
                                                        <?php if ($plan->hasBadge) : ?>
                                                            <small class="badge approved">Featured</small>
                                                        <?php endif; ?>
                                                        <br />
                                                        <span class="">
                                                            $<?= number_format($plan->minimum ?? 1); ?>
                                                            -
                                                            <?= !empty($plan->maximum) ? '$' : null; ?><?= empty($plan->maximum) ? 'above' : number_format($plan->maximum); ?>
                                                        </span><br />

                                                        <strong><?= $plan->percentage . '% ' .
                                                                    ($plan->profitFrequency === 'end'
                                                                        ? " ROI at End of Plan"
                                                                        : ucwords($plan->profitFrequency) . ' ROI'); ?></strong>
                                                        <br />

                                                        <?= $plan->duration . ' ' .
                                                            ucwords($plan->durationType) .
                                                            ($plan->durationType > 1 ? 's' : ''); ?> Duration
                                                        <br />

                                                        <strong><?= $plan->referralPercentage; ?>% Referral Commission </strong><br />
                                                    </td>
                                                    <td class="">
                                                        <a href="<?= $route->urlFor('admin-view-plan', ['id' => $plan->ID]) ?>" class="btn btn-dark btn-theme-colored btn-sm btn-flat mb-5">VIEW</i></a><br />
                                                        <a href="<?= $route->urlFor('admin-delete-plan', ['id' => $plan->ID]) ?>" onclick="return deleteRecord()" class="btn btn-dark btn-theme-colored2 btn-sm btn-flat mb-5">DELETE</i></a><br />
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="5">
                                                    No data found.
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </table>
                                </div>
                            </div>
                        </div>









                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{include file='admin/footer.tpl'}
