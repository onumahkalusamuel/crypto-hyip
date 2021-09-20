{if empty($type)}
    {assign var=type value="full_v2"}
{/if}
{if empty($theme)}
    {assign var=theme value="light"}
{/if}
{if empty($count)}
    {assign var=count value="10"}
{/if}
{if empty($pref_coin_id)}
    {assign var=pref_coin_id value="1505"}
{/if}
{if empty($graph)}
    {assign var=graph value="yes"}
{/if}
{if empty($width)}
    {assign var=width value="100%"}
{/if}
{if empty($height)}
    {assign var=height value="409"}
{/if}

<iframe loading="lazy"
    src="https://widget.coinlib.io/widget?type={$type}&theme={$theme}&cnt={$count}&pref_coin_id={$pref_coin_id}&graph={$graph}"
    scrolling="auto" marginwidth="0" marginheight="0" border="0" style="border:0;margin:0;padding:0;" width="{$width}"
height="{$height}" frameborder="0" loading="lazy"></iframe>