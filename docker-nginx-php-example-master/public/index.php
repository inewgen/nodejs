<?php
$string = file_get_contents("../data/data-product-0.json");
$json_a = json_decode($string, true);

echo '<pre>';
print_r($json_a);
echo '</pre>';
