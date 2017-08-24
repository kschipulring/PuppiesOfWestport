<?php
class Psychose_CallBack_Model_Mysql4_Callback extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("callback/callback", "id");
    }
}