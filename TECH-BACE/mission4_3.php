        <?php
            //・データベース名:tb230363ab
            //・ユーザー名:tb-230363
            //・パスワード:edm4U2XCr6
            
        
            
            //DB接続設定
            $dsn="mysql:dbname=tb230363ab;host=localhost";
            $user="tb-230363";
            $password="edm4U2XCr6";
            
            
            //DBへ接続
            $pdo=new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));//接続
            
            //SQL作成
            $sql="CREATE TABLE IF NOT EXISTS tbtest(id INT AUTO_INCREMENT PRIMARY KEY,name CHAR(32),comment TEXT)";
            
            //SQL実行
            $stmt=$pdo->query($sql);
            
        　　//テーブル一覧を表示
        　　$sql="SHOW TABLES";
            $result=$pdo->query($sql);
            foreach ($result as $row){
                echo $row[0];
                echo "<br>";
            }
            echo "<hr>";
    
       
        ?>