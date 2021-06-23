<?php
session_start();

//Incluir conexao com BD
include_once("conexao.php");
if(isset($_POST['dentista_id'])){
	$dentista_id = $_POST['dentista_id'];
 }
// $dentista_id = $_POST['dentista_id'];
$procedimento = filter_input(INPUT_POST, 'procedimento', FILTER_SANITIZE_STRING);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);
$start = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_STRING);
$end = filter_input(INPUT_POST, 'end', FILTER_SANITIZE_STRING);
$starttime = filter_input(INPUT_POST, 'starttime', FILTER_SANITIZE_STRING);
$startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
$endtime = filter_input(INPUT_POST, 'endtime', FILTER_SANITIZE_STRING);
$observacoes = filter_input(INPUT_POST, 'observacoes', FILTER_SANITIZE_STRING);

if(!empty($title) && !empty($color)  && !empty($startdate) ){

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
	
	$result_events = "INSERT INTO events(title, color, startdate, starttime, endtime, start, end, procedimento, observacoes, dentista_id ) VALUES ( '$title', '$color','$start_sem_hora','$starttime', '$endtime', '$start_sem_barra', '$end_sem_barra', '$procedimento', '$observacoes', '$dentista_id')";
	$resultado_events = $conn->prepare($result_events);
	$resultado_events->execute();
	
	header("Location: index.php");
	// $result_events = "INSERT INTO events (dentistas_id, procedimento, title, color, start, end,  starttime, startdate, endtime, observacoes ) VALUES ('$dentista_id','$procedimento', '$title', '$color', '$start_sem_barra', '$end_sem_barra', '$starttime', '$start_sem_hora', '$endtime', '$observacoes' )";
	// $resultado_events = mysqli_query($conn, $result_events);
	
	//Verificar se salvou no banco de dados através "mysqli_insert_id" o qual verifica se existe o ID do último dado inserido
// 	if(mysqli_insert_id($conn)){
// 		$_SESSION['msg'] = "<div class='alert alert-success' role='alert'>O Evento Cadastrado com Sucesso<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
// 		header("Location: index.php");
// 	}else{
// 		$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao cadastrar o evento <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
// 		header("Location: index.php");
// 	}
	
// }else{
// 	$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao cadastrar o evento <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
// 		header("Location: index.php");
 }