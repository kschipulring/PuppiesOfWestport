<?php
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

$stringCSV = <<<EOD
"sku","_category"
1176,"aussie"
1005,"beag/shiba"
1157,"boston terrier"
1178,"boston terrier"
1023,"brussels"
1144,"bug"
1145,"bug"
1106,"cairn"
1095,"chihuahua"
1124,"cock a poo"
1125,"cock a poo"
1154,"cocker spaniel"
1022,"corgi"
1093,"coton"
1183,"coton"
1184,"coton"
1036,"english bulldog"
1017,"french bulldog"
1069,"french bulldog"
8381,"french bulldog"
1131,"german sheperd"
1175,"german sheperd"
1187,"german sheperd"
1158,"golden retriever"
1141,"golden retriever"
1150,"golden retriever"
1045,"havachon"
1112,"havanese"
1128,"havanese"
1129,"havanese"
1137,"havanese"
1180,"havanese"
1181,"havanese"
1122,"havapoo"
1103,"havawheat"
1054,"jack russel"
1055,"jack russel"
1151,"lab"
1192,"lab"
1193,"lab"
8400,"lhasa poo "
1168,"maltese"
1169,"maltese"
1102,"malti poo"
1185,"malti poo"
8335,"malti-shoo"
1026,"mini am shep"
1170,"mini aussie"
1115,"peke-a-poo"
1167,"pekingese"
1021,"pomeranian"
1148,"pomeranian"
1116,"poodle"
1117,"poodle"
1191,"pug"
1028,"puggle"
1127,"puggle"
1165,"puggle"
1079,"sheltie"
1114,"shih poo"
1138,"shih poo"
1140,"shih poo"
1179,"shih poo"
1014,"shih poo"
1060,"shih poo"
1068,"shih tzu"
1080,"shih tzu"
1098,"shih tzu"
1099,"shih tzu"
1133,"shih tzu"
1172,"shih tzu"
1173,"shih tzu"
1174,"shih tzu"
1186,"shih tzu"
1031,"shorky"
1064,"siberian husky"
1092,"siberian husky"
1146,"siberian husky"
1147,"siberian husky"
1163,"siberian husky"
1164,"siberian husky"
1047,"teddy bear"
1081,"teddy bear"
1182,"tibetan terrier"
1041,"toy aussie"
1110,"vizsla"
1156,"vizsla"
1159,"wheaten"
1160,"wheaten"
1161,"wheaten"
1162,"wheaten"
3123,"bug"
1201,"morky"
1202,"morky"
1203,"shih tzu"
1205,"shih tzu"
1207,"toy aussie"
1208,"havapoo"
1209,"havapoo"
1206,"malti poo"
1210,"Mini Aussie Poo"
1211,"Mini Golden Doodle"
1204,"Mini Schnauzer"
EOD;

$arrayCSV = str_to_csv_to_array($stringCSV);


$mageFilename = 'app/Mage.php';
require_once $mageFilename;
Mage::setIsDeveloperMode(true);
ini_set('display_errors', 1);
umask(0);
Mage::app('admin');
Mage::register('isSecureArea', 1);
$parentId = '163';

for( $i=0; $i<count($arrayCSV); $i++ ){
	
	$categoryName = $arrayCSV[$i]["_category"];
	
	$_category = Mage::getResourceModel('catalog/category_collection')
        ->addFieldToFilter('name', $categoryName)
        ->getFirstItem();

	$categoryId = $_category->getId();
	
	echo '$categoryId = ' . $categoryId . "<br/>\n";

	
	$productSKU = $arrayCSV[$i]["sku"];
	$ourProduct = Mage::getModel('catalog/product')->loadByAttribute('sku', $productSKU);
		
	var_dump( $ourProduct );
	
	$categories = array($categoryId);
	$ourProduct->setCategoryIds($categories);
	$ourProduct->save();
	
	/*
	if( is_numeric($categoryId) ){
		echo "this method exists" . "<br/>";

	} else {
		echo "this method does not exist <br/>";
		
		$cat_url = urlencode( str_replace(" ", "-", $arrayCSV[$i]["_category"] ) );
		
		try{
			$category = Mage::getModel('catalog/category');
			$category->setName( $arrayCSV[$i]["_category"] );
			
			
			$category->setUrlKey( $cat_url );
			$category->setIsActive(1);
			$category->setDisplayMode('PRODUCTS');
			$category->setIsAnchor(1); //for active anchor
			$category->setStoreId(Mage::app()->getStore()->getId());
			$parentCategory = Mage::getModel('catalog/category')->load($parentId);
			$category->setPath($parentCategory->getPath());
			$category->save();
			
			$_category = Mage::getResourceModel('catalog/category_collection')
				->addFieldToFilter('name', $categoryName)
				->getFirstItem();

			$categoryId = $_category->getId();
		} catch(Exception $e) {
			print_r($e);
		}
	}*/
	
	/*try{
		$category = Mage::getModel('catalog/category');
		$category->setName( $arrayCSV[$i]["_category"] );
		$category->setUrlKey('your-cat-url-key');
		$category->setIsActive(1);
		$category->setDisplayMode('PRODUCTS');
		$category->setIsAnchor(1); //for active anchor
		$category->setStoreId(Mage::app()->getStore()->getId());
		$parentCategory = Mage::getModel('catalog/category')->load($parentId);
		$category->setPath($parentCategory->getPath());
		$category->save();
	} catch(Exception $e) {
		print_r($e);
	}*/
}
?>