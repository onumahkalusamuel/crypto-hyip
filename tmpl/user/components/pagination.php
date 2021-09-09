<?php

$total_rows;
$total_retrieved;
$get = $_GET;

if (empty($total_rows) || empty($total_retrieved)) return;

$records_per_page = !empty($get['rpp']) ? $get['rpp'] : 20;

$first_page = 1;
$current_page = $get['page'] ?? $first_page;

$last_page = ceil((int)$total_rows / (int)$records_per_page);

// page links
// $first_page_link;
$get['page'] = $first_page;
$first_page_link = $uri->getPath() . "?" . http_build_query($get);

// $prev1_page_link
if ($current_page - 2 >= $first_page) {
    $get['page'] = $current_page - 2;
    $prev1_page_link = $uri->getPath() . "?" . http_build_query($get);
}

// $prev0_page_link
if ($current_page - 1 >= $first_page) {
    $get['page'] = $current_page - 1;
    $prev0_page_link = $uri->getPath() . "?" . http_build_query($get);
}

// current
$get['page'] = $current_page;
$current_page_link = $uri->getPath() . "?" . http_build_query($get);

if ($current_page + 1 <= $last_page) {
    $get['page'] = $current_page + 1;
    $next0_page_link = $uri->getPath() . "?" . http_build_query($get);
}

if ($current_page + 2 <= $last_page) {
    $get['page'] = $current_page + 2;
    $next1_page_link = $uri->getPath() . "?" . http_build_query($get);
}

$get['page'] = $last_page;
$last_page_link = $uri->getPath() . "?" . http_build_query($get);

?>
<div class="text-center">
    Total Records: <?= $total_rows; ?>; Records Retrieved: <?= $total_retrieved; ?>;
    <nav class="" aria-label="...">
        <ul class="pagination" style="overflow-x:scroll;display:flex;scrollbar-width: none; justify-content: center;">
            <li class="page-item <?= ($first_page_link === $current_page_link) ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= $first_page_link; ?>">
                    first
                </a>
            </li>
            <?php if (!empty($prev1_page_link)) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $prev1_page_link; ?>">
                        <?= $current_page - 2; ?>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (!empty($prev0_page_link)) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $prev0_page_link; ?>">
                        <?= $current_page - 1; ?></a>
                </li>
            <?php endif; ?>
            <li class="page-item active">
                <span class="page-link">
                    <?= $current_page; ?>
                </span>
            </li>
            <?php if (!empty($next0_page_link)) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $next0_page_link; ?>">
                        <?= $current_page + 1; ?>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (!empty($next1_page_link)) : ?>
                <li class="page-item"><a class="page-link" href="<?= $next1_page_link; ?>">
                        <?= $current_page + 2; ?></a>
                </li>
            <?php endif; ?>
            <li class="page-item <?= ($last_page_link === $current_page_link) ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= $last_page_link; ?>">
                    last
                </a>
            </li>

        </ul>
    </nav>
</div>