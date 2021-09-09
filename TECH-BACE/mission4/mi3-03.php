<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_3-3.php</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="text" name="a" placeholder="コメント"><br>
            <input type="text" name="b" placeholder="お名前入力してください"><br>
            <input type="submit" name="submit"><br>
            <input type="text" name="c" placeholder="削除対処番号"><br>
            <input type="submit" name="d" placeholder="送信"><br>
           
            
            
        </form>
        
        <?php
        error_reporting(E_ALL & ~E_NOTICE);
        $filename="mission_3_03.txt";
        $a=$_POST["a"];
        $b=$_POST["b"];
        $c=$_POST["c"];
    
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
        
        
        if(!empty($c)){
            $lines=file($filename);//ファイルの内容を所得する
            $fp=fopen($filename,"w");//ファイルを開き新たに書き出す（ファイルを空にする）
        foreach($lines as $line) {
        
        if($line[0]!=$c){
            fwrite($fp,$line);
        }else{
            
        }
        }
        fclose($fp);
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