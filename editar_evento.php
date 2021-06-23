<?php
session_start();

//Incluir conexao com BD
include_once("conexao.php");

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);
$startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
$starttime = filter_input(INPUT_POST, 'starttime', FILTER_SANITIZE_STRING);
$endtime = filter_input(INPUT_POST, 'endtime', FILTER_SANITIZE_STRING);
$start = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_STRING);
$end = filter_input(INPUT_POST, 'end', FILTER_SANITIZE_STRING);
$procedimento = filter_input(INPUT_POST, 'procedimento', FILTER_SANITIZE_STRING);
$observacoes = filter_input(INPUT_POST, 'observacoes', FILTER_SANITIZE_STRING);

// if(!empty($id) && !empty($title) && !empty($color)  && !empty($startdate)){
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
	
	// $result_events = "UPDATE events SET procedimento='$procedimento', title='$title', color='$color', start='$start_sem_barra', end='$end_sem_barra', starttime='$starttime', startdate='$start_sem_hora', endtime='$endtime', observacoes='$observacoes' WHERE id='$id'"; 
	// $resultado_events = mysqli_query($conn, $result_events);

	$events = "UPDATE events SET start='$start_sem_barra', end='$end_sem_barra', starttime='$starttime', startdate='$start_sem_hora', endtime='$endtime' WHERE id='$id'";
	// $events = "UPDATE events SET procedimento='$procedimento', title='$title', color='$color', start='$start_sem_barra', end='$end_sem_barra', starttime='$starttime', startdate='$start_sem_hora', endtime='$endtime', observacoes='$observacoes' WHERE id='$id'";
	$update_events = $conn->prepare($events);
	$update_events->execute();
	header("Location: index.php");
	
	//Verificar se alterou no banco de dados através "mysqli_affected_rows"
// 	if(mysqli_affected_rows($conn)){
// 		$_SESSION['msg'] = "<div class='alert alert-success' role='alert'>O Evento editado com Sucesso<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
// 		header("Location: agenda.php");
// 	}else{
// 		$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao editar o evento <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
// 		header("Location: agenda.php");
// 	}
	
// 	}else{
// 	$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao editar o evento <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
// 	header("Location: agenda.php");
// }