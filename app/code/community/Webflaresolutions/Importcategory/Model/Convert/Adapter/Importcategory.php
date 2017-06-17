<?php
/* Webflare Solutions www.webflaresolutions.com */

class Webflaresolutions_Importcategory_Model_Convert_Adapter_Importcategory
extends Mage_Catalog_Model_Convert_Adapter_Product
{
    public function load() {
	
    }
    public function save() {
     
    }
    public function saveRow(array $importData)
    {
		/* Webflare Solutions www.webflaresolutions.com */
	
		$store = Mage::app()->getStore($importData['store']);
		if (isset($importData['category_name'])) {
         	$categoryIds = $this->_addCategories($importData, $store);
        }
	}	
	protected $_categoryCache = array();
    protected function _addCategories($importData, $store)
    {
		$categories = $importData['category_name'];
		$store_id = $store->getStoreId();
		$rootId = $store->getRootCategoryId();
		$rootCategory = Mage::getModel('catalog/category')->load($rootId);
		$root_category =  trim($rootCategory->getData('name'));
		
		$_categoryCache = array();		
		if($categories=="")
		   return array();
        $rootPath = '1/'.$rootId;
        if (empty($this->_categoryCache[1])) {
            $collection = Mage::getModel('catalog/category')->getCollection()->addAttributeToSelect('name');
            $collection->getSelect()->where("path like '".$rootPath."/%'");
            foreach ($collection as $cat) {
                $pathArr = explode('/', $cat->getPath());
                $namePath = '';
                for ($i=2, $l=sizeof($pathArr); $i<$l; $i++) {
                    $name = $collection->getItemById($pathArr[$i])->getName();
                    $namePath .= (empty($namePath) ? '' : '/').trim($name);
                }
                $cat->setNamePath($namePath);
            }
            
            $cache = array();
            foreach ($collection as $cat) {
                $cache[strtolower($cat->getNamePath())] = $cat;
                $cat->unsNamePath();
            }
            $this->_categoryCache[1] = $cache;
        }
		
        $cache =& $this->_categoryCache[1];
		$catIds = array();
		$path = $rootPath;
        $namePath = '';
	
		$categories_update = Mage::getModel('catalog/category')
                    ->getCollection();
					
		foreach($categories_update as $cat_data){
		
			$cat_path = $cat_data->getData('path');
			$cat_path_data = explode('/',$cat_path);
	
			$cat_path_name_first = array();
			for($i=0;$i<count($cat_path_data);$i++)	{
				$cat_path_id = Mage::getModel('catalog/category')->setStoreId($store_id)->load($cat_path_data[$i]);
				$cat_path_name  = $cat_path_id->getData('name');
				$cat_path_name_first[] = $cat_path_name;
			}
			
								
			$cat_path_name_final = '';  
			for($i=1;$i<count($cat_path_name_first); $i++) {
				if($i < count($cat_path_name_first)-1){
					$cat_path_name_final .= $cat_path_name_first[$i]."/";
				}else{
					$cat_path_name_final .= $cat_path_name_first[$i];
				}
			} 

			
			$final_cat = $root_category."/".$categories; 
						
			if($cat_path_name_final == $final_cat){
				$category_id = end($cat_path_data); 
                break;				
			}
			/* $category_id  = trim($importData['category_id']);
			if($category_ids != "")	{
				if($category_ids == $category_id){
					$category_id = $category_id;
				}else{
					$category_id = $category_ids;
				}
			}else{
				$category_id = $category_id;
			} */
			
					
		} 
			
		$category_name = explode('/', $categories);
	
		$category_name = end($category_name);
		   
		if($category_id != ""){
			
				$update_cat = Mage::getModel('catalog/category')->setStoreId($store_id)->load($category_id);
				
				$cate_update = $update_cat->getData('entity_id');
				
				$update_cat['name'] =  $category_name;
				
				if(isset($importData['description'])){
					$update_cat->setDescription($importData['description']);
				}
				if(isset($importData['is_active'])){
                	$update_cat->setIsActive($importData['is_active']);
				}
				if(isset($importData['url_key'])){	
					$update_cat->setUrlKey($importData['url_key']);
				}
				if(isset($importData['page_title'])){
					$update_cat->setMetaTitle($importData['page_title']);
				}
				if(isset($importData['meta_keywords'])){
					$update_cat->setMetaKeywords($importData['meta_keywords']);
				}
				if(isset($importData['meta_description'])){
					$update_cat->setMetaDescription($importData['meta_description']);
				}
				if(isset($importData['include_in_navigation_menu'])){
					$update_cat->setIncludeInMenu($importData['include_in_navigation_menu']);
				}
				if(isset($importData['is_anchor'])){
					$update_cat->setIsAnchor($importData['is_anchor']);
				}
				if(isset($importData['display_mode'])){
				
					$data['display_mode'] = $importData['display_mode'];
				}
				if(isset($importData['page_layout'])){
				
					$data['page_layout'] = $importData['page_layout'];
				}
				if(isset($importData['display_mode'])){
					$data['display_mode']  = $importData['display_mode'];
				}
				if(isset($importData['page_layout'])){
					$data['page_layout'] = $importData['page_layout'];
				}
				if(isset($importData['thumbnail'])){
					$this->_getCategoryImageFile($importData['thumbnail']);
					$data['thumbnail'] = $importData['thumbnail'];
				}
				if(isset($importData['image'])){
					$this->_getCategoryImageFile($importData['image']);
					$data['image'] = $importData['image'];
				}
				if(isset($importData['landing_page'])){
					$data['landing_page'] =  $importData['landing_page'];
				}
				if(isset($importData['default_sort_by'])){
					$data['default_sort_by'] =  $importData['default_sort_by'];
				}
				if(isset($importData['description'])){
					$data['filter_price_range'] =  $importData['filter_price_range'];
				}
				if(isset($importData['custom_use_parent_settings'])){
					$data['custom_use_parent_settings'] =  $importData['custom_use_parent_settings'];
				}	
				if($data['custom_use_parent_settings'] ==  0){	
					
					if(isset($importData['custom_apply_to_products'])){					
						$data['custom_apply_to_products'] =  $importData['custom_apply_to_products'];
					}
					if(isset($importData['custom_design'])){
						$data['custom_design'] =  $importData['custom_design'];
					}
					if(isset($importData['custom_design_from'])){
					
						$data['custom_design_from'] =  $importData['custom_design_from'];
					}
					if(isset($importData['custom_design_to'])){
						$data['custom_design_to'] =  $importData['custom_design_to'];
					}
					if(isset($importData['page_layout'])){
						$data['page_layout'] = $importData['page_layout'];
					}
					if(isset($importData['custom_layout_update'])){
						$data['custom_layout_update'] =  $importData['custom_layout_update'];
					}	
				}
				$update_cat->addData($data);    
				$update_cat->save();
		/* Webflare Solutions www.webflaresolutions.com */
			/* Assign Product */
				$product_sku = $importData['product_sku'];
				if(isset($product_sku))
					if($product_sku != "") {
					$product_data = explode("/",$product_sku);
						for($e=0; $e<count($product_data); $e++){  
							$product_id = Mage::getModel("catalog/product")->getIdBySku($product_data[$e]);
																				
							if($product_id != "") {
								$product = Mage::getModel('catalog/product')->load($product_id);
								 
								$newCategories = $origCats = $product->getCategoryIds();
								if(!in_array($category_id, $origCats)) {
									$newCategories = array_merge($origCats, array($category_id));
									$product->setCategoryIds($newCategories)->save();
								}
							}
						  }
				  }
		/* Webflare Solutions www.webflaresolutions.com */
				/*  Remove Product   */
				/* if($product_sku == "")
				{
					$category = Mage::getModel('catalog/category')->setStoreId($store)->load($dublicate_catIds);
					$productCollection = $category->getProductCollection();
					foreach($productCollection as $_product) {
						$product = Mage::getModel('catalog/product')->load($_product->getId());
						$prd_id = $_product->getId();
						$products=Mage::getSingleton('catalog/category_api')->removeProduct($dublicate_catIds,$prd_id);
					}
				} */
				
		}

	if($importData['category_id'] == "" || $cate_update == "") 
	{
		foreach (explode('/', $categories) as $catName) {
		
            $namePath .= (empty($namePath) ? '' : '/').strtolower($catName);
				
            if (empty($cache[$namePath])) {
		
				$cat = Mage::getModel('catalog/category')
              			->setStoreId($store_id)
              			->setName($catName)
						->setPath($path)
                        ->setIsActive($importData['is_active'])
						->setUrlKey($importData['url_key'])
						->setDescription($importData['description'])
						->setMetaTitle($importData['page_title'])
						->setMetaKeywords($importData['meta_keywords'])
						->setMetaDescription($importData['meta_description'])
						->setIncludeInMenu($importData['include_in_navigation_menu'])
						->setDisplayMode($importData['display_mode'])
						->setIsAnchor($importData['is_anchor']);
						$subcategory['landing_page'] =  $importData['landing_page'];
						$subcategory['default_sort_by'] =  $importData['default_sort_by'];
						$this->_getCategoryImageFile($importData['thumbnail']);
						$subcategory['thumbnail'] = $importData['thumbnail'];
						$this->_getCategoryImageFile($importData['image']);
						$subcategory['image'] = $importData['image'];
                        $subcategory['filter_price_range'] =  $importData['filter_price_range'];
						$subcategory['custom_use_parent_settings']=	$importData['custom_use_parent_settings'];
						
						if($subcategory['custom_use_parent_settings'] ==  0){							
							$subcategory['custom_apply_to_products'] =  $importData['custom_apply_to_products'];
							$subcategory['custom_design'] =  $importData['custom_design'];
							$subcategory['custom_design_from'] =  $importData['custom_design_from'];
							$subcategory['custom_design_to'] =  $importData['custom_design_to'];
							$subcategory['page_layout'] = $importData['page_layout'];
							$subcategory['custom_layout_update'] =  $importData['custom_layout_update'];
						}
						
											
						$cat->addData($subcategory);	
						$cat->save(); 
					 	
						$cache[$namePath] = $cat;			
						$cate_id = $cache[$namePath]->getId();

						$product_sku = $importData['product_sku'];
						
						if(isset($product_sku))
						if($product_sku != "") {
						  	$product_data = explode("/",$product_sku);
							for($e=0; $e<count($product_data); $e++){  
								$product_id = Mage::getModel("catalog/product")->getIdBySku(trim($product_data[$e]));
								if($product_id != "") {
									$product = Mage::getModel('catalog/product')->load($product_id);
									$newCategories = $origCats = $product->getCategoryIds();
									if(!in_array($cate_id, $origCats)) {
										$newCategories = array_merge($origCats, array($cate_id));
										$product->setCategoryIds($newCategories)->save();
									}
								}
							}
						}
							
                }
				              
                $catId = $cache[$namePath]->getId();
                $path .= '/'.$catId;
		    }
			
		}		
		
    }
	function _getCategoryImageFile($filename)
	{    
		$filePath = Mage::getBaseDir('media') . DS . 'catalog' . DS . 'category' . DS . $filename;
		$fileUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'import/category/'. $filename;
		$imageUrl_test=file_get_contents($fileUrl);
		$file_handler=fopen($filePath,'w');
		/* Webflare Solutions www.webflaresolutions.com */
		if(fwrite($file_handler,$imageUrl_test)==false){
		   Mage::log('ERROR: ', null,'error');
		}
		/* Webflare Solutions www.webflaresolutions.com */
		else{
			Mage::log('Image Created Successfully', null, '');
		}
		/* Webflare Solutions www.webflaresolutions.com */
		fclose($file_handler);
		return  $filePath;
	}
	
}


/* Webflare Solutions www.webflaresolutions.com */