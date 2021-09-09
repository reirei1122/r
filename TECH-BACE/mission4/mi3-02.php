<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_3-1.php</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="text" name="comment" placeholder="コメント"><br>
            <input type="text" name="name" placeholder="お名前入力してください"><br>
            <input type="submit" name="submit"><br>
            <input type="text" name="delete" placeholder="削除対処番号"><br>
            <input type="submit" name="submit" placeholder="送信"><br>
            
        </form>
        
        <?php
        error_reporting(E_ALL & ~E_NOTICE);
        $filename="mission_3_02.txt";
        $comment=$_POST["comment"];
        $name=$_POST["name"];
        $delete=$_POST["delete"];
    
        $date=date("Y年m月d日");
        
        if(file_exists($filename)){
            $num=count(file($filename))+1;
        }else{
            $num=1;
        }
        
        $ndate=$num."<>".$comment."<>".$name."<>".$date;
        
        
        if(!empty($comment) ||!empty($name)){
            $fp=fopen($filename,"a");
            fwrite($fp,$ndate.PHP_EOL);
            fclose($fp);
        }
        
       
        
        if(!empty($delete)){
            
        }
        
        if(file_exists($filename)){
            $lines = file($filename,FILE_IGNORE_NEW_LINES);
        foreach($lines as $line ){
        $line=explode("<>",$line);
        echo $line[0];
        echo $line[1];
        echo $line[2];
        echo $line[3].PHP_EOL;
        
    }
}

        
        ?>
    </body>
</html>