<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_5-1</title>
    </head>
    <body>
    <?php
        // DB接続設定
        $dsn = 'mysql:dbname=tb230367db;host=localhost';
        $user = 'tb-230367';
        $password = 'Pa3sTnasGn';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        // テーブル作成
        $sql = "CREATE TABLE IF NOT EXISTS message_board"
        ."("
        ."id INT AUTO_INCREMENT PRIMARY KEY,"
        ."name char(32),"
        ."comment TEXT,"
        ."date TIMESTAMP,"
        ."pass TEXT"
        .");";
        $stmt = $pdo->query($sql);

        // 投稿フォームに名前とコメントとパスワードが入っている&&編集対象番号が空だったら
        if(isset($_POST["name"]) && isset($_POST["comment"]) && isset($_POST["pass"]) && empty($_POST["edit_i"])) {
            // 名前を変数に入れる
            $name_new = $_POST["name"];
            // コメントを変数に入れる
            $comment_new = $_POST["comment"];
            // 投稿日時を変数に入れる
            $date_new = date("Y/m/d H:i:s");
            // パスワードを変数に入れる
            $pass_new = $_POST["pass"];
            
            // DB接続
            $dsn = 'mysql:dbname=tb230367db;host=localhost';
            $user = 'tb-230367';
            $password = 'Pa3sTnasGn';
            $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            // データ入力
            $sql = $pdo -> prepare("INSERT INTO message_board (name, comment, date, pass) VALUES (:name, :comment, :date, :pass)");
            $sql -> bindParam(':name', $name, PDO::PARAM_STR);
            $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
            $sql -> bindParam(':date', $date, PDO::PARAM_STR);
            $sql -> bindParam(':pass', $pass, PDO::PARAM_STR);
            $name = $name_new;
            $comment = $comment_new;
            $date = $date_new;
            $pass = $pass_new;
            $sql -> execute();
                
        } else if(isset($_POST["delete"]) && isset($_POST["del_pass"])) {  // フォームに削除番号と削除パスワードが入っていたら
            $delete = $_POST["delete"]; // 削除番号
            $del_pass = $_POST["del_pass"]; // 削除パスワード
            
            // DB接続
            $dsn = 'mysql:dbname=tb230367db;host=localhost';
            $user = 'tb-230367';
            $password = 'Pa3sTnasGn';
            $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            // データレコードを抽出
            $sql = 'SELECT * FROM message_board';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach($results as $row) {
                // 削除番号が正しくて、パスワードが正しかったら
                if($row['id'] == $delete && $row['pass'] == $del_pass) {
                    // データレコードを削除
                    $id = $delete;
                    $sql = 'delete from message_board where id=:id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);    
                    $stmt->execute();
                }
                // 削除番号が正しくて、パスワードが間違っている場合
                if($row['id'] == $delete && $row['pass'] != $del_pass) {
                    echo "<span>パスワードが違います。</span>";
                }
            }
                
        } else if(isset($_POST["edit"]) && isset($_POST["edit_pass"])) {  // 編集フォームに編集対象番号と編集パスワードが入っていたら
            $edit = $_POST["edit"]; // 編集対象番号
            $edit_pass = $_POST["edit_pass"]; // 編集パスワード
            
            // DB接続設定
            $dsn = 'mysql:dbname=tb230367db;host=localhost';
            $user = 'tb-230367';
            $password = 'Pa3sTnasGn';
            $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            // データレコード抽出
            $sql = 'SELECT * FROM message_board';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach($results as $row) {
                // 編集番号とパスワードが正しかったら
                if($row['id'] == $edit && $row['pass'] == $edit_pass) {
                    $edit_i = $row['id']; // 編集するidを変数に入れる
                    $edit_name = $row['name']; // 編集するnameを変数に入れる
                    $edit_comment = $row['comment']; // 編集するcommentを変数に入れる
                }
                // 編集番号が正しくて、パスワードが間違っていたら
                if($row['id'] == $edit && $row['pass'] != $edit_pass) {
                    $edit_pass = ""; // 編集パスワードを変数から除く
                    echo "<span>パスワードが違います。</span>";
                }
            }
                
        } else if(isset($_POST["name"]) && isset($_POST["comment"]) && isset($_POST["pass"]) && isset($_POST["edit_i"]))  { // 投稿フォームに編集対象番号が入っていたら
            $edited_i = $_POST["edit_i"]; // 編集番号
            $edited_name = $_POST["name"]; // 編集後の名前
            $edited_comment = $_POST["comment"]; // 編集後のコメント
            $edited_date = date("Y/m/d H:i:s"); // 編集時の時間
            $edited_pass = $_POST["pass"]; // 編集後のパスワード
            
            // DB接続設定
            $dsn = 'mysql:dbname=tb230367db;host=localhost';
            $user = 'tb-230367';
            $password = 'Pa3sTnasGn';
            $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            // データレコード抽出
            $sql = 'SELECT * FROM message_board';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach($results as $row) { 
                // 編集番号と投稿番号が等しかったら
                if($row['id'] == $edited_i) {          
                    // データ更新
                    $id = $edited_i; // id
                    $name = $edited_name; // 名前
                    $comment = $edited_comment; // コメント
                    $date = $edited_date; // 日付
                    $pass = $edited_pass; // パスワード
                    $sql = 'UPDATE message_board SET name=:name,comment=:comment,date=:date,pass=:pass WHERE id=:id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
                    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                }
            }
                
        }
    ?>
        
    <!-- この掲示板のテーマ -->
    <h2>これまでの振り返り</h2>
        
    <!-- 入力フォーム -->
    <form method="POST" action="">
        <input type="text" name="name" placeholder="名前" value="<?php if(isset($edit_name)) {echo $edit_name;} ?>" required><br>
        <input type="text" name="comment" placeholder="コメント" value="<?php if(isset($edit_comment)) {echo $edit_comment;} ?>" required><br>
        <input type="text" name="pass" placeholder="パスワード" value="<?php if(isset($edit_pass)) {echo $edit_pass;}?>" required><br>
        <input type="hidden" name="edit_i" value="<?php if(isset($edit_i)) {echo $edit_i;} ?>">
        <input type="submit" value="送信">
    </form><br>
        
    <!-- 削除フォーム -->
    <form method="POST" action="">
        <input type="number" name="delete" placeholder="削除対象番号"><br>
        <input type="text" name="del_pass" placeholder="パスワード"><br>
        <input type="submit" value="削除">
    </form><br>
        
    <!-- 編集フォーム-->
    <form method="POST" action="">
        <input type="number" name="edit" placeholder="編集対象番号"><br>
        <input type="text" name="edit_pass" placeholder="パスワード"><br>
        <input type="submit" value="編集">
    </form><br>
    -------------------------------------------------------------<br>
    [投稿一覧]<br>
        
    <?php
        // DB接続
        $dsn = 'mysql:dbname=tb230367db;host=localhost';
        $user = 'tb-230367';
        $password = 'Pa3sTnasGn';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        // データレコードを抽出し表示
        $sql = 'SELECT * FROM message_board';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row) {
            echo $row['id'].',';
            echo $row['name'].',';
            echo $row['comment'].',';
            echo $row['date'].'<br>';
            echo "<hr>";
        }

    ?>

    </body>
</html>