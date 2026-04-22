<?php
$f = 'resources/views/pages/order.blade.php';
$l = file($f);
$top = array_slice($l, 0, 62);
$tia = array_slice($l, 62, 234);
$mid = array_slice($l, 296, 92);
$bot = array_slice($l, 388);
file_put_contents($f, implode('', array_merge($top, $mid, $tia, $bot)));
echo "Done!\n";
?>
