
<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

echo "height = (";
foreach ($height as $nama => $tinggi) {
    echo "\"" . $nama . "\"=>\"" . $tinggi . "\"";
    if ($nama != "Harry") {
        echo ", ";
    }
}
echo ")<br><br>";

foreach ($height as $nama => $tinggi) {
    echo $nama . " is " . $tinggi . " cm tall.<br>";
}
?>

<?php
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");

echo "weight = (";
foreach ($weight as $nama => $berat) {
    echo "\"" . $nama . "\"=>\"" . $berat . "\"";
    if ($nama != "Charlie") {
        echo ", ";
    }
}
echo ")<br><br>";

$nama = array_keys($weight);
$berat = array_values($weight);

for ($i = 0; $i < count($weight); $i++) {
    echo $nama[$i] . " is " . $berat[$i] . " kg.<br>";
}
?>
