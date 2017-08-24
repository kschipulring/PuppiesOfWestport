<?php
class Psychose_CallBack_Block_Callbackwidget
    extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{

    protected function _toHtml()
    {
        return Mage::getSingleton('core/layout')->createBlock('core/template')->setTemplate('callback/index.phtml')->toHtml();;
    }
	
}