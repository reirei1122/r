<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_3-1.php</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="text" name="a" placeholder="コメント"><br>
            <input type="text" name="b" placeholder="お名前入力してください"><br>
            <input type="submit" name="submit"><br>
        </form>
        
        <?php
        error_reporting(E_ALL & ~E_NOTICE);
        $filename="mission_3_01.txt";
        $a=$_POST["a"];
        $b=$_POST["b"];
    
        $date=date("Y年m月d日");
        
        if(file_exists($filename)){
            $num=count(file($filename))+1;
        }else{
            $num=1;
        }
        
        $ndate=$num."<>".$a."<>".$b."<>".$date;
        
        if(!empty($a) ||!empty($b)){
            $fp=fopen($filename,"a");
            fwrite($fp,$ndate.PHP_EOL);
            fclose($fp);
        }
        ?>
    </body>
</html>