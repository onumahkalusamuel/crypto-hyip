<div class="item">
    <style>
.crop-news {
  -webkit-line-clamp: 3;
  overflow : hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-box-orient: vertical;
}

.news-tag {
    padding: 5px 5px;
        border: 1px solid #888;
        border-radius: 30px;
        margin: 2px 0px;
        display: inline-block;
}
</style>
    <article class="post maxwidth400 border-1px mb-30">
        <div class="entry-header">
            <div class="post-thumb thumb">
                <img src="<?=$news['image'];?>" alt="<?=$news['alt'];?>" class="img-responsive img-fullwidth">
            </div>
        </div>
        <div class="entry-content bg-white p-20">
            <div class="entry-meta font-12 letter-space-1">
                <?=$news['author'];?> | <?=$getTimeAgo($news['date']);?>
            </div>
            <h4 class="entry-title font-weight-600 text-uppercase line-bottom letter-space-1 mb-10"><a href="<?=$news['link'];?>" target="_blank" class="text-theme-colored crop-news"><?=$news['title'];?> </a></h4>
        </div>
        <div class="entry-meta p-15 pt-10 pb-5 bg-theme-colored border-left-theme-colored2">
            <ul class="list-inline text-white font-13 mb-10">
                <li></i>
                <?php foreach($news['categories'] as $key => $cat):?>
                    <span class="news-tag"><?php echo $cat;?></span>
                    <?php if($key === 2 ) break;?>
                <?php endforeach;?>
            </li>
            </ul>
        </div>
    </article>
</div>