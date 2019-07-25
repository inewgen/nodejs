<?php
require('./MasterDataCPF.php');
$cpf = new MasterDataCPF();

$product = file_get_contents("../data/data-product-0.json");
$combo_product = file_get_contents("../data/data-combo-product-0.json");
$modify_group = file_get_contents("../data/data-modify-group-0.json");
$product_modify = file_get_contents("../data/data-product-modify-0.json");
$store = file_get_contents("../data/data-store-0.json");
$tax = file_get_contents("../data/data-tax-0.json");
$tender = file_get_contents("../data/data-tender-0.json");

$product = json_decode($product, true);
$combo_product = json_decode($combo_product, true);
$modify_group = json_decode($modify_group, true);
$product_modify = json_decode($product_modify, true);
$store = json_decode($store, true);
$tax = json_decode($tax, true);
$tender = json_decode($tender, true);

$product_map = $cpf->getProductMap($product);
$product_map_combo = $cpf->getProductMapCombo($product);
$product_ignore_combo = $cpf->getProductIgnoreCombo($product_map);

if ($_GET['show'] == 'product_recommend') {
	$response_data = $cpf->getProductRecomend($product_map_combo);

} elseif ($_GET['show'] == 'product_map_combo') {
	$response_data = $cpf->getProductMapCombo($product);

} elseif ($_GET['show'] == 'combo_product') {
	$response_data = $cpf->getComboProduct($combo_product, $product_ignore_combo);

} elseif ($_GET['show'] == 'modify_group') {
	$response_data = $cpf->getModifyGroup($modify_group, $product_ignore_combo);

} elseif ($_GET['show'] == 'product_modify') {
	$response_data = $cpf->getProductModify($product_modify, $product_ignore_combo);

} elseif ($_GET['show'] == 'store') {
	$response_data = $store;

} elseif ($_GET['show'] == 'tax') {
	$response_data = $tax;

} elseif ($_GET['show'] == 'tender') {
	$response_data = $tender;

} else {
	$response_data = $product_map;
}

$response = [
	"total" => count($response_data),
	"data" => $response_data
];

echo json_encode($response);
