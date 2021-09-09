<?php 
for($num=0;$num<=15;$num++){
    if($num%3==0 && $num%5==0){
        echo "FizzBuzz<br>";
    }else if($num%3==0){
        echo "Fizz<br>";
    }else if($num%5==0){
        echo "Buzz<br>";
    }else{
        echo $num."<br>";
    }
}
?>
<br>
<?php 
for($a=0;$a<=100;$a++){
    if($a%4==0 && $a%5==0){
        echo "伊藤　黎<br>";
    }else if($a%4==0){
        echo "伊藤<br>";
    }else if($a%5==0){
        echo "黎<br>";
    }else{
        echo $a."<br>";
    }
}
?>