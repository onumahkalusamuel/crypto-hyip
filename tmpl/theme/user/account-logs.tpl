{assign var="active" value="transactions"}
{extends file="theme/user/layout.tpl"}
{block name=title}Transactions{/block}
{block name="body"}
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Transactions</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Transactions history</h4>
                        <p class="card-description">
                            All transactions carried out on your account are listed here.
                        </p>
                        {include file="theme/user/components/account-logs-table.tpl" localData=$data.data totalRows=$data.total_rows}
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}