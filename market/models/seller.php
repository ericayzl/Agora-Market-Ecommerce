<?php
require_once 'models/entity.php';
/*
	Current logged in member is memberID in session
*/

class SellerModel extends EntityModel
{

    /* CONSTRUCTOR */
    function __construct($db, $memberID)
    {

        parent::__construct($db, 'Seller1'); // Bind to members table
        parent::defineKey('userId', $memberID); // Define primary key
        parent::defineField('firstName'); // Say which fields we care about
        parent::defineField('lastName');
        parent::defineField('username');
        parent::defineField('password');
        parent::defineField('email');
        parent::defineField('dateOfBirth');
        parent::defineField('profileDescription');
        parent::defineField('activated');

        if ($memberID != null)
        {
            parent::load();
        }
    }

    /* 	PUBLIC SETTERS */
    public function setFirstName($value)
    {
        parent::setValue('firstName', "'$value'");
    }
    public function setLastName($value)
    {
        parent::setValue('lastName', "'$value'");
    }
    public function setUserName($value)
    {
        parent::setValue('username', "'$value");
    }
    public function setPassword($value)
    {
        parent::setValue('password', "'$value'");
    }
    public function setEmail($value)
    {
        parent::setValue('email', $value);
    }
    public function setDateOfBirth($value)
    {
        parent::setValue('dateOfBirth', $value);
    }
    public function setDescription($value)
    {
        parent::setValue('profileDescription', $value);
    }
    public function setActivation($value)
    {
        parent::setValue('activated', $value);
    }

    /* PUBLIC GETTERS */
    function getID()
    {
        return parent::getID();
    }
    public function getFirstName()
    {
        return parent::getValue('firstName');
    }
    public function getLastName()
    {
        return parent::getValue('lastName');
    }
    public function getUserName()
    {
        return parent::getValue('username');
    }
    public function getPassword()
    {
        return parent::getValue('password');
    }
    public function getEmail()
    {
        return parent::getValue('email');
    }
    public function getDateOfBirth()
    {
        return parent::getValue('dateOfBirth');
    }
    public function getDescription()
    {
        return parent::getValue('profileDescription');
    }
    public function getActivation()
    {
        return parent::getValue('activated');
    }
    public function getFullName()
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    /* HELPER FUNCTIONS */

    public function isValidPassword()
    {
        $hash = "xxx"; //todo: calculate
        // get hash and compare
        return true;

    }
}
?>
