<?php 
    include 'security.php';
    include 'db.php';

    if(isset($role))
    {
        $countSql = "SELECT fk_id_ruolo, COUNT(fk_id_ruolo) as contatore 
                     FROM utenti 
                     GROUP BY fk_id_ruolo
                     HAVING fk_id_ruolo = $role";
        $countResult = $conn->query($countSql);

        if ($countResult->num_rows > 0) {
            while($row = $countResult->fetch_assoc()) {
                echo $row['contatore'];
            }
        }
    }
    else
        header("Location: ../error.php")
?>