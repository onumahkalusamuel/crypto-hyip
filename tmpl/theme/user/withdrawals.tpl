{include file="theme/user/header.tpl" pageTitle="Withdrawals" active="withdrawals"}

<section id="page-title" class="page-title bg-overlay bg-overlay-dark bg-parallax">
    <div class="bg-section">
        <img src="assets/images/page-titles/18.jpg" alt="Background" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="title title-6 text-center" style="padding:150px 0 50px">
                    <div class="title--heading">
                        <h1 style="font-size:4em">Withdrawals</h1>
                    </div>
                    <div class="clearfix"></div>
                    <ol class="breadcrumb">
                        <li><a href="{$route->urlFor('user-dashboard')}">Dashboard</a></li>
                        <li class="active">Withdrawals</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row mb-60">
            <h3 class="section-title">Make Withdrawal</h3>
            <form id="new_withdrawal" class="row" action="{$route->urlFor('user-withdrawals')}" method="post"
                onsubmit="return ajaxPost('new_withdrawal')">
                <div class="content-container">
                    <div class="item">
                        <div class="title">Minimum Withdrawal Amount</div>
                        <div class="content">${$data.min_withdrawal}. <em>You must have the minimum withdrawal amount for withdrawal to be active.</em></div>
                    </div>
                    
                    <div class="item">
                        <div class="title">Select Wallet Currency:</div>
                        <div class="content">
                            <select id="cryptoCurrency" name="cryptoCurrency" class="form-control" required>
                                {foreach $data.wallets as $wa}
                                    <option {if $wa.balance lt $data.min_withdrawal || $wa.addressIsSet ne 'true'}disabled{/if} value="{$wa.ID}">
                                        {$wa.title} (${$wa.balance})
                                    </option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="item">
                        <div class="title">Withdrawal Amount</div>
                        <div class="content">
                            <input class="form-control" id="amount" type="number" name="amount" min="{$data.min_withdrawal}" required />
                        </div>
                    </div>
                    <div class="item">
                        <div class="title"></div>
                        <div class="content">
                            <button type="submit" class="btn btn-primary">Make Withdrawal</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="row">
            <h3 class="section-title">Withdrawal History</h3>
            {include file="theme/user/components/withdrawals-table.tpl" localData=$data.withdrawals.data totalRows=$data.withdrawals.total_rows}
        </div>
    </div>
</section>

{include file="theme/user/footer.tpl"}
