<?php 
    include 'security.php';
    include 'db.php';

    // Query per ottenere il conteggio totale dello Transaction
    $totalAccountSql = "SELECT SUM(importo) as total FROM finanze";
    $totalAccountResult = $conn->query($totalAccountSql);
    $totalAccountRow = $totalAccountResult->fetch_assoc();
    $totalAccount = $totalAccountRow['total'];

    // Stampa il conteggio totale delle transazioni
    echo'<div class="statistic">
            <div class="statistic-data">
                <p>All</p>
                <h2><strong>€'.$totalAccount.'</strong></h2>
            </div>
        </div>';

    $countEntrateSql = "SELECT tipo, SUM(importo) as contatore FROM finanze GROUP BY tipo";
    $countResult = $conn->query($countEntrateSql);

    if ($countResult->num_rows > 0) {
        while($row = $countResult->fetch_assoc()) {
            $numTransaction = $row['contatore'];
            $tipoTransazione = $row['tipo'];

            $icon = '';
            if ($tipoTransazione == 'entrata') {
                $icon = 'bi-arrow-down';
            } elseif($tipoTransazione == 'uscita') {
                $icon = 'bi-arrow-up';
            } else {
                $icon = 'bi-arrow-left-right';
            }

            echo'<div class="statistic" data-transaction-name="'.$tipoTransazione.'">
                    <div class="statistic-icon">
                        <i class="bi '.$icon.'"></i>
                    </div>
                    <div class="statistic-data">
                        <h2><strong>'.$numTransaction.'</strong></h2>
                        <p>'.$tipoTransazione.'</p>
                    </div>
                </div>';
        }
    }
    else
        header("Location: ../error.php")
?>