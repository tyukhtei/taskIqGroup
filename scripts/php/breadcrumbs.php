<?php
function renderBreadcrumbs($activePage) {

    $breadcrumbs = [
        'Главная' => 'index.php',
        'Вклады' => 'index.php#',
        'Калькулятор' => 'index.php##'
    ];


    echo '<div class="breadcrumbs">';

    foreach ($breadcrumbs as $title => $link) {

        if ($title === $activePage) {
            echo '<span>' . $title . '</span>';
        } else {

            echo '<a href="' . $link . '">' . $title . '</a>';
        }

        if ($link !== end($breadcrumbs)) {
            echo ' > ';
        }
    }

    echo '</div>';
}
?>