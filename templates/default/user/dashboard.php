<?php $this->addAttribute('pageTitle', 'Dashboard'); ?>
<?php $this->setLayout('user/layout.php'); ?>

<div class="main-content">
    <div class="container pb-40 pt-20">
        <div id="accordion" class="panel-group toggle accordion-classic accordion-classic-theme-colored2 accordion-flat">
            <div class="panel panel-default mb-20">
                <div class="panel-heading">
                    <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#accordion1" aria-expanded="true">Account Dashboard</a> </div>
                </div>
                <div id="accordion1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <h5> Welcome back, <?= $data['userInfo']->fullName; ?>.</h5><br/>
                        <h5> Username: <?= $data['userInfo']->userName; ?>.</h5>
                        <h5> Account Registered: <?= $getTimeAgo($data['userInfo']->createdAt); ?>.</h5>
                        <h5> BTC Address: <?= $data['userInfo']->btcAddress; ?>.</h5>
                        <h5> BTC Available Balance: $<?= number_format($data['userInfo']->btcBalance, 2); ?>.</h5>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php //echo $this->fetch('public/components/section-live-table.php'); 
    ?>
</div>