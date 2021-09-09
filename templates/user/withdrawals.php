<?php $this->addAttribute('pageTitle', 'Withdrawals'); ?>
<?php $this->setLayout('user/layout.php'); ?>

<div class="main-content">
    <div class="container pb-40 pt-20">
        <div id="accordion" class="panel-group toggle accordion-classic accordion-classic-theme-colored2 accordion-flat">
            <div class="panel panel-default mb-20">
                <div class="panel-heading">
                    <div class="panel-title"> <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#accordion1" aria-expanded="true">Make a withdrawal</a> </div>
                </div>
                <div id="accordion1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <h4 class="text-center font-16 heading-line-bottom">Minimum Withdrawal Amount: $<?= $data['min_withdrawal']; ?></h4>
                        <div class="">
                            <form id="new_withdrawal" class="row" action="" method="post">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label for="cryptoCurrency">Select Wallet:</label>
                                    <select id="cryptoCurrency" name="cryptoCurrency" class="form-control">
                                        <option value="0">--Select--</option>
                                        <?php foreach ($data['wallets'] as $wallet) : ?>
                                            <option value="<?= $wallet['ID']; ?>" <?= !$wallet['addressIsSet'] ? "disabled" : ""; ?>>
                                                <?= $wallet['title']; ?>
                                                ($<?= number_format($wallet['balance'] ?? 0, 2); ?>)
                                                <?= !$wallet['addressIsSet'] ? "no address" : ""; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <h4 class="font-12 p-0 m-0">Set wallet addresses in profile.</h4>
                                </div>
                                <div class="form-group col-sm-4 col-md-3">
                                    <label for="amount">Enter Withdrawal Amount:</label>
                                    <input class="form-control" id="amount" type="number" name="amount" min="<?= $data['min_withdrawal']; ?>" value="<?= $_POST['amount']; ?>" required />
                                </div>
                                <div class="form-group col-sm-4 col-md-2">
                                    <br class="hidden-xs hidden-sm" />
                                    <button type="submit" class="form-control btn btn-dark btn-theme-colored2" data-loading-text="Please wait...">Make Withdrawal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <a class="active font-24 pt-0 pb-0 text-capitalize" data-toggle="collapse" href="#accordion2">
                            Withdrawal History
                        </a>
                    </div>
                </div>
                <div id="accordion2" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <?php echo $this->fetch(
                            'user/components/withdrawals-table.php',
                            ['withdrawals' => $data['withdrawals'] ?? []]
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#new_withdrawal").validate({
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