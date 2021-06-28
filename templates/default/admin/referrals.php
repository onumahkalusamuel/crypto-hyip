<?php $this->addAttribute('pageTitle', 'Referrals'); ?>
<?php $this->setLayout('admin/layout.php'); ?>

<div class="main-content">
    <div class="container pb-40 pt-20">
        <div id="accordion" class="panel-group toggle accordion-classic accordion-classic-theme-colored2 accordion-flat">
            <div class="panel panel-default mb-20">
                <div class="panel-heading">
                    <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#accordion1" aria-expanded="true">Referrals</a> </div>
                </div>
                <div id="accordion1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <?php echo $this->fetch(
                            'admin/components/referrals-table.php',
                            ['referrals' => $data['referrals'] ?? []]
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>