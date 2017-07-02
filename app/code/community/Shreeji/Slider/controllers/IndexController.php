<?php
/**
 *
 * Version			: 1.0.4
 * Edition 			: Community 
 * Compatible with 	: Magento 1.5.x to latest
 * Developed By 	: ShreejiSlider
 * Email			: info@shreeji-infosys.com
 * Web URL 			: www.shreeji-infosoft.com
 * Extension		: ShreejiSlider Easy Banner slider
 * 
 */
?>
<?php
class Shreeji_Slider_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {		
		$this->loadLayout();     
		$this->renderLayout();
    }
}