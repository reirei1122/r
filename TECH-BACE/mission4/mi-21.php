<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mi1-21</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="number" name="a" placeholder="数字を入力してください">
            <br>
            <input type="submit" name="b">
        </form>
        <?php
        $a=$_POST["a"];
        if($a%3==0 && $a%5==0){
            echo "FizzBuzz<br>";
        }else if($a%3==0){
            echo "Fizz<br>";
        }else if($a%5==0){
            echo "Buzz<br>";
        }else{
            echo $a."<br>";
        }
        ?>
    </body>
</html>