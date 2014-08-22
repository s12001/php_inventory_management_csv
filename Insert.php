<?php
require_once 'Controller.php';
require_once 'Common.php';

$message = 'User : s12001';

$errorMessage = '';

read();

if (isset($_POST['button'])) {
    $button = htmlspecialchars($_POST['button'], ENT_QUOTES, 'UTF-8');
    switch ($button) {
        case '追加' :
            addInventory();
            break;
    }
}

function addInventory() {
    if (empty($_POST['name']) || empty($_POST['price']) || empty($_POST['stock'])) {
        $GLOBALS['errorMessage'] = '必須項目を入力してください';
        return;
    }

    if (!is_numeric($_POST['price']) || !is_numeric($_POST['stock'])) {
        $GLOBALS['errorMessage'] = '価格と在庫は数値で入力してください';
        return;
    }

    $id = $GLOBALS['data'][count($GLOBALS['data']) - 1][0] + 1;
    //最後のレコードのIDに+1
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $price = htmlspecialchars($_POST['price'], ENT_QUOTES, 'UTF-8');
    $stock = htmlspecialchars($_POST['stock'], ENT_QUOTES, 'UTF-8');

    $max = count($GLOBALS['data']);
    //配列の長さ
    $c = array($id, $name, $price, $stock);
    $GLOBALS['data'][$max] = $c;

    $fp = fopen($GLOBALS['filename'], 'w');

    foreach ($GLOBALS['data'] as $line) {
        fputcsv($fp, $line);
    }

    fclose($fp);

    header("Location: http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>CSV在庫管理システム</title>
    </head>
    <body>
        <h1>在庫管理システム</h1>
        <p><?php echo $message ?></p>
        <form method="post" action="">
            <fieldset>
                <legend>商品追加</legend>
                商品名:<input type="text" name="name" /><br />
                価格:<input type="text" name="price" /><br />
                在庫:<input type="text" name="stock" /><br />
                <p style="color: red;"><?php echo $errorMessage ?></p>
                <input type="submit" name="button" value="追加" />
                <input type="submit" name="button" value="戻る" />
            </fieldset>
        </form>
        <hr />
        <?php showInventory(); ?>
    </body>
</html>