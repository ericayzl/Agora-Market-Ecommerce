<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'models/buyer.php';
require_once 'models/seller.php';
require_once 'models/admin.php';
require_once 'models/productmodel.php';
require_once ("interfaces/ITemplate.php");

class MasterPage
{

    var $db;
    var $title;
    /* var $memberID; */
    var $member;
    var $content;
    var $activation;

    public function __construct()
    {
        $this->title = 'Untitled';
        $this->memberID = null;
        $this->member = null;
        $this->usertype = null;
        $this->content = "<p>content not yet specified</p>";
        $this->db = getDatabase();
        $this->activation = null;
        $this->init();
    }

    private function init()
    {
        @session_save_path('.\sessions');
        @session_start();

        if (isset($_SESSION['memberID']))
        {
            $this->memberID = $_SESSION['memberID'];
            $this->usertype = $_SESSION['memberType'];
        }
        if ($this->memberID != null)
        {
            if ($this->usertype == 'buyer')
            {
                $this->member = new BuyerModel($this->db, $this->memberID);

            }
            elseif ($this->usertype == 'seller')
            {
                $this->member = new SellerModel($this->db, $this->memberID);

            }
            elseif ($this->usertype == 'admin')
            {
                $this->member = new AdminModel($this->db, $this->memberID);
            }
            $this->activation = $this
                ->member
                ->getActivation();
        }
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getDB()
    {
        return $this->db;
    }

    public function getMember()
    {
        return $this->member;
    }

    public function getProfileHtml(ITemplate $template)
    {
		$template->setTemplate('userProfile.html');
        /* $pg = new HtmlTemplate('userProfile.html'); */
        /* echo "Into profile"; */
        return $template->getHtml(array(
            'usertype' => $this->usertype,
            'firstname' => $this
                ->member
                ->getFirstName() ,
            'lastname' => $this
                ->member
                ->getLastName() ,
            'email' => $this
                ->member
                ->getEmail() ,
            'dob' => $this
                ->member
                ->getDateOfBirth() ,
            'description' => $this
                ->member
                ->getDescription()
        ));
    }

    public function getUpdateHtml(ITemplate $template)
    {	
		$template->setTemplate('update.html');
        /* $pg = new HtmlTemplate('update.html'); */
        
        return $template->getHtml(array(
            'firstname' => $this
                ->member
                ->getFirstName() ,
            'lastname' => $this
                ->member
                ->getLastName() ,
            'email' => $this
                ->member
                ->getEmail() ,
            'description' => $this
                ->member
                ->getDescription()
        ));
    }

    public function getAdminProfileHtml(ITemplate $template)
    {
        /* $pg = new HtmlTemplate('userProfileAdmin.html') */;
		$template->setTemplate('userProfileAdmin.html');
		
        return $template->getHtml(array(
            'usertype' => $this->usertype,
            'marketname' => $this
                ->member
                ->getMarketName() ,
            'marketdescription' => $this
                ->member
                ->getDescription() ,
            'firstname' => $this
                ->member
                ->getFirstName() ,
            'lastname' => $this
                ->member
                ->getLastName() ,
            'email' => $this
                ->member
                ->getEmail() ,
            'dob' => $this
                ->member
                ->getDateOfBirth()
        ));
    }

    public function getAdminUpdateHtml(ITemplate $template)
    {	
		$template->setTemplate('updateAdmin.html');
        /* $pg = new HtmlTemplate('updateAdmin.html'); */

        return $template->getHtml(array(
            'marketname' => $this
                ->member
                ->getMarketName() ,
            'marketdescription' => $this
                ->member
                ->getDescription() ,
            'firstname' => $this
                ->member
                ->getFirstName() ,
            'lastname' => $this
                ->member
                ->getLastName() ,
            'email' => $this
                ->member
                ->getEmail()
        ));
    }

    public function getProductHtml($product_id, ITemplate $template)
    {
        $target_product = new ProductModel($this->db, $product_id);
		$template->setTemplate('product.html');
        /* $pg = new HtmlTemplate('product.html'); */
        return $template->getHtml(array(
            'productname' => $target_product->getProductName() ,
            'sellername' => $target_product->getSellerName() ,
            'description' => $target_product->getProductDescription() ,
            'category' => $target_product->getCategory() ,
            'price' => $target_product->getBuyNow()
        ));
    }

    public function getHtml(ITemplate $template)
    {
        $template->setTemplate('masterPage.html');
		/* $pg = new HtmlTemplate('masterPage.html'); */
        $login_display = 'block';
        $logout_display = 'none';
        if ($this->member != null)
        {
            $login_display = 'none';
            $logout_display = 'block';
        }

        return $template->getHtml(array(
            'pagename' => $this->title,
            'login' => $this->getLoginPanel() ,
            'content' => $this->content,
            'login' => $login_display,
            'logout' => $logout_display
        ));
    }

    public function getMarketCreationHtml(ITemplate $template)
    {
		$template->setTemplate('marketCreation.html');
        /* $pg = new HtmlTemplate('marketCreation.html'); */
        return $template->getHtml(array(
            'pagename' => $this->title,
            'content' => $this->content
        ));
    }

    public function getComingHtml(ITemplate $template)
    {	
		$template->setTemplate('coming.html');
        /* $pg = new HtmlTemplate('coming.html'); */
        $login_display = 'block';
        $logout_display = 'none';
        if ($this->member != null)
        {
            $login_display = 'none';
            $logout_display = 'block';
        }

        return $template->getHtml(array(
            'pagename' => $this->title,
            'login' => $this->getLoginPanel() ,
            'content' => $this->content,
            'login' => $login_display,
            'logout' => $logout_display
        ));
    }

    public function logout()
    {
        $this->memberID = null;
        $this->member = null;
        session_destroy();
    }

    private function getLoginPanel()
    {
        if ($this->member == null)
        {
            return '<li><a href="login.php">Login</a></li>';
        }
        $html = '<span class="login">Logged in as <em>' . $this
            ->member
            ->getFullName() . '</em>';

        $html .= '<li><a href="logout.php">Logout</a></li>';
        $html .= '</span>';
        return $html;
    }
}

