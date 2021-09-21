{include file="theme/user/header.tpl" pageTitle="Referrals" active="referrals"}

<section id="page-title" class="page-title bg-overlay bg-overlay-dark bg-parallax">
    <div class="bg-section">
        <img src="assets/images/page-titles/18.jpg" alt="Background" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="title title-6 text-center" style="padding:150px 0 50px">
                    <div class="title--heading">
                        <h1 style="font-size:4em">Referrals</h1>
                    </div>
                    <div class="clearfix"></div>
                    <ol class="breadcrumb">
                        <li><a href="{$route->urlFor('user-dashboard')}">Dashboard</a></li>
                        <li class="active">Referrals</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row mb-60">
            <h3 class="section-title">Referrals Overview</h3>
            <div class="container">
                <div class="content-container">
                    <div class="item">
                        <div class="title">Referral Link</div>
                        <div class="content">
                            <span>
                                <input class=" form-control" id="referral_link" value="{$data.referral_link}" />
                            </span>
                            <small><button class="btn btn-primary" onclick="copyLink()">click to copy</button></small>

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
        </div>

        <div class="row">
            <h3 class="section-title">Referrals History</h3>
            {include file="theme/user/components/referrals-table.tpl" localData=$data.referrals.data totalRows=$data.referrals.total_rows}
        </div>
    </div>
</section>

{include file="theme/user/footer.tpl"}

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