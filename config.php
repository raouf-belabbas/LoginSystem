<?php

try{
    $bdd= new PDO("mysql:host=localhost;dbname=login_systeme","root","");
}catch(Exception $e){
    echo 'Error!: ' . $e->getMessage();
}

?>