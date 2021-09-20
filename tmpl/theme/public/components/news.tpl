    {if !empty($news)}
        <div class="col-xs-12 col-sm-4 col-md-4 wow fadeInUp" data-wow-delay="{(($key%3)+1)}00ms">
            <div class="blog-entry">
                <div class="entry--img">
                    <a href="{$news.link}" target="_blank">
                        <img src="{$news.image}" loading="lazy" alt="{$news.title}" />
                        <div class="entry--overlay"></div>
                    </a>
                </div>
                <div class="entry--content">
                    <div class="entry--meta"><a target="_blank" href="{$news.link}">{$news.author}</a></div>
                    <div class="entry--title">
                        <h4><a href="{$news.link}" target="_blank" class="crop-news">{$news.title}</a></h4>
                    </div>
                    <div class="entry--bio crop-news-desc">
                        {$news.desc}
                    </div>
                    <div class="entry--footer">
                        <div class="entry--date">
                            {foreach $news.tags as $tag}
                                <span class="news-tag">
                                    {$tag}
                                </span>
                            {/foreach}
                        </div>
                    </div>
                </div>

            </div>
        </div>
{/if}