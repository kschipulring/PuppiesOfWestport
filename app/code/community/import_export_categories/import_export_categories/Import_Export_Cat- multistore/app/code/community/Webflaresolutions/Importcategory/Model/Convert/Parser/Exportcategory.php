<?php
/* Webflare Solutions www.webflaresolutions.com */

ini_set("memory_limit","1024M");
class Webflaresolutions_Importcategory_Model_Convert_Parser_Exportcategory extends Mage_Catalog_Model_Convert_Parser_Product
{
   
    public function unparse()
    {
	$allStores = Mage::app()->getStores();
	
	foreach ($allStores as $_eachStoreId => $val) {
		$store = Mage::app()->getStore($_eachStoreId);
		$_storeCode = Mage::app()->getStore($_eachStoreId)->getCode();
		$_storeId = Mage::app()->getStore($_eachStoreId)->getId();
		$rootCategoryId = Mage::app()->getStore($_storeId)->getRootCategoryId();
		$category_model = Mage::getModel('catalog/category');
		$_category = $category_model->load($rootCategoryId);
		//$all_child_categories = $category_model->getResource()->getAllChildren($_category);
		$all_child_categories = $_category->getCollection();
		
	
	if ($all_child_categories){
		foreach ($all_child_categories as $id){
		
		if($id->getdata('level') > 1 )
		{
		
		$cat = Mage::getModel('catalog/category');
        $cat->setStoreId($_storeId);
        $cat->load($id->getdata('entity_id'));
		
		$path = $cat->getPath();
		$parent_ids = explode('/', $path);
		unset($ids[0]);
		$cat_name = '';
		for($i=1;$i<count($parent_ids);$i++){
			$parent_cat = Mage::getModel('catalog/category')->setStoreId($_storeId)->load($parent_ids[$i]);
			if($parent_cat->getLevel()=="1")
				continue;
				$cat_name .= $parent_cat->getName().'/';
			}
			$cat_name = substr($cat_name, 0, -1);
			if($cat->getLevel()=="1")
				continue;
			$path = explode('/', $cat->getData('path'));
		if($path[1] == $rootCategoryId)
		{
			$prdsku =  Mage::getStoreConfig('importcategory/general/prd');
		
			if($prdsku) {
				$category = Mage::getModel('catalog/category')->load($cat->getId());
				$productCollection = $category->getProductCollection();
				$x = 0;
				foreach($productCollection as $_product) {
					$product = Mage::getModel('catalog/product')->load($_product->getId());
						if($x < count($productCollection)-1){
							$pcollection .= $_product->getSKU().'/';
						}else{
							$pcollection .= $_product->getSKU();
						}
					$x++;
				}
			}
			
			$catestatus =  Mage::getStoreConfig('importcategory/general/cateid');
				
	/* Webflare Solutions www.webflaresolutions.com */
		if($prdsku == 1 && $catestatus == 1 ){
				
			$row = array(
				"store"=>$_storeCode,
				"category_id"=>$cat['entity_id'],
				"category_name"=>$cat_name,
				"is_active"=>$cat->getIsActive(),
				"url_key"=>$cat->getUrlKey(),
				"description"=>$cat->getDescription(),
				"page_title"=>$cat->getMetaTitle(),
				"meta_description"=>$cat->getMetaDescription(),
				"meta_keywords"=>$cat->getMetaKeywords(),
				"include_in_navigation_menu"=>$cat->getIncludeInMenu(),
				"page_layout"=>$cat->getPageLayout(),
				"display_mode"=>$cat->getDisplayMode(),
				"is_anchor"=>$cat->getIsAnchor(),
				"thumbnail"=>$cat->getThumbnail(),
				"image"=>$cat->getImage(),
				"landing_page"=>$cat['landing_page'],
				'default_sort_by' => $cat['default_sort_by'],
				'filter_price_range' => $cat['filter_price_range'],
				'custom_use_parent_settings' => $cat['custom_use_parent_settings'],
				'custom_apply_to_products' => $cat['custom_apply_to_products'],
				'custom_design' => $cat['custom_design'],
				'custom_design_from' => $cat['custom_design_from'],
				'custom_design_to' => $cat['custom_design_to'],
				'custom_layout_update' => $cat['custom_layout_update'],
				'product_sku' => $pcollection,
			);
			$pcollection = '';
		}elseif($prdsku == 1 && $catestatus == 0){
			$row = array(
				"store"=>$_storeCode,
				"category_name"=>$cat_name,
				"is_active"=>$cat->getIsActive(),
				"url_key"=>$cat->getUrlKey(),
				"description"=>$cat->getDescription(),
				"page_title"=>$cat->getMetaTitle(),
				"meta_description"=>$cat->getMetaDescription(),
				"meta_keywords"=>$cat->getMetaKeywords(),
				"include_in_navigation_menu"=>$cat->getIncludeInMenu(),
				"page_layout"=>$cat->getPageLayout(),
				"display_mode"=>$cat->getDisplayMode(),
				"is_anchor"=>$cat->getIsAnchor(),
				"thumbnail"=>$cat->getThumbnail(),
				"image"=>$cat->getImage(),
				"landing_page"=>$cat['landing_page'],
				'default_sort_by' => $cat['default_sort_by'],
				'filter_price_range' => $cat['filter_price_range'],
				'custom_use_parent_settings' => $cat['custom_use_parent_settings'],
				'custom_apply_to_products' => $cat['custom_apply_to_products'],
				'custom_design' => $cat['custom_design'],
				'custom_design_from' => $cat['custom_design_from'],
				'custom_design_to' => $cat['custom_design_to'],
				'custom_layout_update' => $cat['custom_layout_update'],
				'product_sku' => $pcollection,
			);
			$pcollection = '';
		}elseif($prdsku == 0 && $catestatus == 1){
			$row = array(
				"store"=>$_storeCode,
				"category_id"=>$cat['entity_id'],
				"category_name"=>$cat_name,
				"is_active"=>$cat->getIsActive(),
				"url_key"=>$cat->getUrlKey(),
				"description"=>$cat->getDescription(),
				"page_title"=>$cat->getMetaTitle(),
				"meta_description"=>$cat->getMetaDescription(),
				"meta_keywords"=>$cat->getMetaKeywords(),
				"include_in_navigation_menu"=>$cat->getIncludeInMenu(),
				"page_layout"=>$cat->getPageLayout(),
				"display_mode"=>$cat->getDisplayMode(),
				"is_anchor"=>$cat->getIsAnchor(),
				"thumbnail"=>$cat->getThumbnail(),
				"image"=>$cat->getImage(),
				"landing_page"=>$cat['landing_page'],
				'default_sort_by' => $cat['default_sort_by'],
				'filter_price_range' => $cat['filter_price_range'],
				'custom_use_parent_settings' => $cat['custom_use_parent_settings'],
				'custom_apply_to_products' => $cat['custom_apply_to_products'],
				'custom_design' => $cat['custom_design'],
				'custom_design_from' => $cat['custom_design_from'],
				'custom_design_to' => $cat['custom_design_to'],
				'custom_layout_update' => $cat['custom_layout_update'],
			);
		}else{
			$row = array(
				"store"=>$_storeCode,
				"category_name"=>$cat_name,
				"is_active"=>$cat->getIsActive(),
				"url_key"=>$cat->getUrlKey(),
				"description"=>$cat->getDescription(),
				"page_title"=>$cat->getMetaTitle(),
				"meta_description"=>$cat->getMetaDescription(),
				"meta_keywords"=>$cat->getMetaKeywords(),
				"include_in_navigation_menu"=>$cat->getIncludeInMenu(),
				"page_layout"=>$cat->getPageLayout(),
				"display_mode"=>$cat->getDisplayMode(),
				"is_anchor"=>$cat->getIsAnchor(),
				"thumbnail"=>$cat->getThumbnail(),
				"image"=>$cat->getImage(),
				"landing_page"=>$cat['landing_page'],
				'default_sort_by' => $cat['default_sort_by'],
				'filter_price_range' => $cat['filter_price_range'],
				'custom_use_parent_settings' => $cat['custom_use_parent_settings'],
				'custom_apply_to_products' => $cat['custom_apply_to_products'],
				'custom_design' => $cat['custom_design'],
				'custom_design_from' => $cat['custom_design_from'],
				'custom_design_to' => $cat['custom_design_to'],
				'custom_layout_update' => $cat['custom_layout_update'],
			);
		}
			
		 	$batchExport = $this->getBatchExportModel()
                ->setId(null)
                ->setBatchId($this->getBatchModel()->getId())
                ->setBatchData($row)
                ->setStatus(1)
                ->save();
			}
			}
			}
		}
	}
	}
}
/* Webflare Solutions www.webflaresolutions.com */