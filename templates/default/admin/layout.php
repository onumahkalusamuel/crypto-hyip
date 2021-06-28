<?= $this->fetch('admin/header.php'); ?>
<div class="container">
    <div class="mt-20 mb-20">
        <?php echo $this->fetch('public/components/flash-bag.php'); ?>
    </div>
</div>
<?= $content ?>
<?= $this->fetch('admin/footer.php'); ?>