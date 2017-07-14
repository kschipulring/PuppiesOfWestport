<?php
require_once 'app/Mage.php';

function str_to_csv_to_array($string, $delimiter=','){
	$header = NULL;
	$data = array();
	$rows = explode(PHP_EOL, $string); 
	foreach($rows as $row_str){
		$row = str_getcsv($row_str);
		if(!$header){
		   $header = $row;
		}else{
			if(count($header)!=count($row)){ continue; }

			$data[] = array_combine($header, $row);
		}
	}

    return $data;
}


Mage::app();
Mage::app()->getStore()->setId(Mage_Core_Model_App::ADMIN_STORE_ID);


$stringCSV = <<<EOD
"sku","born_on"
1176,10/20/16
1005,07/13/16
1157,10/09/16
1178,10/17/16
1023,07/24/16
1144,10/04/16
1145,10/04/16
1106,09/09/16
1095,09/01/16
1124,09/20/16
1125,09/20/16
1154,10/03/16
1022,07/25/16
1093,09/01/16
1183,10/20/16
1184,10/20/16
1036,08/11/16
1017,07/16/16
1069,08/14/16
8381,05/30/16
1131,09/23/16
1175,10/22/16
1187,10/20/16
1158,10/10/16
1141,10/06/16
1150,09/29/16
1045,08/07/16
1112,09/08/16
1128,09/20/16
1129,09/20/16
1137,09/29/16
1180,10/20/16
1181,10/20/16
1122,09/20/16
1103,09/08/16
1054,08/16/16
1055,08/16/16
1151,09/28/16
1192,10/16/16
1193,10/16/16
8400,07/02/16
1168,10/12/16
1169,10/12/16
1102,09/04/16
1185,10/19/16
8335,04/15/16
1026,07/30/16
1170,10/10/16
1115,09/11/16
1167,10/09/16
1021,07/03/16
1148,09/26/16
1116,09/13/16
1117,09/13/16
1191,10/20/16
1028,08/03/16
1127,09/19/16
1165,10/04/16
1079,08/28/16
1114,09/15/16
1138,10/06/16
1140,10/06/16
1179,10/12/16
1014,07/17/16
1060,08/14/16
1068,08/08/16
1080,09/02/16
1098,09/02/16
1099,09/02/16
1133,09/23/16
1172,10/15/16
1173,10/15/16
1174,10/15/16
1186,10/17/16
1031,07/26/16
1064,08/08/16
1092,08/28/16
1146,10/05/16
1147,10/05/16
1163,10/12/16
1164,10/12/16
1047,08/10/16
1081,09/02/16
1182,10/20/16
1041,08/04/16
1110,09/08/16
1156,09/08/16
1159,10/12/16
1160,10/12/16
1161,10/12/16
1162,10/12/16
1201,11/07/16
1202,11/07/16
1203,11/17/16
1205,11/09/16
1207,11/10/16
1208,11/12/16
1209,11/12/16
1206,10/19/16
1210,11/03/16
1211,11/11/16
1204,11/06/16
EOD;

//print_r(str_to_csv_to_array($stringCSV));

$arrayCSV = str_to_csv_to_array($stringCSV);

//$productSKU = '111';
//$ourProduct = Mage::getModel('catalog/product')->loadByAttribute('sku',$productSKU);

echo "<pre>";
//var_dump( $arrayCSV );die("</pre>");

//foreach($productsData as $fileName){
for($i=0; $i<count($arrayCSV); $i++){
	
	$date = date_create( $arrayCSV[$i]["born_on"] );
	
	//"2015-06-02 00:00:00"
	$arrayCSV[$i]["born_on"] = date_format($date, "Y-m-d h:m:s");
	
	
	$productSKU = $arrayCSV[$i]["sku"];
	$ourProduct = Mage::getModel('catalog/product')->loadByAttribute('sku', $productSKU);
	
	$resource = $ourProduct->getResource();
	
	$attribue_code = "born_on";
	$value = $arrayCSV[$i][$attribue_code];

	$ourProduct->setData($attribue_code, $value);
	/*$resource->saveAttribute($ourProduct, $attribute_code);*/
	
	//echo method_exists($ourProduct, "setData");
	
	$ourProduct->save();
			
	//var_dump( $ourProduct );die();
	
	/*
	if (file_exists($filePath)) {
		$ourProduct->addImageToMediaGallery($filePath, array('image', 'small_image', 'thumbnail'), false, false);
		$ourProduct->save();
		echo "done ";
	} else {
		echo $productSKU . " not done";
		echo "<br>";
	}*/
	
	/*
	$filePath = $fileName;
	
    if (file_exists($filePath)) {
        $ourProduct->addImageToMediaGallery($filePath, array('image', 'small_image', 'thumbnail'), false, false);
        $ourProduct->save();
        echo "done ";
    } else {
        echo $productSKU . " not done";
        echo "<br>";
    }  */ 
}

var_dump( $arrayCSV );die("</pre>");
?>