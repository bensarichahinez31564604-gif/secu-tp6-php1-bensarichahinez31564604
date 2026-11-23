<?php
// Tableau associatif de tableaux associatifs (slide XX)
$serveurs = [
    "api-01"   => ["cpu" => 45, "ram" => 60, "status" => "1"],
    "api-02"   => ["cpu" => 92, "ram" => 78, "status" => "1"],
    "db-prod"  => ["cpu" => 70, "ram" => 95, "status" => "1"],
    "web-01"   => ["cpu" => 30, "ram" => 40, "status" => "1"],
    "web-02"   => ["cpu" => 55, "ram" => 65, "status" => "0"],
    "cache-01" => ["cpu" => 88, "ram" => 92, "status" => "1"]
];

// Fonctions (slide XX)
function calculerScore($cpu, $ram) {
    return 100 - ($cpu + $ram) / 2;
}
function estCritique($cpu, $ram) {
    return $cpu > 85 || $ram > 90;
}

// Variables du résumé
$totalOnline = 0;
$sommeScores = 0;
$bestScore   = -1;
$bestNom     = "";
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Exo2</title></head>
<body>
<table id="table1" border="1">
    <tr>
        <th>Serveur</th><th>CPU%</th><th>RAM%</th>
        <th>Status</th><th>Score</th><th>État</th>
    </tr>
    <?php
    // Boucle foreach (slide XX)
    foreach ($serveurs as $nom => $s) {
        $cpu = $s["cpu"];
        $ram = $s["ram"];
        $online = ($s["status"] == "1");
        $score = calculerScore($cpu, $ram);
        $critique = estCritique($cpu, $ram);

        // État affiché (slide XX : conditions)
        if ($critique) {
            $etat = "CRITIQUE";
        } elseif ($score >= 50) {
            $etat = "OK";
        } else {
            $etat = "ATTENTION";
        }

        // Couleur de la ligne : l'ordre des conditions compte
        if (!$online) {
            $couleur = "rgb(200,200,200)";      // gris
        } elseif ($critique) {
            $couleur = "rgb(255,180,180)";      // rouge
        } elseif ($score >= 50) {
            $couleur = "rgb(180,255,180)";      // vert
        } else {
            $couleur = "rgb(255,220,150)";      // orange
        }

        // Calculs pour le résumé
        $sommeScores += $score;
        if ($online) {
            $totalOnline++;
            if ($score > $bestScore) {
                $bestScore = $score;
                $bestNom = $nom;
            }
        }

        $statusTxt = $online ? "online" : "offline";

        echo "<tr class='row' style='background-color:$couleur'>";
        echo "<td class='serveur'>$nom</td>";
        echo "<td class='cpu'>$cpu</td>";
        echo "<td class='ram'>$ram</td>";
        echo "<td class='status'>$statusTxt</td>";
        echo "<td class='score'>$score</td>";
        echo "<td class='etat'>$etat</td>";
        echo "</tr>";
    }
    // Moyenne des scores (count : slide XX)
    $moyenne = $sommeScores / count($serveurs);
    ?>
</table>

<h3>Résumé</h3>
<p>Serveurs online: <span id="total_online_servers"><?php echo $totalOnline; ?></span></p>
<p>Score moyen: <span id="moy_scores"><?php echo $moyenne; ?></span></p>
<p>Meilleur serveur: <span id="best_serv"><?php echo "$bestNom ($bestScore)"; ?></span></p>
</body>
</html>