<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <a class="<?= ($key == 0 ? 'active' : 'collapsed'); ?>" data-toggle="collapse" data-parent="#faqsAccordion" href="#faq<?= $key; ?>" aria-expanded="<?=$key==0?'true': 'false';?>">
                <?php if ($key != 0) : ?>
                <?php endif; ?>
                <?= $faq['question']; ?>
            </a> </div>
    </div>
    <div id="faq<?= $key; ?>" class="panel-collapse collapse <?= ($key == 0 ? 'in' : null); ?>">
        <div class="panel-body">
            <p> <?= $faq['answer']; ?></p>
        </div>
    </div>
</div>