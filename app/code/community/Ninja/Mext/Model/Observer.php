<?php

class Ninja_Mext_Model_Observer {
	
        public function controllerActionLayoutLoadBefore(Varien_Event_Observer $observer)
        {
            /** @var $layout Mage_Core_Model_Layout */
            $layout = $observer->getEvent()->getLayout();
 			$action = $observer->getEvent()->getAction();
 			$storeId = Mage::app()->getStore()->getId();
 			
            $package = Mage::getSingleton('core/design_package');
            
            $layout_update_default = $package->getArea().'_default_default_'.$action->getFullActionName();
            
           	$layout_update = $package->getArea().'_'.$package->getPackageName().'_'.$package->getTheme('layout').'_'.$action->getFullActionName();
            
           	$layout_xml_array = $layout->getUpdate()->getFileLayoutUpdatesXml(
			            		$package->getArea(),
			            		$package->getPackageName(),
			            		$package->getTheme('layout'),
			            		$storeId
			            )->asArray();
           	
            if((array_key_exists($layout_update, $layout_xml_array))){
            	$layout->getUpdate()->addHandle(strtolower($layout_update));
            }else{
            	$layout->getUpdate()->addHandle(strtolower($layout_update_default));
            }
                        
        }
        
	
}