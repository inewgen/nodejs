<?php
$product = file_get_contents("../data/data-product-0.json");
$product = json_decode($product, true);

$product_map = [];
foreach ($product['ITEMS'] as $key => $product_item) {

	unset($product_item['TAXES']);
	unset($product_item['ECOMMERCE_PRICE']);
	unset($product_item['CATEGORY_1']);
	unset($product_item['CATEGORY_2']);
	unset($product_item['CATEGORY_3']);
	unset($product_item['CATEGORY_4']);
	unset($product_item['DIMENSION_W']);
	unset($product_item['DIMENSION_H']);
	unset($product_item['DIMENSION_D']);
	unset($product_item['DIMENSION_UNIT']);
	unset($product_item['WEIGHT']);
	unset($product_item['WEIGHT_UNIT']);

	// foreach ($product_item['COMBO'] as $combo_key => $combo_item) {
	// 	if (!empty($combo_item['COMBO_PRODUCTCODE'])) {
	// 		$product_item['COMBO'][$combo_key] = $combo_item;
	// 	}
	// 	//echo json_encode($combo_item);die();
	// }

	$product_map[$value['PRODUCT_CODE']] = $product_item;
}

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

$response = [
	"total" => count($response),
	"data" => $product_map2
];

echo json_encode($response);
