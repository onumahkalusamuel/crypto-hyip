<?php $this->addAttribute('pageTitle', 'Account Logs'); ?>
<?php $this->setLayout('user/layout.php'); ?>

<div class="main-content">

    <div class="container pb-40 pt-20">
        <div id="accordion" class="panel-group toggle accordion-classic accordion-classic-theme-colored2 accordion-flat">
            <div class="panel panel-default mb-20">
                <div class="panel-heading">
                    <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#accordion1" aria-expanded="true">Account Logs</a> </div>
                </div>
                <div id="accordion1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <?php echo $this->fetch(
                            'user/components/account-logs-table.php',
                            ['logs' => $data]
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
