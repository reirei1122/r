<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_2-03.php</title>
    </head>
    <form action=""  method="post">
        <input type="text" name="a" placeholder="コメント">
        <input type="submit" name="submit">
        
        
    </form>
    <?php
            $filename="mission_2-4.txt";
            if(!empty($_POST["a"])){
            $a=$_POST["a"];
            $fp=fopen($filename,"a");
            fwrite($fp,$a.PHP_EOL);
            fclose($fp);
            
            }
            
            if(file_exists($filename)){
                $lines=file($filename,FILE_IGNORE_NEW_LINES);
                foreach($lines as $line){
                    echo $line . "<br>";
    }
}
?>
</html>