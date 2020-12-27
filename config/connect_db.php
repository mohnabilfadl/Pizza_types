<?php
// Make a connection

$DBHOST = 'localhost';
$DBUSER = 'mido';
$DBPASS = '1997';
$DBNAME = 'pizzas';



$connect = mysqli_connect($DBHOST , $DBUSER , $DBPASS ,$DBNAME );
if(!$connect){
    echo 'Connection erorr'.mysqli_connect_error();
    }
 
?>