<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'consultorio');

$conn = new PDO('mysql:host=' . HOST. ';dbname='.DBNAME.';',USER, PASS);

    // $servidor = "localhost";
    // $usuario = "root";
    // $senha = "";
    // // $dbname = "risum";
    // $dbname = "consultorio";

    // //Criar conexao
    // $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

    