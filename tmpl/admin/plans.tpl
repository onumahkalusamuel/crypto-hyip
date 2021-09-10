{include file='admin/header.tpl' pageTitle='Plans'}

<div class="main-content">
    <div class="container pb-40 pt-20">
        <div id="accordion"
            class="panel-group toggle accordion-classic accordion-classic-theme-colored2 accordion-flat">
            <div class="panel panel-default mb-20">
                <div class="panel-heading">
                    <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse"
                            href="#accordion1" aria-expanded="true">Plans</a> </div>
                </div>
                <div id="accordion1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <h5 class="help">
                            <a class="btn text-uppercase btn-theme-colored btn-flat"
                                href="<?= $route->urlFor('admin-view-plan', ['id' => 'new']); ?>">Add new plan</a>
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
                                                    $
                                                    <?= number_format($plan->minimum ?? 1); ?>
                                                    -
                                                    <?= !empty($plan->maximum) ? '$' : null; ?>
                                                    <?= empty($plan->maximum) ? 'above' : number_format($plan->maximum); ?>
                                                </span><br />

                                                <strong>
                                                    <?= $plan->percentage . '% ' .
                                                                    ($plan->profitFrequency === 'end'
                                                                        ? " ROI at End of Plan"
                                                                        : ucwords($plan->profitFrequency) . ' ROI'); ?>
                                                </strong>
                                                <br />

                                                <?= $plan->duration . ' ' .
                                                            ucwords($plan->durationType) .
                                                            ($plan->durationType > 1 ? 's' : ''); ?> Duration
                                                <br />

                                                <strong>
                                                    <?= $plan->referralPercentage; ?>% Referral Commission
                                                </strong><br />
                                            </td>
                                            <td class="">
                                                <a href="<?= $route->urlFor('admin-view-plan', ['id' => $plan->ID]) ?>"
                                                    class="btn btn-dark btn-theme-colored btn-sm btn-flat mb-5">VIEW</i></a><br />
                                                <a href="<?= $route->urlFor('admin-delete-plan', ['id' => $plan->ID]) ?>"
                                                    onclick="return deleteRecord()"
                                                    class="btn btn-dark btn-theme-colored2 btn-sm btn-flat mb-5">DELETE</i></a><br />
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

<table width="100%" cellspacing="1" cellpadding="2" border="0">
    <tbody>
        <tr>
            <td colspan="5"><b>Available Investment Packages:</b></td>
        </tr>
        <tr>
            <td bgcolor="FFEA00" align="center"><b>Order</b></td>
            <td bgcolor="FFEA00" align="center"><b>Package name</b></td>
            <td bgcolor="FFEA00" align="center"><b>Deposit (US$)</b></td>
            <td bgcolor="FFEA00" align="center"><b>Profit (%)</b></td>
            <td bgcolor="FFEA00" align="center"><b>-</b></td>
        </tr>
        <tr>
            <td bgcolor="FFF9B3"> <br> <a href="?a=rates&amp;action=down&amp;id=2">[DOWN]</a> </td>
            <td bgcolor="FFF9B3">100 days 3.4% daily </td>
            <td bgcolor="FFF9B3">$10.00 - $5000.00</td>
            <td bgcolor="FFF9B3">3.20 - 3.40% / daily</td>
            <td class="menutxt" bgcolor="FFF9B3" align="right"> <a href="?a=editrate&amp;id=2">[edit]</a> <a
                    href="?a=deleterate&amp;id=2"
                    onclick="return confirm('  Demo version restriction!\nYou cannot delete this package!\n\n  ')">[delete]</a>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <table width="66%" cellspacing="0" cellpadding="2" border="0" align="right">
                    <tbody>
                        <tr onmouseover="bgColor='#FFECB0';" onmouseout="bgColor='';" bgcolor="">
                            <td width="120" nowrap="">Plan 1</td>
                            <td nowrap="" align="right">$10.00 - $100.00 &nbsp; &nbsp; </td>
                            <td width="60" nowrap="" align="right">3.20%</td>
                        </tr>
                        <tr onmouseover="bgColor='#FFECB0';" onmouseout="bgColor='';" bgcolor="">
                            <td width="120" nowrap="">Plan 2</td>
                            <td nowrap="" align="right">$101.00 - $1000.00 &nbsp; &nbsp; </td>
                            <td width="60" nowrap="" align="right">3.30%</td>
                        </tr>
                        <tr onmouseover="bgColor='#FFECB0';" onmouseout="bgColor='';" bgcolor="">
                            <td width="120" nowrap="">Plan 3</td>
                            <td nowrap="" align="right">$1001.00 - $5000.00 &nbsp; &nbsp; </td>
                            <td width="60" nowrap="" align="right">3.40%</td>
                        </tr>
                        <tr>
                            <td colspan="5" align="right"><small>Total deposited: 118($4016.11) &nbsp; Active deposits:
                                    45($11914.11)</small></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="FFF9B3"> <a href="?a=rates&amp;action=up&amp;id=1">[UP]</a> <br> </td>
            <td bgcolor="FFF9B3">1 year 2.4% daily </td>
            <td bgcolor="FFF9B3">$0.00 - $∞</td>
            <td bgcolor="FFF9B3">2.20 - 2.40% / daily</td>
            <td class="menutxt" bgcolor="FFF9B3" align="right"> <a href="?a=editrate&amp;id=1">[edit]</a> <a
                    href="?a=deleterate&amp;id=1"
                    onclick="return confirm('  Demo version restriction!\nYou cannot delete this package!\n\n  ')">[delete]</a>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <table width="66%" cellspacing="0" cellpadding="2" border="0" align="right">
                    <tbody>
                        <tr onmouseover="bgColor='#FFECB0';" onmouseout="bgColor='';" bgcolor="">
                            <td width="120" nowrap="">Plan 1</td>
                            <td nowrap="" align="right">$0.00 - $100.00 &nbsp; &nbsp; </td>
                            <td width="60" nowrap="" align="right">2.20%</td>
                        </tr>
                        <tr onmouseover="bgColor='#FFECB0';" onmouseout="bgColor='';" bgcolor="">
                            <td width="120" nowrap="">Plan 2</td>
                            <td nowrap="" align="right">$101.00 - $1000.00 &nbsp; &nbsp; </td>
                            <td width="60" nowrap="" align="right">2.30%</td>
                        </tr>
                        <tr onmouseover="bgColor='#FFECB0';" onmouseout="bgColor='';" bgcolor="">
                            <td width="120" nowrap="">Plan 3</td>
                            <td nowrap="" align="right">$1001.00 - $0.00 &nbsp; &nbsp; </td>
                            <td width="60" nowrap="" align="right">2.40%</td>
                        </tr>
                        <tr>
                            <td colspan="5" align="right"><small>Total deposited: 100($2133.00) &nbsp; Active deposits:
                                    26($13411.00)</small></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

<br />

<table width="100%" cellspacing="0" cellpadding="0" border="0">
    <tbody>
        <tr>
            <td>
                <form method="get"><input type="hidden" name="form_id" value="16312735991679"><input type="hidden"
                        name="form_token" value="565febecdc3983e8b70c94025d5d7f35"> <input type="hidden" name="a"
                        value="add_hyip"> <input type="submit" value="Add a new Investment Package" class="sbmt"
                        size="15"> </form>
            </td>
            <td align="right">
                <form method="get"><input type="hidden" name="form_id" value="16312735998506"><input type="hidden"
                        name="form_token" value="35caacd20d858d7e0bc24c56bd2d0136"> <input type="hidden" name="a"
                        value="earning_holidays"> <input type="submit" value="Holidays" class="sbmt" size="15"> </form>
            </td>
        </tr>
    </tbody>
</table>

<br />

<div class="alert alert-warning"> Investment packages:<br> You can create unlimited sets of investment packages with any
    settings and payout options. Also you can change status of any package. <li> Active package. All active users will
        receive earnings every pay period if made a deposit</li>
    <li> Inactive package. Users will not receive any earnings</li> <br><br> Here you can view, edit and delete your
    packages and plans.
</div>


{include file='admin/footer.tpl'}