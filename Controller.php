<?php
$main = 'Location:Main.php';
$insert = 'Location:Insert.php';

if (isset($_POST['button'])) {
    $button = htmlspecialchars($_POST['button'], ENT_QUOTES, 'UTF-8');
    switch ($button) {
        case '戻る':
            header($main);
            break;
    }
}
?>