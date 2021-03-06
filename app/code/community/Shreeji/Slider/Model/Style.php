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
class Shreeji_Slider_Model_Style{
    protected $_options;
	const BANNERSTYLE_RANDOM = 'random';
	const BANNERSTYLE_SF = 'simpleFade';
	const BANNERSTYLE_CTL = 'curtainTopLeft';
	const BANNERSTYLE_CTR = 'curtainTopRight';
	const BANNERSTYLE_CBL = 'curtainBottomLeft';
	const BANNERSTYLE_CBR = 'curtainBottomRight';
	const BANNERSTYLE_CSL = 'curtainSliceLeft';
	const BANNERSTYLE_CSR = 'curtainSliceRight';
	const BANNERSTYLE_BCTL = 'blindCurtainTopLeft';
	const BANNERSTYLE_BCTR = 'blindCurtainTopRight';
	
	const BANNERSTYLE_BCBL = 'blindCurtainBottomLeft';
	const BANNERSTYLE_BCBR = 'blindCurtainBottomRight';
	const BANNERSTYLE_BCSB = 'blindCurtainSliceBottom';
	const BANNERSTYLE_BCST = 'blindCurtainSliceTop';
	const BANNERSTYLE_S = 'stampede';
	const BANNERSTYLE_M = 'mosaic';
	const BANNERSTYLE_MR = 'mosaicReverse';
	const BANNERSTYLE_MRD = 'mosaicRandom';
	const BANNERSTYLE_MS = 'mosaicSpiral';
	
	const BANNERSTYLE_MSR = 'mosaicSpiralReverse';
	const BANNERSTYLE_TLBR = 'topLeftBottomRight';
	const BANNERSTYLE_BRTL = 'bottomRightTopLeft';
	const BANNERSTYLE_BLTR = 'bottomLeftTopRight';
	const BANNERSTYLE_SL = 'scrollLeft';
	
	const BANNERSTYLE_SR = 'scrollRight';
	const BANNERSTYLE_SZ = 'scrollHorz';
	const BANNERSTYLE_SB = 'scrollBottom';
	const BANNERSTYLE_ST = 'scrollTop';	
      
    
    public function toOptionArray(){
        if (!$this->_options) {
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_RANDOM,
			   'label'=>Mage::helper('slider')->__('Random')
			);
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_SF,
			   'label'=>Mage::helper('slider')->__('Simple Fade')
			);
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_CTL,
			   'label'=>Mage::helper('slider')->__('Curtain Top Left')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_CTR,
			   'label'=>Mage::helper('slider')->__('Curtain Top Right')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_CBL,
			   'label'=>Mage::helper('slider')->__('Curtain Bottom Left')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_CBR,
			   'label'=>Mage::helper('slider')->__('Curtain Bottom Right')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_CSL,
			   'label'=>Mage::helper('slider')->__('Curtain Slice Left')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_CSR,
			   'label'=>Mage::helper('slider')->__('Curtain Slice Right')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_BCTL,
			   'label'=>Mage::helper('slider')->__('Blind Curtain Top Left')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_BCTR,
			   'label'=>Mage::helper('slider')->__('Blind Curtain Top Right')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_BCBL,
			   'label'=>Mage::helper('slider')->__('Blind Curtain Bottom Left')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_BCBR,
			   'label'=>Mage::helper('slider')->__('Blind Curtain Bottom Right')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_BCSB,
			   'label'=>Mage::helper('slider')->__('Blind Curtain Slice Bottom')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_BCST,
			   'label'=>Mage::helper('slider')->__('Blind Curtain Slice Top')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_S,
			   'label'=>Mage::helper('slider')->__('Stampede')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_M,
			   'label'=>Mage::helper('slider')->__('Mosaic')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_MR,
			   'label'=>Mage::helper('slider')->__('Mosaic Reverse')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_MRD,
			   'label'=>Mage::helper('slider')->__('Mosaic Random')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_MS,
			   'label'=>Mage::helper('slider')->__('Mosaic Spiral')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_MSR,
			   'label'=>Mage::helper('slider')->__('Mosaic Spiral Reverse')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_TLBR,
			   'label'=>Mage::helper('slider')->__('Top Left Bottom Right')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_BRTL,
			   'label'=>Mage::helper('slider')->__('Bottom Right Top Left')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_BLTR,
			   'label'=>Mage::helper('slider')->__('Bottom Left Top Right')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_SL,
			   'label'=>Mage::helper('slider')->__('Scroll Left')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_SR,
			   'label'=>Mage::helper('slider')->__('Scroll Right')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_SZ,
			   'label'=>Mage::helper('slider')->__('Scroll Horz')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_SB,
			   'label'=>Mage::helper('slider')->__('Scroll Bottom')
			);
			
			$this->_options[] = array(
			   'value'=>self::BANNERSTYLE_ST,
			   'label'=>Mage::helper('slider')->__('Scroll Top')
			);
			
			
					

		}
		return $this->_options;
	}
}
