<?php

try{

    $connection = new PDO("mysql:host=localhost;dbname=freelancerkz","root", "");


}catch (PDOException $e){
    echo $e->getMessage();
}

?>
