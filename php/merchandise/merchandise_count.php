<?php 
    include __DIR__ . '/../security.php';
    include __DIR__ . '/../db.php';

    echo'<div class="statistic" data-role-id="all">
            <div class="statistic-icon">
                <i class="fa-regular fa-user-group"></i>
            </div>
            <div class="statistic-data">
                <p>All</p>
            </div>
        </div>';

        $countSql = "SELECT COUNT(id_articolo) as contatore, tipologia FROM articoli GROUP BY tipologia";
            $countResult = $conn->query($countSql);

    if ($countResult->num_rows > 0) {
        while($row = $countResult->fetch_assoc()) {
            $numstaff = $row['contatore'];
            $tipologia = $row['tipologia'];

            $icon = '';
            if ($tipologia == 'cappellino') {
                $icon = '<i class="fa-regular fa-user-secret"></i>';
            } elseif ($tipologia == 'maglietta') {
                $icon = '<i class="fa-regular fa-bullhorn"></i>';
            } elseif ($tipologia == 'felpa') {
                $icon = '<i class="fa-kit fa-driver-helmet"></i>';
            } elseif ($tipologia == 'bomber') {
                $icon = '<i class="fa-regular fa-user-tie-hair"></i>';
            } else {
                $icon = '<i class="fa-regular fa-user"></i>';
            }
                

            echo'<div class="statistic" data-article-type="'.$tipologia.'">
                    <div class="statistic-icon">
                        '.$icon.'
                    </div>
                    <div class="statistic-data">
                        <p>'.$tipologia.' <strong>'.$numstaff.'</strong></p>
                    </div>
                </div>';
        }
    }
    else
        header("Location: ../error.php")
?>