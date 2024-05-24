<?php
// Connessione al database
require_once('db.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'getBalance':
            getBalance($conn);
            break;

        case 'getIncome':
            getIncome($conn);
            break;

        case 'getLastTransaction':
            getLastTransaction($conn);
            break;

        case 'getStaffNumbers':
            getStaffNumbers($conn);
            break;

        case 'getStaffList':
            getStaffList($_POST['idRuolo'], $conn);
            break;

        case 'getTransportList':
            getTransportList($_POST['transport'], $conn);
            break;

        default:
            echo json_encode(array('error' => 'Invalid action'));
            break;
    }
} else {
    echo json_encode(array('error' => 'No action specified'));
}

function getBalance($conn) {
    $stmt = $conn->prepare("SELECT sum(importo) as balance FROM finanze");
    $stmt->execute();

    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $balance = $row['balance'];
    }

    if($result->num_rows > 0){
        echo json_encode(array('getBalance' => true, 'balance' => $balance));
    } else {
        echo json_encode(array('getBalance' => false));
    }
}

function getIncome($conn) {
    $stmt = $conn->prepare("SELECT sum(importo) as income FROM finanze WHERE tipo = 'Entrata'");
    $stmt->execute();

    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $income = $row['income'];
    }

    if($result->num_rows > 0){
        echo json_encode(array('getIncome' => true, 'income' => $income));
    } else {
        echo json_encode(array('getIncome' => false));
    }
}

function getLastTransaction($conn) {
    $stmt = $conn->prepare("SELECT importo FROM finanze ORDER BY id_transazione DESC LIMIT 1");
    $stmt->execute();

    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $lastTransaction = $row['importo'];
    }

    if($result->num_rows > 0){
        echo json_encode(array('getLastTransaction' => true, 'lastTransaction' => $lastTransaction));
    } else {
        echo json_encode(array('getLastTransaction' => false));
    }
}

function getStaffNumbers($conn) {
    $engineersStmt = $conn->prepare("SELECT count(*) as total FROM utenti WHERE fk_id_ruolo IN (2,3)");
    $engineersStmt->execute();
    $engineersStmtResult = $engineersStmt->get_result();
    while ($row = $engineersStmtResult->fetch_assoc()) {
        $engineers = $row['total'];
    }

    $marketingStmt = $conn->prepare("SELECT count(*) as total FROM utenti WHERE fk_id_ruolo = 7");
    $marketingStmt->execute();
    $marketingStmtResult = $marketingStmt->get_result();
    while ($row = $marketingStmtResult->fetch_assoc()) {
        $marketing = $row['total'];
    }

    $adminsStmt = $conn->prepare("SELECT count(*) as total FROM utenti WHERE fk_id_ruolo = 4");
    $adminsStmt->execute();
    $adminsStmtResult = $adminsStmt->get_result();
    while ($row = $adminsStmtResult->fetch_assoc()) {
        $admins = $row['total'];
    }

    if($adminsStmtResult->num_rows > 0){
        echo json_encode(array('getStaffNumbers' => true, 'engineers' => $engineers, 'marketing' => $marketing, 'admins' => $admins));
    } else {
        echo json_encode(array('getStaffNumbers' => false));
    }
}

function getStaffList($id, $conn) {
    if($id == 2)
    {
        $sql = "SELECT utenti.id_utente, utenti.nome, utenti.cognome, ruoli.nome_ruolo 
                FROM utenti 
                JOIN ruoli ON utenti.fk_id_ruolo = ruoli.id_ruolo
                WHERE fk_id_ruolo IN (2,3)";
    } else {
        $sql = "SELECT utenti.id_utente, utenti.nome, utenti.cognome, ruoli.nome_ruolo 
                FROM utenti 
                JOIN ruoli ON utenti.fk_id_ruolo = ruoli.id_ruolo
                WHERE fk_id_ruolo = $id";
    }

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $staffList[] = $row;
    }

    if($result->num_rows > 0){
        echo json_encode(array('getStaffList' => true, 'staff' => $staffList));
    } else {
        echo json_encode(array('getStaffList' => false));
    }
}

function getTransportList($transport, $conn) {
    $sql = "SELECT partenza, destinazione, mezzo_trasporto, tipo, fk_id_item
            FROM logistica
            WHERE mezzo_trasporto = '$transport'";

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $transportList[] = $row;
        switch($row['tipo']){
            case '1':
                $transportList['tipo'] = 'Arrivo';
                break;
            case '2':
                $transportList['tipo'] = 'Partenza';
                break;
        }
    }

    if($result->num_rows > 0){
        echo json_encode(array('getTransportList' => true, 'transport' => $transportList));
    } else {
        echo json_encode(array('getTransportList' => false));
    }
}