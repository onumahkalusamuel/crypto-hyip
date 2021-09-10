{include file='admin/header.tpl' pageTitle='Referral'}

{assign var=referral value=$data.referral}
{assign var=transactions value=$data.trailLog}

<div class="main-content">

    <div class="container pb-40 pt-20">

        <div id="accordion" class="panel-group toggle accordion-classic accordion-classic-theme-colored2 accordion-flat">
            <div class="panel panel-default mb-20">
                <div class="panel-heading">
                    <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#accordion1">Referral Details </a> </div>
                </div>
                <div id="accordion1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class=" heading-title heading-line-bottom text-capitalize">Full details</h3>
                                    <table class="table">
                                        <tr>
                                            <th>Referer:</th>
                                            <td><?= $referral->referralUserName; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Referrered:</th>
                                            <td><?= $referral->referredUserName; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Referral Bonus Received:</th>
                                            <td>$<?= number_format($referral->referralBonus, 2); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#accordion2" aria-expanded="true">
                            Referral Transactions
                        </a>
                    </div>
                </div>
                <div id="accordion2" class="panel-collapse collapse in ">
                    <div class="panel-body">
                        <h5>All earnings and transactions for this referral will be listed here.</h5>
			{include file='admin/components/transactions-table-only.tpl' trasactions=$transactions}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{include file='admin/footer.tpl'}
