<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_3-5</title>
    </head>
    <body>
        <?php
            error_reporting(E_ALL & ~ E_NOTICE);
            //書き込むファイルを決める
            $filename = "mission3-5.txt";
            
            //投稿フォームに名前とコメントとパスワードが入っている&&編集対象番号が空だったら新規投稿処理
            if(isset($_POST["name"]) && isset($_POST["comment"]) && isset($_POST["pass1"]) && empty($_POST["edit"])){
                //名前を変数に入れる
                $name = $_POST["name"];
                //コメントを変数に入れる
                $comment = $_POST["comment"];
                //投稿日時を変数に入れる
                $date = date("Y/m/d/ H:i:s");
                //パスワードを変数に入れる
                $pass1=$_POST["pass1"];
                
                //投稿番号を変数に入れる
                //ファイルが存在していたら
                if(file_exists($filename)) {
                    $file_date = file($filename, FILE_IGNORE_NEW_LINES);
                    //データの行数が0でなかったら
                    if(count($file_date) != 0){
                        //最終行を所得
                        $get_line = $file_date[count($file_date)- 1];
                        //explode関数で要素に分解
                        $get_line = explode("<>", $get_line);
                        //最終行の投稿番号に1を足したものが次の投稿番号
                        $num =$get_line[0] + 1;
                        //データの行数が0だったら
                        //投稿番号は1
                    } else {
                        $num = 1;
                    }
                // ファイルが存在していなかったら
                // 投稿番号は1
                } else {
                    $num = 1;
                }
            
                //5つの変数を結合して変数に入れる
                $newdate = $num."<>".$name."<>".$comment."<>".$date."<>".$pass1."<>";
            
            
                //追記モードでファイルに書き込む
                $fp = fopen($filename, "a");
                //ファイルに書き込む
                fwrite($fp, $newdate.PHP_EOL);
                //ファイルを閉じる
                fclose($fp);
            
            // フォームに削除番号が入っていたら削除処理   
            } else if(isset($_POST["delete"]) && isset($_POST["pass2"])) {
                //削除番号を変数に入れる
                $delete=$_POST["delete"];
                //パスワードを変数に入れる
                $pass2=$_POST["pass2"];
                //ファイルを配列に格納
                $lines = file($filename, FILE_IGNORE_NEW_LINES);
                //ファイルを上書きモード
                $fp=fopen($filename,"w");
                //配列の全要素に関して繰り返す
                foreach ($lines as $line){
                    //explode関数で要素に分解
                    $line=explode("<>",$line);
                    //削除番号と投稿番号が一致した場合&&パスワードが一致した場合
                    if($line[0]==$delete && $line[4]==$pass2){
                        //ループ処理をスキップする（conitnue文）
                        continue;
                        
                    }else{
                        //分割した要素からファイルに書き込む文章を作り
                        $r=$line[0]."<>".$line[1]."<>".$line[2]."<>".$line[3]."<>".$line[4]."<>";
                        //ファイルに行内容を書き込む
                        fwrite($fp,$r.PHP_EOL);
                    }
                    
                    //削除番号と投稿番号が一致した場合&&パスワードが一致しない場合
                    if($line[0]==$delete && $line[4]!=$pass2){
                        //エラーメッセージを表示
                        echo "error";
                    }
                }
                //ファイルを閉じる
                fclose($fp);
        
            //編集フォームに編集対象番号が入っていたらフォームに編集対象箇所を表示する処理
            }else if(isset($_POST["editnumber"]) && isset($_POST["pass3"])){
                //編集番号を変数に入れる
                $editnumber=$_POST["editnumber"];
                //パスワードを変数に入れる
                $pass3=$_POST["pass3"];
                //ファイルを配列に入れる
                $lines=file($filename);
                //配列の全要素に関して繰り返す
                foreach($lines as $line){
                    //explode関数で要素に分割
                    $line=explode("<>",$line);
                    //編集対象番号と投稿番号が等しい場合&&パスワードが一致した場合
                    if($line[0]===$editnumber && $line[4]===$pass3){
                        //編集する投稿番号を変数に入れる
                        $edit=$line[0];
                        //編集する名前を変数に入れる
                        $edit_name=$line[1];
                        //編集するコメントを変数に入れる
                        $edit_comment=$line[2];
                        //編集するパスワードを変数に入れる
                        $edit_password=$line[4];
                    
                    //パスワードが一致しない場合
                    }else if( $line[0]=== $editnumber && $line[4]!== $pass3){
                        //パスワードから変数を除くとき
                        
                        //エラーメッセージを表示
                        echo "error";
                    }
                    
                }
        
        
            //投稿フォームに名前とコメントが入っている&&編集対象番号が入っていたら編集実行処理
            } else if(isset($_POST["comment"]) && isset($_POST["name"]) && isset($_POST["pass1"]) && isset($_POST["edit"])) {
                
                //編集番号を変数に入れる
                $edit=$_POST["edit"];
                //編集後の名前を変数に入れる
                $edit_name=$_POST["name"];
                //編集後のコメントを変数に入れる
                $edit_comment=$_POST["comment"];
                //編集時の時間を変数に入れる
                $edit_date=date("Y/m/d/ H:i:s");
                //編集時のパスワードを変数に入れる
                $edit_password=$_POST["pass1"];
                //ファイルを配列に格納
                $lines=file($filename);
                //配列の全要素に分解
                foreach($lines as $line){
                    //explode関数で要素に分解
                    $line=explode("<>",$line);
                    //編集番号と投稿番号が等しい場合&&パスワードが同じ場合
                    if($edit==$line[0] && $line[4]==$edit_password){
                        //データ要素に書き換える
                        //名前の要素を書き換える
                        $line[1]=$edit_name;
                        //コメントの要素を書き換える
                        $line[2]=$edit_comment;
                        //日時の要素を書き換える
                        $line[3]=$edit_date;
                        //パスワードの要素を書き換える
                        $line[4]=$edit_password;
                    }
                    //出力用の配列に格納
                    $newLines[] = implode("<>",$line);
                }
                //ファイルへの書き込み
                file_put_contents($filename, implode($newLines));
                
                //最後に改行を追記
                file_put_contents($filename,PHP_EOL,FILE_APPEND);
            }
          
        ?>
      
        <form method="POST" action="">
            投稿フォーム<br>
            <input type="text" name="name" placeholder="名前" value="<?php if(isset($edit_name)){ echo $edit_name;}?>"><br>
            <input type"text" name="comment" placeholder="コメント" value="<?php if (isset ($edit_comment)){echo $edit_comment;}?>"><br>
            <input type="text" name="pass1" placeholder="パスワード" value="<?php if(isset($pass3)){echo $pass3;}?>"><br>
            <input type="hidden" name="edit" value="<?php if(isset($edit)) {echo $edit;}?>" >
            <input type="submit" value="送信">
        </form><br>
        
        <form method="POST" action="">
            削除フォーム<br>
            <input type="text" name="delete" placeholder="削除対象番号"><br>
            <input type="text" name="pass2" placeholder="パスワード"><br>
            <input type="submit" value="削除"><br>
        
        </form><br>
        
        <form method="POST" action="">
            編集フォーム<br>
            <input type="text" name="editnumber" placeholder="編集対象番号"><br>
            <input type="text" name="pass3" placeholder="パスワード"><br>
            <input type="submit" name="submit" value="編集">
        </form><br>
    
        <?php 
        
            
            //ファイルの内容を表示
            //ファイルが存在していたら
            if(file_exists($filename)){
                //ファイルを配列に入れる
                $lines=file($filename);
                //配列の全要素に関して繰り返す
                foreach($lines as $line){
                    //explode関数で要素に分解
                    $line=explode("<>",$line);
                    //要素を出力
                    echo $line[0];
                    echo $line[1];
                    echo $line[2];
                    echo $line[3]."<br>";
                }
            }
        ?>
        
    </body>
</html>