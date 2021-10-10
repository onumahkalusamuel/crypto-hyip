{assign var="active" value="referrals"}
{extends file="theme/user/layout.tpl"}
{block name=title}Referrals{/block}
{block name=body}

    <div class="nk-block">
        <div class="container p-0 mb-5">
            <div class="content-container">
                <div class="item">
                    <div class="title">Referral Link</div>
                    <div class="content">
                        <div class="col-12 p-0 mb-1">
                            <input class=" form-control" id="referral_link" value="{$data.referral_link}" />
                        </div>
                        <div>
                            <small><button class="btn btn-primary" onclick="copyLink()">click to copy</button></small>
                        </div>

                    </div>
                </div>

                <div class="item">
                    <div class="title">Total Referrals:</div>
                    <div class="content">
                        {$data.referral_overview.total_referrals}
                    </div>
                </div>
                <div class="item">
                    <div class="title">Total Commission Earned:</div>
                    <div class="content">
                        ${$data.referral_overview.total_referral_commission}
                    </div>
                </div>
            </div>
        </div>

        <div class="container mb-5">
            <h4 class="section-title">Referrals History</h4>
            {include file="theme/user/components/referrals-table.tpl" localData=$data.referrals.data totalRows=$data.referrals.total_rows}
        </div>
    </div>
    <script>
        function copyLink() {
            /* Get the text field */
            var copyText = document.getElementById("referral_link");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            alert("Referral Link Copied");

            return false;
        }
    </script>
{/block}