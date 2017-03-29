<?php
/**********************************************
* AUTHOR   : John Perri Cruz				   *
* WEBSITE  : https://www.johnperricruz.com     *
* EMAIL    : johnperricruz@gmail.com		   *
* @VERSION : v1.2							   *
************************************************/

/************************************************************************************
	On head.php
	<?php require_once Mage::getBaseDir('base').DS.'functions/'.DS.'magento.php'; ?>
	
************************************************************************************/


require_once(''.dirname(__DIR__).'/app/code/core/Mage/Catalog/Model/Product.php');
class Magento extends Mage_Catalog_Model_Product{
	
	/*
	* Categories
	*/
	public function getSubCategoryViaCatID($catID){
		$children = Mage::getModel('catalog/category')->load($catID)->getChildrenCategories();
		$active="";
		$ret="";
		$ret='<ul>';
			foreach ($children as $category) {
				if(self::getCategoryOnCategoryPage() == $category->getName()){
					$ret .= '<li class="active"><a href="'.$category->getUrl().'">'.$category->getName().' ('.$category->getProductCount().')</a></li>';
				}else{
					$ret .= '<li><a href="'.$category->getUrl().'">'.$category->getName().' ('.$category->getProductCount().')</a></li>';
				}
			}
		$ret .=  '</ul>';
		return $ret;
	public function getCategoryTree(){
		$_helper = Mage::helper('catalog/category'); 
		$_categories = $_helper->getStoreCategories();
		$current_category = Mage::getSingleton('catalog/layer')->getCurrentCategory()->getId();
		$return = "";
				$return .= '<ul class="nav navbar-nav">';
					foreach($_categories as $_category){
						
						if ($current_category == $_category->getId()){
							$active = 'active';
						}else{
							$active = '';
						}
						
						$_category = Mage::getModel('catalog/category')->load($_category->getId());
						$_subcategories = $_category->getChildrenCategories();
						
						if ($_category->getIsActive()) {					
							if(count($_subcategories)!=0){						
								$return .= '<li  class="dropdown '.strtolower( preg_replace('/\s+/', '-', $_category->getName())).'">
								<a href="'.$_category->getUrl().'" class="dropdown-toggle" data-toggle="dropdown" >'.$_category->getName().' <span class="caret"></span></a>'; 
									$return .= '<ul class="dropdown-menu">';
										foreach($_subcategories as $_subcategory){
											if ($_subcategory->getIsActive()) {	
												$return .= '<li '.$active.' ><a href="'.$_subcategory->getUrl().'">'.$_subcategory->getName().'</a></li>';
											}
										}
									$return .= '
									</ul></li>';
							}
						 	else{
								$return .= '<li class="'.$active.' '.strtolower( preg_replace('/\s+/', '-', $_category->getName())).'"><a href="'.$_category->getUrl().'">'.$_category->getName().'</a></li>'; 
							}
						}
					}
				$return .= '
				<li class="search"><a href="#"><span class="fa fa-search"></span></a></li>
				</ul>';
		
		return $return; 
	}
	public function getCategoryObject(){
		return Mage::getSingleton('catalog/layer')->getCurrentCategory();
	}
	public function getBestSeller($categoryId){
		$category = Mage::getModel('catalog/category')->load($categoryId);
		$products = Mage::getResourceModel('reports/product_collection')
		->addOrderedQty()
		->addAttributeToSelect('*')
		->setOrder('ordered_qty', 'desc') // most best sellers on top
		->addCategoryFilter($category);
		return $products;
	}
	/*
	* Cart
	*/
	
	public function getCartGrandTotal(){
		$total = Mage::helper('checkout/cart')->getQuote()->getGrandTotal();
		if($total == null){
			return "0.00";
		}else{
			return round($total,2);
		}
	}
	public function getCartCount(){
		$count = "0";
		if(!empty(Mage::helper('checkout/cart')->getSummaryCount())){
			$count = Mage::helper('checkout/cart')->getSummaryCount();
		}
		return $count;
	}
	public function getCartUrl(){
		$link = Mage::helper('checkout/cart')->getCartUrl();
		return $link;
	}
	
	/*
	* Product
	*/
	
	public function getRelatedProducts($file){
		return $this->getLayout()->createBlock("catalog/product_list_related")->setTemplate("catalog/product/list/".$file."")->toHtml();
	}	
	public function getUpsellProducts($file){
		return $this->getLayout()->createBlock("catalog/product_list_upsell")->setTemplate("catalog/product/list/".$file."")->toHtml();
	}	
	public function getProductsViaCatID($category_id){
		$category_model = Mage::getModel('catalog/category')->load($category_id);     //get category model
		$collection = Mage::getResourceModel('catalog/product_collection');
		$collection->addCategoryFilter($category_model);  							  //category filter
		$collection->addAttributeToFilter('status',1);                                //only enabled product
		$collection->addAttributeToFilter('visibility',4); 
		$collection->addAttributeToSelect(array('description','name','url','small_image','price')); //add product attribute to be fetched
		//$collection->getSelect()->order('rand()');                                  //Uncomment for random fetching of product in the homepage.
		$collection->addStoreFilter(); 
		return $collection; 
		$collection->clear();
	}
	public function getProductViaID($product_id){
		return Mage::getModel('catalog/product')->load($product_id); 
	}
	public function getFormKey(){
		return Mage::getSingleton('core/session')->getFormKey(); 
	}	
	public function addToWishlist($product_iD){
		return "/wishlist/index/add/product/".$product_iD."/form_key/".Mage::getSingleton('core/session')->getFormKey()."/";
	}
	public function addToCompare($product_iD){
		//return "/catalog/product_compare/add/product/".$product_iD."/uenc/aHR0cDovL2Nvb2tpZXMucHJpbWV2aWV3LmNvbS9jb29raWVzLWFuZC1icm93bmllcy1naWZ0cy1zaWx2ZXItdGFsbC10aW4taGFydmVzdC5odG1s/form_key/".Mage::getSingleton('core/session')->getFormKey()."/";
		$product_obj = Mage::getModel('catalog/product')->load($product_iD);
		return Mage::helper('catalog/product_compare')->getAddUrl($product_obj);
	}	
	public function isCompared($product_iD){
		$compared = false;
		$collection = $this->helper('catalog/product_compare')->getItemCollection();
		foreach($collection as $comparing_product) {
			if ($comparing_product->getId() === $product_iD) {
				$compared = true;
			}
		}
		return $compared;
	}	
	public function getProductImageUrl($prod,$size){
		return $this->helper('catalog/image')->init($prod, 'small_image')->resize($size);
	}
	/*
	* Account
	*/
	public function isLoggedIn(){
		$action = $this->helper('customer')->isLoggedIn();
		if($action){ return true;}
		else{ return false;}
	}
	public function getAccountUrl($mode){
		$link = "#";
		if($mode == 'login'){
			$link = Mage::getUrl('customer/account/login'); 
		}
		else if($mode == 'logout'){
			$link = Mage::getUrl('customer/account/logout'); 
		}
		else if($mode == 'account'){
			$link = Mage::getUrl('customer/account');
		}
		else if($mode == 'register'){
			$link = Mage::getUrl('customer/account/create'); 
		}
		return $link;
	}
	public function getCustomer($atts){
		 $customer = Mage::getSingleton('customer/session')->getCustomer();
		 $ret = "";
		 if($atts == 'firstname'){
			$ret = $customer->getFirstname(); 
		 }else if($atts == 'lastname'){
			$ret = $customer->getLastname();
		 }else if($atts == 'full'){
			$ret = $customer->getName();
		 }
		 return $ret;
	}
	
	/*
	* Utils
	*/
	public function getLayout($file){
		return $this->getLayout()->createBlock('core/template')->setTemplate($file)->toHtml();
	}
	public function getStaticBlock($identifier){
		return $this->getLayout()->createBlock('cms/block')->setBlockId($identifier)->toHtml(); 
	}
	public function getCurrencySymbol(){
		return Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol();
	}
	public function getNewsletter(){
		return $this->getChildHtml('newsletter');
	}
	public function getCompareLink(){
		return '/catalog/product_compare/index';
	}
	public function getWishlistLink(){
		return '/wishlist'; 
	}
	public function newsletterSuccessRedirect($cms){
		//Must add to newsletter form
		return '<input type="hidden" name="uenc" value="'.Mage::helper('core')->urlEncode(Mage::app()->getStore()->getBaseUrl().$cms).'"/>';
	}
	public function getSkinCSS($file,$isSecure=false){
		$css = '';
		if($isSecure){
			$css = '<link rel="stylesheet" href="'.$this->getSkinUrl('css/'.$file.'',array('_secure'=>true)).'" />';
		}else{
			$css = '<link rel="stylesheet" href="'.$this->getSkinUrl('css/'.$file.'').'" />';
		}
		return $css;
	}
	public function getExternalCSS($css){
		return '<link href="'.$css.'" type="text/css" rel="stylesheet" />';
	}
	public function getExternalJS($js){
		return '<script type="text/javascript" src="'.$js.'" ></script>';
	}
	public function getSkinJS($file,$isSecure=false){
		$js = '';
		if($isSecure){
			$js = '<script type="text/javascript" src="'.$this->getSkinUrl('js/'.$file.'',array('_secure'=>true)).'" ></script>';
		}else{
			$js = '<script type="text/javascript" src="'.$this->getSkinUrl('js/'.$file.'').'"></script>';
		}
		return $js;
	}
	
	public function getSkinImages($file,$isSecure=false){
		if($isSecure){
			return  $this->getSkinUrl('images/'.$file.'',array('_secure'=>true));
		}else{
			return  $this->getSkinUrl('images/'.$file.'');
		}
	}
	/*
	* Test
	*/
	public function debug(){
		return "Helper class is connected.";
	}
}
?>