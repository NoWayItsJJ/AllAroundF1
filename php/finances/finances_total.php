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
                <i class="bi bi-arrow-down-up"></i>
            </div>
            <div class="card-data">
                <p>Total budget</p>
                <span>'.$totalAccount.'€</span>
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

            echo'
                <div class="card">
                    <div class="card-icon">
                        <i class="bi '.$icon.'"></i>
                    </div>
                    <div class="card-data">
                        <p>Total '.$tipoTransazione.'</p>
                        <span>'.$numTransaction.'€</span>
                    </div>
                </div>';
        }
    }
    else
        header("Location: ../error.php")
?>