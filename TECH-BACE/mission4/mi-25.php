<?php
$a="僕の名前は伊藤黎です";
$filename="ito_rei.html";
$fp=fopen($filename,"w");
fwrite($fp,$a);
fclose($fp);
echo "書き込み成功!";
?>