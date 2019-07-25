<?php 

class MasterDataCPF{

    public function getProductMap($product)
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

    public function getProductMapCombo($product)
    {
        $product_map = self::getProductMap($product);

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

    public function getProductRecomend($data)
    {
        $result = [];
        foreach ($data as $key => $value) {
            if ($value['IS_COMBOSET'] == 'N') {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    public function getComboProduct($data, $product_map) 
    {
        $result = [];
        foreach ($data['ITEMS'] as $key => $value) {
            $value['product_main_relation'] = $product_map[$value['PRODUCT_CODE_MM']];
            $value['product_relation'] = $product_map[$value['PRODUCT_CODE']];
            $result[$key] = $value;
        }
        // echo json_encode($result);die();
        return $result;
    }

    public function getProductIgnoreCombo($data)
    {
        foreach ($data as $key => $value) {
            unset($value['COMBO']);
            $result[$key] = $value;
        }
        // echo json_encode($result);die();
        return $result;
    }

    public function getModifyGroup($data, $product_map)
    {
        $result = [];
        foreach ($data['ITEMS'] as $key => $value) {
            $value['product_relation'] = $product_map[$value['PRODUCT_CODE']];
            $result[$value['MODIFY_GROUP']][$key] = $value;
        }
        // echo json_encode($result);die();
        return $result;
    }

    public function getProductModify($data, $product_map)
    {
        $result = [];
        foreach ($data['ITEMS'] as $key => $value) {
            $value['product_relation'] = $product_map[$value['PRODUCT_CODE']];
            // $value = array_merge($value, $product_map[$value['PRODUCT_CODE']]);
            $result[$value['MODIFY_GROUP']][$key] = $value;
        }
        // echo json_encode($result);die();
        return $result;
    }
}
