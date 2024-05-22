<?php 
    include __DIR__ . '/../security.php';
    include __DIR__ . '/../db.php';

    // Query per ottenere il conteggio totale dello Transaction
    $totalAccountSql = "SELECT SUM(importo) as total FROM finanze";
    $totalAccountResult = $conn->query($totalAccountSql);
    $totalAccountRow = $totalAccountResult->fetch_assoc();
    $totalAccount = $totalAccountRow['total'];

    // Stampa il conteggio totale delle transazioni
    echo'
        <div class="card">
            <div class="card-icon">
                <i class="fa-regular fa-building-columns"></i>
            </div>
            <div class="card-data">
                <p>Total budget</p>
                <span>'.$totalAccount.' &euro;</span>
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
                $icon = '<i class="fa-regular fa-arrow-trend-up"></i>';
            } elseif($tipoTransazione == 'uscita') {
                $icon = '<i class="fa-regular fa-arrow-trend-down"></i>';
            } else {
                $icon = '<i class="fa-regular fa-money-bill"></i>';
            }

            echo'
                <div class="card">
                    <div class="card-icon">
                        '.$icon.'
                    </div>
                    <div class="card-data">
                        <p>Total '.$tipoTransazione.'</p>
                        <span>'.$numTransaction.' &euro;</span>
                    </div>
                </div>';
        }
    }
    else
        header("Location: ../error.php")
?>