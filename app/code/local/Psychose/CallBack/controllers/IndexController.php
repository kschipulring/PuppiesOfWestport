<?php
class Psychose_CallBack_IndexController extends Mage_Core_Controller_Front_Action{
   const XML_PATH_EMAIL_RECIPIENT  = 'contacts/email/recipient_email';
    const XML_PATH_EMAIL_SENDER     = 'contacts/email/sender_email_identity';
    const XML_PATH_EMAIL_TEMPLATE   = 'contacts/email/email_template';
    const XML_PATH_ENABLED          = 'contacts/contacts/enabled';
    public function IndexAction() {
      
	  $this->loadLayout();   
	  $this->getLayout()->getBlock("head")->setTitle($this->__("Titlename"));
	        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home Page"),
                "title" => $this->__("Home Page"),
                "link"  => Mage::getBaseUrl()
		   ));

      $breadcrumbs->addCrumb("titlename", array(
                "label" => $this->__("Titlename"),
                "title" => $this->__("Titlename")
		   ));

      $this->renderLayout(); 
	  
    }
 
    public function callbacksendAction() {

        $isAjax = Mage::app()->getRequest()->isAjax();
        if ($isAjax) {
          $post = $this->getRequest()->getPost();
           if ( $post ) {
            $translate = Mage::getSingleton('core/translate');
            /* @var $translate Mage_Core_Model_Translate */
            $translate->setTranslateInline(false);
            try {
                $postObject = new Varien_Object();
                $postObject->setData($post);

                $error = false;

                if (!Zend_Validate::is(trim($post['name']) , 'NotEmpty')) {
                    $error = true;
                }

                if (!Zend_Validate::is(trim($post['message']) , 'NotEmpty')) {
                    $error = true;
                }
                 if (!Zend_Validate::is(trim($post['phone']) , 'NotEmpty')) {
                    $error = true;
                }

                if (!Zend_Validate::is(trim($post['email']), 'EmailAddress')) {
                    $error = true;
                }

                if (Zend_Validate::is(trim($post['hideit']), 'NotEmpty')) {
                    $error = true;
                }

                if ($error) {
                    $data = array('status' => 1, 'message'=>Mage::helper('contacts')->__('Unable to submit your request. Please, try again later'));
                $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($data));
                return;
                }
                $mailTemplate = Mage::getModel('core/email_template');
                /* @var $mailTemplate Mage_Core_Model_Email_Template */
                $mailTemplate->setDesignConfig(array('area' => 'frontend'))
                    ->setReplyTo($post['email'])
                    ->sendTransactional(
                        Mage::getStoreConfig(self::XML_PATH_EMAIL_TEMPLATE),
                        Mage::getStoreConfig(self::XML_PATH_EMAIL_SENDER),
                        Mage::getStoreConfig(self::XML_PATH_EMAIL_RECIPIENT),
                        null,
                        array('data' => $postObject)
                    );

                if (!$mailTemplate->getSentSuccess()) {
                    $data = array('status' => 1, 'message'=>Mage::helper('callback')->__('Unable to submit your request. Mail problem'));
                $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($data));
                return;
                }
                $translate->setTranslateInline(true);
                $now = Mage::getModel('core/date')->timestamp(time());
                $post_to_model = array('name'=>$post['name'],'email'=>$post['email'],
                  'phone'=>$post['phone'],'message' => $post['message'],
                  'created_time'=>Mage::getModel('core/date')->date('Y-m-d')
,'status'=>1);
                $model = Mage::getModel('callback/callback')->setData($post_to_model); 


try { 
    $insertid = $model->save()->getId(); 
   
} 
catch (Exception $e){ 
     $data = array('status' => 1, 'message'=>$e->getMessage());
    $this->getResponse()->setBody(Mage::helper('core')->jsonEncode());
                return;
}
             
                $output = array('status' => 0, 'message' => Mage::helper('contacts')->__('Your inquiry was submitted and will be responded to as soon as possible. Thank you for contacting us.'));
                $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($output));

                return;
            } catch (Exception $e) {
                $translate->setTranslateInline(true);

               

                 $output = array('status' => 1, 'message' => Mage::helper('contacts')->__('Unable to submit your request. Please, try again later'));
                $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($output));
                return;
            }

        } 
            
        }
        else {
        Mage::getSingleton('customer/session')->addError(Mage::helper('contacts')->__('Unable to submit your request. Please, try again later'));
                $this->_redirect('*/*/');
        }
    }
}