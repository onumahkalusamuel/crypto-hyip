<?php $this->addAttribute('pageTitle', 'Referrals'); ?>
<?php $this->setLayout('user/layout.php'); ?>
<?php

$referralLink = $data['referral_link'];
$referralOverview = $data['referral_overview'];
$referrals = $data['referrals'];

?>
<div class="main-content">
    <div class="container pb-40 pt-20">
        <div id="accordion" class="panel-group toggle accordion-classic accordion-classic-theme-colored2 accordion-flat">
            <div class="panel panel-default mb-20">
                <div class="panel-heading">
                    <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#accordion1" aria-expanded="true">Referral Overview </a> </div>
                </div>
                <div id="accordion1" class="panel-collapse collapse in">
                    <div class="panel-body text-center">
                        <div class="h5 font-16">
                            Total Referrals:
                            <?= $referralOverview['total_referrals']; ?>
                        </div>
                        <div class="h5 font-16">
                            Total Commission Earned:
                            $<?= $referralOverview['total_referral_commission']; ?>
                        </div>
                        <div class="h5 font-16">
                            Referral Link:
                        </div>
                        <div class="h5 font-14">
                            <span>
                                <input class="border-theme-colored2 p-10 text-center" style="border-style: solid; width:100%" id="referral_link" value="<?= $referralLink ?>" />
                            </span>
                            <br /><br />
                            <small><button class="btn btn-dark" onclick="copyLink()">click to copy</button></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#accordion2">
                            Referral History
                        </a>
                    </div>
                </div>
                <div id="accordion2" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <?php echo $this->fetch(
                            'user/components/referrals-table.php',
                            ['referrals' => $data['referrals'] ?? []]
                        ); ?>
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