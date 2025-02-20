<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
$capaciteit = $_POST['capaciteit'];
$melder = $_POST['melder'];
$type = $_POST['type'];
$overig = $_POST['overig'];
$gemeld_op = $_POST['gemeld_op'];
if(isset($_POST['prioriteit'])){
    $prioriteit = 1;
}
else{
    $prioriteit = 0;
}


if(empty($attractie)){
    $errors[]="Vul de naam van de attractie in.";
}

if(empty($type)){
    $errors[]="Vul een geldige type voor de attractie in.";
}

if(!is_numeric($capaciteit)){
    $errors[]="Vul voor capaciteit een geldig getal in.";
}

if(empty($melder)){
    $errors[]="Vul de naam van de melder in.";
}

if(isset($errors)) {
    var_dump($errors);
    exit();
}

//1. Verbinding
require_once '../../../config/conn.php';

//2. Query
$query="INSERT INTO meldingen (attractie, capaciteit, melder, prioriteit, type, overige_info, gemeld_op) VALUES(:attractie, :capaciteit, :melder, :prioriteit, :type, :overige_info, :gemeld_op)";

//3. Prepare
$statement = $conn->prepare($query);

//4. Execute
$statement->execute([
    ":attractie" => $attractie,
    ":capaciteit" => $capaciteit,
    ":melder" => $melder,
    ":prioriteit" => $prioriteit,
    ":type"  => $type,
    "gemeld_op" => $gemeld_op,
    
    ":overige_info"  => $overig
    ]);

    header("Location: ../../../resources/views/meldingen/index.php?msg=Melding opgeslagen");