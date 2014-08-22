<?php
require_once 'Controller.php';

$filename = 'inventory.csv';

function read() {
    if ($handle = fopen($GLOBALS['filename'], 'r')) {
        $r = 0;
        while ($line = fgetcsv($handle, 1000, ',')) {
            for ($c = 0; $c < count($line); $c++) {
                $GLOBALS['data'][$r][$c] = $line[$c];
            }
            $r++;
        }
        fclose($handle);
    }
}

function showInventory() {
    print '<table border=1><tbody>';
    print '<tr><th>ID</th><th>NAME</th><th>PRICE</th><th>STOCK</th></tr>';
    for ($r = 0; $r < count($GLOBALS['data']); $r++) {
        print '<tr align=right>';
        for ($c = 0; $c < count($GLOBALS['data'][$r]); $c++) {
            print '<td>' . $GLOBALS['data'][$r][$c] . '</td>';
        }
        print '</tr>';
    }
    print '</tbody></table>';
}
?>