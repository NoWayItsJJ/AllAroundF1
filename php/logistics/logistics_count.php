<?php 
    include __DIR__ . '/../security.php';
    include __DIR__ . '/../db.php';

    // Query per ottenere il conteggio totale dello staff
    $totalMovingSql = "SELECT COUNT(*) as total FROM logistica";
    $totalMovingResult = $conn->query($totalMovingSql);
    $totalMovingRow = $totalMovingResult->fetch_assoc();
    $totalMoving = $totalMovingRow['total'];

    // Stampa il conteggio totale dello staff
    echo'<div class="statistic" data-item-type="all">
            <div class="statistic-icon">
                <i class="fa-regular fa-cart-flatbed-boxes"></i>
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
                $icon = '<i class="fa-regular fa-user"></i>';
            } elseif($tipoItem == 'componente') {
                $icon = '<i class="fa-regular fa-engine"></i>';
            } elseif($tipoItem == 'articolo') {
                $icon = '<i class="fa-regular fa-boxes-stacked"></i>';
            } else {
                $icon = '<i class="fa-regular fa-cart-flatbed-empty"></i>';
            }

            echo'<div class="statistic" data-item-type="'.$tipoItem.'">
                    <div class="statistic-icon">
                        '.$icon.'
                    </div>
                    <div class="statistic-data">
                        <p>'.ucfirst($tipoItem).' '.$numType.'</p>
                    </div>
                </div>';
        }
    }
    else
        header("Location: ../error.php")
?>