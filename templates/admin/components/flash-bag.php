<?php
$errors = $flashBag->get('error');
$successes = $flashBag->get('success');
?>
<?php foreach ($errors as $error) : ?>
    <strong class="alert alert-danger alert-dismissable text-center display-block">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
        <?= $esc->escapeHtml($error); ?>
    </strong>
<?php endforeach; ?>
<?php foreach ($successes as $success) : ?>
    <strong class="alert alert-success alert-dismissable text-center display-block">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
        <?= $esc->escapeHtml($success); ?>
    </strong>
<?php endforeach; ?>