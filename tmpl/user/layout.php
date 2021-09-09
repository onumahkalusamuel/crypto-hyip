<?= $this->fetch('user/header.php'); ?>

<?php echo $this->fetch('user/components/inner-header.php'); ?>
    <div class="container">
        <div class="mt-20 mb-20">
            <?php echo $this->fetch('public/components/flash-bag.php'); ?>
        </div>
    </div>

<?= $content ?>

<?= $this->fetch('user/footer.php'); ?>