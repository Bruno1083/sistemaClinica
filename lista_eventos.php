<?php
include_once("conexao.php");

$query_events = "SELECT id, title, color, start, procedimento, end, starttime, startdate, endtime, observacoes, dentista_id FROM events";
$resultado_events = $conn->prepare($query_events);
$resultado_events->execute();

$eventos = [];

while($row_events = $resultado_events->fetch(PDO::FETCH_ASSOC)){
       
    $id = $row_events['id'];
    $title = $row_events['title']; 
    $color = $row_events['color'];
    $start = $row_events['start'];
    $end = $row_events['end'];
    $endtime = $row_events['endtime'];
    $starttime = $row_events['starttime'];
    $procedimento = $row_events['procedimento'];
    $observacoes = $row_events['observacoes'];
    $dentista_id = $row_events['dentista_id']; 

    $eventos[] = [
        'id' => $id,
        'title' => $title,
        'color' => $color,
        'start' => $start,
        'end' => $end,
        'endtime' => $endtime,
        'starttime' => $starttime,
        'procedimento' => $procedimento,
        'observacoes' => $observacoes,
        'dentista_id' => $dentista_id,
    ];
    
}

echo json_encode($eventos);