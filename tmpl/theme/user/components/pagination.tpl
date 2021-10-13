{paginationLinks total_rows=$total_rows total_retrieved=$total_retrieved uri=$uri out=links}

{if $total_rows}
    <div class="container mt-3 mb-3 text-center">
        <div class="col-xs-12" style="font-size: 1.1em; line-height:2">
            <strong>Total Records: {$total_rows}</strong> <br/>
            <strong>Records Retrieved: {$total_retrieved}</strong>
        </div>
        <div class="col-xs-12 mt-4 d-flex justify-content-center">
            <ul class="pagination">
                <li class="page-item">
                    <a {if $links.first_page_link !== $links.current_page_link} href="{$links.first_page_link}" {/if}
                        class="prev page-link">&lt;&lt;</a>
                </li>

                {if $links.prev1_page_link}
                    <li class="page-item">
                        <a href="{$links.prev1_page_link}" class="prev page-link">
                            {$links.current_page - 2}
                        </a>
                    </li>
                {/if}
                {if $links.prev0_page_link}
                    <li class="page-item">
                        <a href="{$links.prev0_page_link}" class="prev page-link">
                            {$links.current_page - 1}
                        </a>
                    </li>
                {/if}
                <li class="page-item active"><a class="page-link">
                        {$links.current_page}
                    </a></li>

                {if $links.next0_page_link ne ''}
                    <li class="page-item">
                        <a href="{$links.next0_page_link}" class="next page-link">
                            {$links.current_page + 1}
                        </a>
                    </li>
                {/if}
                {if $links.next1_page_link ne ''}
                    <li class="page-item">
                        <a href="{$links.next1_page_link}" class="next page-link">
                            {$links.current_page + 2}
                        </a>
                    </li>
                {/if}
                <li class="page-item">
                    <a {if $links.last_page_link !== $links.current_page_link} href="{$links.last_page_link}" {/if}
                        class="next page-link">&gt;&gt;</a>
                </li>
            </ul>
        </div>
    </div>
{/if}