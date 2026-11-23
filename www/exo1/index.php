<?php
// Tableau associatif (slide XX)
$etudiantsNote = [
    "JOHN"   => 9,
    "BOB"    => 15.5,
    "RAYANE" => 7,
    "ROSIE"  => 13
];

// Fonction (slide XX) : vrai si la note >= 10
function estAdmissible($note) {
    return $note >= 10;
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Exo1</title></head>
<body>
<table id="table1" border="1">
    <tr><th>Etudiant</th><th>Note</th></tr>
    <?php
    // Boucle foreach sur le tableau associatif (slide XX)
    foreach ($etudiantsNote as $nom => $note) {
        // Condition if/else (slide XX)
        if (estAdmissible($note)) {
            $couleur = "rgb(136,248,136)"; // vert
        } else {
            $couleur = "rgb(251,173,173)"; // rouge
        }
        echo "<tr class='row'>";
        echo "<td class='etud'>$nom</td>";
        echo "<td class='note' style='background-color:$couleur'>$note</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>