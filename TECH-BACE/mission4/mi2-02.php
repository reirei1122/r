<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_2-1.php</title>
    </head>
    <body>
        <form action=""  method="post">
            <input type="text" name="a"  placeholder="コメント">
            <br>
            <input type="submit" name="submit" >
            <br>
            </form>
            
            <?php
            $filename="mission_2-2.txt";
            if(!empty($_POST["a"])){
            $a=$_POST["a"];
            $fp=fopen($filename,"a");
            fwrite($fp,$a.PHP_EOL);
            fclose($fp);
            echo $a."を受け付けました<br>";
            }
            
            if(file_exists($filename)){
                $lines=file($filename,FILE_IGNORE_NEW_LINES);
                foreach($lines as $line){
                   if($line="完成！"){
                      echo  "おめでとう<br>";
                    }
                }
            }
            
            ?>
    </body>
    </html>