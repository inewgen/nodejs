<?php
$product = file_get_contents("../data/data-product-0.json");
$product = json_decode($product, true);

$product_map = [];
foreach ($product['ITEMS'] as $key => $value) {

	unset($value['TAXES']);
	unset($value['ECOMMERCE_PRICE']);
	unset($value['CATEGORY_1']);
	unset($value['CATEGORY_2']);
	unset($value['CATEGORY_3']);
	unset($value['CATEGORY_4']);
	unset($value['DIMENSION_W']);
	unset($value['DIMENSION_H']);
	unset($value['DIMENSION_D']);
	unset($value['DIMENSION_UNIT']);
	unset($value['WEIGHT']);
	unset($value['WEIGHT_UNIT']);

	$hasCombo = false;
	foreach ($value['COMBO'] as $combo_key => $combo_item) {
		if (!empty($combo_item['COMBO_PRODUCTCODE']) && !is_null($combo_item['COMBO_PRODUCTCODE'])) {
			$value['COMBO'][$combo_key] = $combo_item;
			$hasCombo = true;
		} else {
			unset($value['COMBO'][$combo_key]);
		}
	}
	if (!$hasCombo) {
		unset($value['COMBO']);
	}
	$product_map[$value['PRODUCT_CODE']] = $value;
}
// echo json_encode($product_map);die();
$product_map2 = [];
$product_sub = [];
foreach ($product_map as $key2 => $value2) {
	$combo = $value2['COMBO'];
	if(is_array($combo)) {
		foreach ($combo as $key3 => $value3) {
			$COMBO_PRODUCTCODE = $value2['COMBO'][$key3]['COMBO_PRODUCTCODE'];
// print_r($value2['COMBO'][$key3]);die();
			unset($product_map[$key2]['COMBO']);

			$value2['COMBO'][$key3]['product'] = $product_map[$COMBO_PRODUCTCODE];
			if (!empty($COMBO_PRODUCTCODE)) {
				$product_sub[] = $COMBO_PRODUCTCODE;
			}
		}
	}
	$product_map2[$key2] = $value2;
}

foreach ($product_sub as $key4 => $value4) {
	unset($product_map2[$value4]);
}

$data = [
	"product" => $product['ITEMS']
];

function getProductRecomend($data)
{
	$result = [];
	foreach ($data as $key => $value) {
		if ($value['IS_COMBOSET'] == 'N') {
			$result[$key] = $value;
		}
	}

	return $result;
}
$product_recommend = getProductRecomend($product_map2);

$response_data = $product_recommend;
$response = [
	"total" => count($response_data),
	"data" => $response_data
];

echo json_encode($response);