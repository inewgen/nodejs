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

	$product_map[$value['PRODUCT_CODE']] = $value;
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

$response = $product_map2;

echo '<pre>';
echo 'จำนวนสินค้า : ' . count($response);
echo '</pre>';

echo '<pre>';
print_r($response);
echo '</pre>';
