<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_2-1.php</title>
    </head>
    <body>
        <form action=""  method="post">
            <input type="text" name="a" placeholder="コメント">
            <br>
            <input type="submit" name="submit">
            <br>
            
            <?php
            $a=$_POST["a"];
            $filename="mission_2-1.txt";
            $fp=fopen($filename,"a");
            fwrite($fp,$a.PHP_EOL);
            fclose($fp);
            echo $a."を受け付けました<br>";
            
            ?>
        </form>
    </body>
</html>