<?php
$product = file_get_contents("../data/data-product-0.json");
$product = json_decode($product, true);

$combo_product = file_get_contents("../data/data-combo-product-0.json");
$combo_product = json_decode($combo_product, true);

$modify_group = file_get_contents("../data/data-modify-group-0.json");
$modify_group = json_decode($modify_group, true);

function getProductMap($product)
{
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
	return $product_map;
}

function getProductMapCombo($product)
{
	$product_map = getProductMap($product);

	// echo json_encode($product_map);die();
	$product_map2 = [];
	$product_sub = [];
	foreach ($product_map as $key2 => $value2) {
		$combo = $value2['COMBO'];
		if(is_array($combo)) {
			foreach ($combo as $key3 => $value3) {
				$COMBO_PRODUCTCODE = $value2['COMBO'][$key3]['COMBO_PRODUCTCODE'];
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
	return $product_map2;
}

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

function getComboProduct($data, $product_map) 
{
	$result = [];
	foreach ($data['ITEMS'] as $key => $value) {
		$value['product_main'] = $product_map[$value['PRODUCT_CODE_MM']];
		$value['product'] = $product_map[$value['PRODUCT_CODE']];
		$result[$key] = $value;
	}
	// echo json_encode($result);die();
	return $result;
}

function getProductIgnoreCombo($data)
{
	foreach ($data as $key => $value) {
		unset($value['COMBO']);
		$result[$key] = $value;
	}
	// echo json_encode($result);die();
	return $result;
}

function getModifyGroup($data, $product_map)
{
	$result = [];
	foreach ($data['ITEMS'] as $key => $value) {
		$value['product'] = $product_map[$value['PRODUCT_CODE']];
		$result[$value['MODIFY_GROUP']][$key] = $value;
	}
	// echo json_encode($result);die();
	return $result;
}

$product_map = getProductMap($product);
$product_map_combo = getProductMapCombo($product);

if ($_GET['show'] == 'product_recommend') {
	$response_data = getProductRecomend($product_map_combo);

} elseif ($_GET['show'] == 'product_map_combo') {
	$response_data = getProductMapCombo($product);

} elseif ($_GET['show'] == 'combo_product') {
	$response_data = getComboProduct($combo_product, getProductIgnoreCombo($product_map));

} elseif ($_GET['show'] == 'modify_group') {
	$response_data = getModifyGroup($modify_group, getProductIgnoreCombo($product_map));

} else {
	$response_data = $product_map;
}

$response = [
	"total" => count($response_data),
	"data" => $response_data
];

echo json_encode($response);