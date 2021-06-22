<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#faqsAccordion" href="#faq<?=$key;?>"><span class="open-sub"></span><?=$faq['question'];?> </a> </div>
    </div>
    <div id="faq<?=$key;?>" class="panel-collapse collapse <?=($key==0?'in':null);?>">
        <div class="panel-body">
            <p> <?=$faq['answer'];?></p>
        </div>
    </div>
</div>