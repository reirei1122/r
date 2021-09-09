<!DOCTYPE thml>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>mission1-28</title>
</head>
<body>
<form action="" method="post">
<input type="number" name="num" placeholder="数字入力してください">
<input type="submit" name="submit">
</form>

<?php
error_reporting(E_ALL & ~E_NOTICE);
//変数に代入
$num=$_POST["num"];
//ファイル作成
$filename="mission_1_28.txt";
//ファイルを読み込む
$fp=fopen($filename,"a");
//ファイルに書き込む
fwrite($fp,$num.PHP_EOL);
//ファイルを閉じる
fclose($fp);
echo "書き込み成功"."<br>";


if(file_exists($filename)){
$lines=file($filename,FILE_IGNORE_NEW_LINES);
foreach($lines as $line){
if($line%3==0 && $line%5==0){
echo "FizzBuzz"."<br>";
}else if($line%3==0){
echo "Fizz"."<br>";
}else if($line%5==0){
echo "Buzz"."<br>";
}else{
echo $line."<br>";
}
}
}
?>

</body>
</html>
