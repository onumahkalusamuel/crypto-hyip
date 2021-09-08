<?php $this->addAttribute('pageTitle', 'Deposits'); ?>
<?php $this->setLayout('user/layout.php'); ?>
<?php
$deposits = $data['deposits'];
$plans = $data['plans'];
$activeCurrencies = $data['activeCurrencies'];
?>

<div class="main-content">
    <div class="container pb-40 pt-20">
        <div id="accordion" class="panel-group toggle accordion-classic accordion-classic-theme-colored2 accordion-flat">
            <div class="panel panel-default mb-20">
                <div class="panel-heading">
                    <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse"  href="#accordion1" aria-expanded="true">Make A Deposit </a> </div>
                </div>
                <div id="accordion1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="">
                            <form id="new_deposit" class="row" action="" method="post">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label for="planID">Select Plan:</label>
                                    <select id="planID" name="planID" class="form-control">
                                        <?php foreach ($plans as $plan) : ?>
                                            <option <?= ($_POST['planID'] == $plan->ID ? 'selected' : null); ?> value="<?= $plan->ID; ?>">

                                                <?= $plan->title; ?>
                                                (
                                                $<?= number_format($plan->minimum ?? 1); ?> -
                                                <?= !empty($plan->maximum) ? '$' : null; ?></span><?= empty($plan->maximum) ? 'above' : number_format($plan->maximum); ?>
                                                )
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4 col-md-3">
                                    <label for="amount">Enter Deposit Amount:</label>
                                    <input class="form-control" id="amount" type="number" name="amount" value="<?= $_POST['amount']; ?>" required />
                                </div>
                                <div class="form-group col-sm-4 col-md-3">
                                    <label for="cryptoCurrency">Mode of Payment:</label>
                                    <select id="cryptoCurrency" name="cryptoCurrency" class="form-control">
                                        <?php foreach($activeCurrencies as $currency):?>
                                            <option <?= ($_POST['cryptoCurrency'] == $currency ? 'selected' : null); ?> value="<?=$currency;?>"><?=strtoupper($currency);?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4 col-md-2">
                                    <br class="hidden-xs hidden-sm" />
                                    <button type="submit" class="form-control btn btn-dark btn-theme-colored2" data-loading-text="Please wait...">Make Deposit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse"  href="#accordion2">
                            Deposit History
                        </a>
                    </div>
                </div>
                <div id="accordion2" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <?php echo $this->fetch(
                            'user/components/deposits-table.php',
                            ['deposits' => $deposits ?? []]
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#new_deposit").validate({
        submitHandler: function(form) {
            var form_btn = $(form).find('button[type="submit"]');
            var form_result_div = '#form-result';
            $(form_result_div).remove();
            form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
            var form_btn_old_msg = form_btn.html();
            form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
            $(form).ajaxSubmit({
                dataType: 'json',
                success: function(data) {
                    if (data.success === true) {
                        window.location.assign(data.redirect)
                    } else {
                        alert(data.message);
                    }
                    form_btn.prop('disabled', false).html(form_btn_old_msg);
                },
                error: function(e) {
                    alert(e.responseJSON.message);
                    form_btn.prop('disabled', false).html(form_btn_old_msg);
                }
            });
        }
    });
</script>