<?php
/**********************************************
* AUTHOR   : John Perri Cruz				   *
* WEBSITE  : https://www.johnperricruz.com     *
* EMAIL    : johnperricruz@gmail.com		   *
* @VERSION : v1.2							   *
************************************************/

/************************************************************************************
	On head.php
	<?php require_once Mage::getBaseDir('base').DS.'functions/'.DS.'helper.php'; ?>
	
************************************************************************************/


require_once(''.dirname(__DIR__).'/app/code/core/Mage/Catalog/Model/Product.php');
class Magento extends Mage_Catalog_Model_Product{
	
	/*
	* Categories
	*/
	public function getSubCategoryViaCatID($catID){
		$children = Mage::getModel('catalog/category')->getCategories($catID);
		$active="";
		$ret="";
		$ret='<ul>';
			foreach ($children as $category) {
				if(self::getCategoryOnCategoryPage() == $category->getName()){
					$ret .= '<li class="active"><a href="'.$category->getProductUrl().'">'.$category->getName().'</a></li>';
				}else{
					$ret .= '<li><a href="'.$category->getProductUrl().'">'.$category->getName().'</a></li>';
				}
			}
		$ret .=  '</ul>';
		return $ret;
	}	
	public function getCategoryTree(){
		$_helper = Mage::helper('catalog/category');
		$_categories = $_helper->getStoreCategories();
		$return = "";
		$return = '<div id="cssmenu" class="category-tree">';
			$return .= '<ul>';
				foreach($_categories as $_category){
					$_category = Mage::getModel('catalog/category')->load($_category->getId());
					$_subcategories = $_category->getChildrenCategories();
				
					if ($_category->getIsActive()) {					
						if(count($_subcategories)!=0){						
							$return .= '<li class="'.strtolower( preg_replace('/\s+/', '-', $_category->getName())).'"><a href="'.$_category->getUrl().'">'.$_category->getName().'</a>'; 
								$return .= '<ul>';
									foreach($_subcategories as $_subcategory){
										if ($_subcategory->getIsActive()) {	
											$return .= '<li><a href="'.$_subcategory->getUrl().'">'.$_subcategory->getName().'</a></li>';
										}
									}
								$return .= '</li></ul>';
						}
						else{
							$return .= '<li class="'.strtolower( preg_replace('/\s+/', '-', $_category->getName())).'"><a href="'.$_category->getUrl().'">'.$_category->getName().'</a></li>'; 
						}
					}
				}
			$return .= '</ul>';
		$return .='</div>';
		
		return $return;
	}
	public function getCategoryOnCategoryPage(){
		return Mage::getSingleton('catalog/layer')->getCurrentCategory()->getName();
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
		$count = Mage::helper('checkout/cart')->getCart()->getItemsCount();
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
	public function getProductsViaCatID($category_id){
		$category_model = Mage::getModel('catalog/category')->load($category_id);     //get category model
		$collection = Mage::getResourceModel('catalog/product_collection');
		$collection->addCategoryFilter($category_model);  							  //category filter
		$collection->addAttributeToFilter('status',1);                                //only enabled product
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
	public function getWishListUrl($product_iD){
		return "/wishlist/index/add/product/".$product_iD."/form_key/".Mage::getSingleton('core/session')->getFormKey()."/";
	}
	public function getCompareUrl($product_iD){
		return "/compare/index/add/product/".$product_iD."/form_key/".Mage::getSingleton('core/session')->getFormKey()."/";
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
	public function getCurrencySymbol(){
		return Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol();
	}
	/*
	* Test
	*/
	public function debug(){
		return "Helper class is connected";
	}
}
?>