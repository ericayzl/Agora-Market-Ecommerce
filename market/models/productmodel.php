<?php
require_once 'models/entity.php';
require_once 'models/seller.php';
/*
	Current logged in member is memberID in session
*/

class ProductModel extends EntityModel
{

    /* CONSTRUCTOR */
    function __construct($db, $productID)
    {

        parent::__construct($db, 'Product'); // Bind to members table
        parent::defineKey('productId', $productID); // Define primary key
        parent::defineField('userId'); // Say which fields we care about
        parent::defineField('productName');
        parent::defineField('productDescription');
        parent::defineField('category');
        parent::defineField('buyNow');

        if ($productID != null)
        {
            parent::load();
        }
    }

    /* 	PUBLIC SETTERS */
    public function setUserId($value)
    {
        parent::setValue('userId', "'$value'");
    }
    public function setProductName($value)
    {
        parent::setValue('productName', "'$value'");
    }
    public function setProductDescription($value)
    {
        parent::setValue('productDescription', "'$value");
    }
    public function setCategory($value)
    {
        parent::setValue('category', "'$value'");
    }
    public function setBuyNow($value)
    {
        parent::setValue('buyNow', $value);
    }

    /* PUBLIC GETTERS */
    function getID()
    {
        return parent::getID();
    }
    public function getUserId()
    {
        return parent::getValue('userId');
    }
    public function getProductName()
    {
        return parent::getValue('productName');
    }
    public function getProductDescription()
    {
        return parent::getValue('productDescription');
    }
    public function getCategory()
    {
        return parent::getValue('category');
    }
    public function getBuyNow()
    {
        return parent::getValue('buyNow');
    }
    public function getSellerName()
    {
        $target_seller = new SellerModel($this->db, $this->getUserId());
        $target_name = $target_seller->getFullName();
        return $target_name;
    }
	
	//Overriding example
	protected function getValue(string $key): string
    {	
		$value = $this->data[$key];
		if (gettype($value) == "string")
		{
			$value = ucfirst($value);
		}
			
        return "{$value}";
    }


}
?>
