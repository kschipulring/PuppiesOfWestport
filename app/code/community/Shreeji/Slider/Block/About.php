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

class Shreeji_Slider_Block_About
    extends Mage_Adminhtml_Block_Abstract
    implements Varien_Data_Form_Element_Renderer_Interface
{

    /**
     * Render fieldset html
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
		$logopath	=	'http://www.shreeji-infosoft.com/wp-content/themes/oneengine/images/logo.png';
        $html = <<<HTML
		<div style="background:url('$logopath') no-repeat scroll 14px 14px #EAF0EE;border:1px solid #CCCCCC;margin-bottom:10px;padding:10px 5px 5px 233px;">
		<p>
			<strong>Magento Web Development and PREMIUM FREE/PAID MAGENTO EXTENSIONS</strong><br />
			<a href="http://www.shreeji-infosoft.com/" target="_blank">ShreejiSlider</a> (ShreejiSlider) offers a wide choice of nice-looking and easily editable free and premium Magento extensions.<br />       
			<br /><br />
		</p>
		
HTML;
        return $html;
    }
}