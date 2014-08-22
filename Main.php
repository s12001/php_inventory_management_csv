<?php
require_once 'Controller.php';
require_once 'Common.php';

$message = 'ようこそ s12001 さん';

read();

if (isset($_POST['button'])) {
	$button = htmlspecialchars($_POST['button'], ENT_QUOTES, 'UTF-8');
    switch ($button) {
        case '商品追加':
            header($GLOBALS['insert']);
            break;
    }
}
?>
<!DOCTYPE html>
<html lang='ja'>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>CSV在庫管理システム</title>
    </head>
    <body>
        <h1>在庫管理システム</h1>
        <p><?php echo $message ?></p>
        <form method="post" action="">
            <fieldset>
                <legend>メニュー</legend>
                <input type="submit" name="button" value="商品追加" />
                <input type="submit" name="button" value="商品削除" />
                <input type="submit" name="button" value="価格変更" />
                <input type="submit" name="button" value="在庫変更" />
            </fieldset>
        </form>
        <hr />
        <?php showInventory(); ?>
    </body>
</html>