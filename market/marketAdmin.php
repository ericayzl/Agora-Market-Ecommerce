<?php
include_once 'siteFunctions/commonFunctions.php';
include_once 'siteFunctions/masterPage.php';
require_once 'framework/htmlTemplate.php';
require_once 'framework/htmlTable.php';

$page = new MasterPage();
$db = $page->getDB();
$template = new HtmlTemplate();

if ($_SESSION['memberID'] == null)
{
    header('Location: login.php');
}
elseif ($_SESSION['memberType'] != "admin")
{
    header('Location: marketUsers.php');
}

if ($page->activation == 'no')
{
    header('Location: activation.php');
}

$sql_buyers = "SELECT  userId,
		CONCAT(firstName, ' ', lastName) AS buyerName,
		username, email, dateOfBirth, activated
		FROM Buyer1";

$buyers = $db->query($sql_buyers);

// Buyer table
$buyer_table = new HtmlTable($buyers);
$buyer_table->setTableType("buyer");
$buyer_content = $buyer_table->getHtml(array(
    'userId' => 'Buyer ID',
    'buyerName' => 'Name',
    'username' => 'Username',
    'email' => 'Email',
    'dateOfBirth' => 'Date of Birth',
    'activated' => 'Activated'
));

// Seller table
$db = $page->getDB();
$sql_seller = "SELECT  userId,
		CONCAT(firstName, ' ', lastName) AS sellerName,
		username, email, dateOfBirth, activated
		FROM Seller1";

$sellers = $db->query($sql_seller);

$seller_table = new HtmlTable($sellers);
$seller_table->setTableType("seller");
$seller_content = $seller_table->getHtml(array(
    'userId' => 'Seller ID',
    'sellerName' => 'Name',
    'username' => 'Username',
    'email' => 'Email',
    'dateOfBirth' => 'Date of Birth',
    'activated' => 'Activated'
));

$content = $buyer_content . "<br /><br /><br /><br />" . $seller_content;

// Finally, place the content in our master page
$page->setTitle('Market Users');
$page->setContent($content);
print $page->getHtml($template);

