
<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

echo "height = (";
foreach ($height as $nama => $tinggi) {
    echo "\"" . $nama . "\"=>" . "\"" . $tinggi . "\"";
    if ($nama != "Harry") {
        echo ", ";
    }
}
echo ")<br>";

echo "Nilai dengan indeks terakhir: " . end($height) . "<br><br>";

unset($height["Barry"]);

echo "height = (";
foreach ($height as $nama => $tinggi) {
    echo "\"" . $nama . "\"=>" . "\"" . $tinggi . "\"";
    if ($nama != "Harry") {
        echo ", ";
    }
}
echo ")<br>";

echo "Nilai dengan indeks terakhir setelah dihapus: " . end($height);
?>

<?php
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");

echo "weight = (";
foreach ($weight as $nama => $berat) {
    echo "\"" . $nama . "\"=>" . "\"" . $berat . "\"";
    if ($nama != "Charlie") {
        echo ", ";
    }
}
echo ")<br>";

$values = array_values($weight);

echo "Data kedua: " . $values[1];
?>
