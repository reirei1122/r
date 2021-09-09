<?php $number=3;
if($number%3==0 && $number%5==0){
    echo "FizzBuzz<br>";
}else if($number%3==0){
    echo "Fizz<br>";
}else if($number%5==0){
    echo  "Buzz<br>";
}else{
    echo $number."<br>";
}