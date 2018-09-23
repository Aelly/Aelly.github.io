<h2>Transaction</h2>
<?php
$totalT = 0;
for($i = 0; $i < $size; $i++){
    $totalT += $total[$i];
}
$reference = number_format((float)$totalT / $size,2,'.','');

$difference = array();
for($i = 0; $i < $size; $i++){
    $difference[] = $reference - $total[$i];
}
while(!differenceNul($difference,$size)){
    for($i = 0; $i < $size; $i++){
        for($j = 0; $j < $size; $j++){
            if($difference[$i]>0 && $difference[$j]<0 && $i!=$j){
                //Cas i=j les deux sont mis à 0
                if($difference[$i] + $difference[$j] == 0){
                    echo $nom[$i] . " donne " . $difference[$i] . " à " . $nom[$j] . "<br/>";
                    $total[$i]+=$difference[$i];
                    $total[$j]-=$difference[$i];
                    $difference[$i] = $difference[$j] = 0;
                }

                //Cas i+j > 0 => j est totalement remboursé par i
                else if($difference[$i]+$difference[$j]>0){
                    echo $nom[$i] . " donne " . abs($difference[$j]) . " à " . $nom[$j] . "<br/>";
                    $total[$i]+=abs($difference[$j]);
                    $total[$j]-=abs($difference[$j]);
                    $difference[$i] += $difference[$j];
                    $difference[$j] = 0;
                }
                //Cas i+j < 0 => i donne tout ce qu'il a en trop
                else if($difference[$i] + $difference[$j] < 0){
                    echo $nom[$i] . " donne " . $difference[$i] . " à " . $nom[$j] . "<br/>";
                    $total[$i]+=$difference[$i];
                    $total[$j]-=$difference[$i];
                    $difference[$j] += $difference[$i];
                    $difference[$i] = 0;
                }
            }
        }
    }
}
function differenceNul(array $difference,$size){
    for($i = 0; $i < $size; $i++){
        if($difference[$i]>0.2 || $difference[$i]<-0.2){
            return false;
        }
    }
    return true;
}
?>

<h2>Total</h2>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Nom</th>
            <th>Total</th>
        </tr>
        <?php
        for($i = 0; $i < $size; $i++){
            echo "<tr>";
            echo "<td>" . $nom[$i] . "</td>";
            echo "<td>" . $total[$i] . "</td>";
            echo "</td>";
        }
        ?>
    </table>
</div>
