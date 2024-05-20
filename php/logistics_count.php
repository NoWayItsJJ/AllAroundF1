<?php 
    include 'security.php';
    include 'db.php';

    // Query per ottenere il conteggio totale dello staff
    $totalMovingSql = "SELECT COUNT(*) as total FROM logistica";
    $totalMovingResult = $conn->query($totalMovingSql);
    $totalMovingRow = $totalMovingResult->fetch_assoc();
    $totalMoving = $totalMovingRow['total'];

    // Stampa il conteggio totale dello staff
    echo'<div class="statistic" data-item-type="all">
            <div class="statistic-icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="statistic-data">
                <p>All</p>
            </div>
        </div>';

    $countSql = "SELECT tipo, COUNT(*) as contatore FROM logistica GROUP BY tipo";
    $countResult = $conn->query($countSql);

    if ($countResult->num_rows > 0) {
        while($row = $countResult->fetch_assoc()) {
            $numType = $row['contatore'];
            $tipoItem = $row['tipo'];

            $icon = '';
            if ($tipoItem == 'dipendente') {
                $icon = 'bi-person';
            } elseif($tipoItem == 'componente') {
                $icon = 'bi-gear';
            } elseif($tipoItem == 'articolo') {
                $icon = 'bi-box-seam';
            } else {
                $icon = 'bi-arrow-left-right';
            }

            echo'<div class="statistic" data-item-type="'.$tipoItem.'">
                    <div class="statistic-icon">
                        <i class="bi '.$icon.'"></i>
                    </div>
                    <div class="statistic-data">
                        <p>'.$tipoItem.' '.$numType.'</p>
                    </div>
                </div>';
        }
    }
    else
        header("Location: ../error.php")
?>