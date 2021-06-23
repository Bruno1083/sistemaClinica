<?php
include_once 'conexao.php';

$id = $_POST['id'];
$startdate = $_POST['startdate'];
$starttime = $_POST['starttime'];
$endtime = $_POST['endtime'];
$start = $_POST['start'];
$end = $_POST['end'];

//Converter a data e hora do formato brasileiro para o formato do Banco de Dados
	$data = explode(" ", $startdate);
	list($date, $hora) = $data;
	$data_sem_hora = array_reverse(explode("/", $date));
	$data_sem_hora = implode("-", $data_sem_hora);
	$start_sem_hora = $data_sem_hora;

	$data = explode(" ", $start);
	list($date, $hora) = $data;
	$data_sem_barra = array_reverse(explode("/", $date));
	$data_sem_barra = implode("-", $data_sem_barra);
	$start_sem_barra = $data_sem_barra . " " . $hora;
	
	$data = explode(" ", $end);
	list($date, $hora) = $data;
	$data_sem_barra = array_reverse(explode("/", $date));
	$data_sem_barra = implode("-", $data_sem_barra);
	$end_sem_barra = $data_sem_barra . " " . $hora;

	$events = "UPDATE events SET start='$start_sem_barra', end='$end_sem_barra', starttime='$starttime', startdate='$start_sem_hora', endtime='$endtime' WHERE id='$id'";
	$update_events = $conn->prepare($events);
	$update_events->execute();
	header("Location: index.php");