<?php
$id = "";

for ($x = 0; $x < 4; $x++) {
    for ($y = 0; $y < 4; $y++) {
        $id = $id . rand(0, 9);
    }
    $id = $id . "-";
}
for ($y = 0; $y < 4; $y++) {
    $id = $id . rand(0, 9);
}

echo $id;
echo "\n";
?>