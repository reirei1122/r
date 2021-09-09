<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_4-2</title>
    </head>
    <body>
        <?php
            //・データベース名:tb230363ad
            //・ユーザー名:tb-230363
            //・パスワード:edm4U2XCr6
            
            //DB接続設定
            $dsn = "mysql:adname = tb230363ad"; "host = localhost";
            $user = "tb-230363";
            $password = "edm4U2XCr6";
            
           
            
            //DB接続
            $pdo = new PDO($dsn, $user, $password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            
            //sql作成
            $sql = "CREATE TABLE IF NOT EXISTS tbtest"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT"
    .");";
    
     $stmt = $pdo->query($sql);
            
            
            
            
            
         

        ?>
    </body>