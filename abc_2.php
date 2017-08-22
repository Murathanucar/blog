<?php
echo "<table border ='1' width ='200px'>";
echo "<tr>";
echo "<th> Sayi</th>";
echo "<th> Karesi</th>";
echo "<tr>";
for($i=1;$i<=20;$i++){
    echo"<tr>";
    echo"<td>$i</td>";
    echo"<td>",$i*$i,"</td";
    echo"</tr>";
}

echo "</table>";
?>