<?php 
    include 'security.php';
    include 'db.php';

    $countSql = "SELECT 
                    CASE 
                        WHEN utenti.fk_id_ruolo IN (2, 3) THEN 'Ingegneri'
                        ELSE ruoli.nome_ruolo
                    END AS nome_ruolo,
                    COUNT(utenti.fk_id_ruolo) as contatore 
                 FROM utenti 
                 INNER JOIN ruoli ON utenti.fk_id_ruolo = ruoli.id_ruolo
                 WHERE utenti.fk_id_ruolo NOT IN (5)
                 GROUP BY CASE 
                             WHEN utenti.fk_id_ruolo IN (2, 3) THEN 'Ingegneri'
                             ELSE ruoli.nome_ruolo
                          END";
    $countResult = $conn->query($countSql);

    if ($countResult->num_rows > 0) {
        while($row = $countResult->fetch_assoc()) {
            $numstaff = $row['contatore'];
            $nomeruolo = $row['nome_ruolo'];

            $icon = '';
            if ($nomeruolo == 'dirigente') {
                $icon = 'bi-shield-lock';
            } elseif ($nomeruolo == 'pilota') {
                $icon = 'bi-pencil-square';
            } elseif ($nomeruolo == 'ingegnere di pista') {
                $icon = 'bi-person-check';
            } elseif ($nomeruolo == 'ingegnere meccanico') {
                $icon = 'bi-person-check';
            } else {
                $icon = 'bi-people';
            }

            echo'<div class="statistic">
                    <div class="statistic-icon">
                        <i class="bi '.$icon.'"></i>
                    </div>
                    <div class="statistic-data">
                        <h2><strong>'.$numstaff.'</strong></h2>
                        <p>'.$nomeruolo.'</p>
                    </div>
                </div>';
        }
    }
    else
        header("Location: ../error.php")
?>