<?php
require_once 'Controller.php';
require_once 'Common.php';

$message = 'User : s12001';

$errorMessage = '';

read();

if (isset($_POST['button'])) {
    $button = htmlspecialchars($_POST['button'], ENT_QUOTES, 'UTF-8');
    switch ($button) {
        case '削除' :
            delInventory();
            break;
    }
}

function delInventory() {
    if (empty($_POST['id'])) {
        $GLOBALS['errorMessage'] = '必須項目を入力してください';
        return;
    }

    if (!is_numeric($_POST['id'])) {
        $GLOBALS['errorMessage'] = 'IDは数値で入力してください';
        return;
    }

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

    if (isInventory($id, true)) {
        unset($GLOBALS['data'][isInventory($id, false)]);

        $fp = fopen($GLOBALS['filename'], 'w');

        foreach ($GLOBALS['data'] as $line) {
            fputcsv($fp, $line);
        }

        fclose($fp);

        header("Location: http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}");
    }
}

function isInventory($id, $hoge) {
    for ($r = 0; $r < count($GLOBALS['data']); $r++) {
        if ($GLOBALS['data'][$r][0] === $id) {
            if ($hoge) {
                return true;
            }
            return $r;
        }
    }

    $GLOBALS['errorMessage'] = 'ID:' . $id . 'が見つかりませんでした';
    return false;
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
                <legend>商品削除</legend>
                ID:<input type="text" name="id" /><br />
                <p style="color: red;"><?php echo $errorMessage ?></p>
                <input type="submit" name="button" value="削除" />
                <input type="submit" name="button" value="戻る" />
            </fieldset>
        </form>
        <hr />
        <?php showInventory(); ?>
    </body>
</html>