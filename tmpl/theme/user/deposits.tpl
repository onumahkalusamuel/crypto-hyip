{include file="theme/user/header.tpl" pageTitle="Deposits" active="deposits"}

<section id="page-title" class="page-title bg-overlay bg-overlay-dark bg-parallax">
    <div class="bg-section">
        <img src="assets/images/page-titles/18.jpg" alt="Background" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="title title-6 text-center" style="padding:150px 0 50px">
                    <div class="title--heading">
                        <h1>Deposits</h1>
                    </div>
                    <div class="clearfix"></div>
                    <ol class="breadcrumb">
                        <li><a href="{$route->urlFor('user-dashboard')}">Dashboard</a></li>
                        <li class="active">Deposits</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <h3 class="section-title">Make Deposit</h3>
            <form id="new_deposit" class="row" action="{$route->urlFor('user-deposits')}" method="post"
                onsubmit="return ajaxPost('new_deposit')">
                <div class="content-container">
                    <div class="item">
                        <div class="title">Plan:</div>
                        <div class="content"><select id="planID" name="planID" class="form-control">
                                {foreach $data.plans as $plan}
                                    <option value="{$plan->ID}">
                                        {$plan->title}: ${$plan->minimum} -
                                        {if empty($plan->maximum)}above{else}${$plan->maximum}{/if}
                                    </option>
                                {/foreach}
                            </select></div>
                    </div>
                    <div class="item">
                        <div class="title">Deposit Amount</div>
                        <div class="content">
                            <input class="form-control" id="amount" type="number" name="amount" required />
                        </div>
                    </div>
                    <div class="item">
                        <div class="title">Select Crypto Currency:</div>
                        <div class="content">
                            <select id="cryptoCurrency" name="cryptoCurrency" class="form-control">
                                {foreach $data.activeCurrencies as $currency}
                                    <option value="{$currency}">
                                        {$currency|upper}
                                    </option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="item">
                        <div class="title"></div>
                        <div class="content">
                            <button type="submit" class="btn btn-primary">Make Deposit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <h3 class="section-title">Deposit History</h3>
            {include file="theme/user/components/deposits-table.tpl" localData=$data.deposits.data totalRows=$data.deposits.total_rows}
        </div>
    </div>
</section>

{include file="theme/user/footer.tpl"}