<?php

$cat_diam = ceil(($_POST['cat-r'] * 2.54 + ($_POST['cat-1'] * $_POST['cat-2'] / 1000) * 2) * 100) / 100;
$cat_width = ceil($_POST['cat-1'] / 10 * 100) / 100;
$cat_height = ceil($_POST['cat-1'] * $_POST['cat-2'] / 1000 * 100) / 100;
$new_diam = ceil(($_POST['new-r'] * 2.54 + ($_POST['new-1'] * $_POST['new-2'] / 1000) * 2) * 100) / 100;
$new_width = ceil($_POST['new-1'] / 10 * 100) / 100;
$new_height = ceil($_POST['new-1'] * $_POST['new-2'] / 1000 * 100) / 100;
$real_speed = ceil(100 * $new_diam / $cat_diam) / 100;

$result = [
    'cat_diam'      =>$cat_diam,
    'cat_width'     =>$cat_width,
    'cat_height'    =>$cat_height,
    'new_diam'      =>$new_diam,
    'new_width'     =>$new_width,
    'new_height'    =>$new_height,
    'real_speed'    =>$real_speed
];

echo json_encode($result);