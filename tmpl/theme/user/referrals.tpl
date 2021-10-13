{assign var="active" value="referrals"}
{extends file="theme/user/layout.tpl"}
{block name=title}Referrals{/block}
{block name=body}

    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Referrals</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Referral stats</h4>
                        <p class="card-description">
                            Here are your referral stats and your invite link. Share it to earn referral bonuses.
                        </p>
                        <div class="">
                            <div class="form-group">
                                <label for="planID">Referral Link</label>
                                <input class="form-control" id="referral_link" value="{$data.referral_link}" />
                            </div>
                            <div class="form-group col-sm-6">
                                <button class="btn btn-primary" onclick="copyLink()">click to copy</button></small>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="amount">Total Referrals</label>
                                    <input class="form-control" readonly value="{$data.referral_overview.total_referrals}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="amount">Referral Commission Earned</label>
                                    <input class="form-control"
                                        readonly value="${$data.referral_overview.total_referral_commission|string_format:"%.2f"}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Referrals history</h4>
                        <p class="card-description">
                            Below is a list of your referrals.
                        </p>
                        {include file="theme/user/components/referrals-table.tpl" localData=$data.referrals.data totalRows=$data.referrals.total_rows}
                    </div>
                </div>
            </div>
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