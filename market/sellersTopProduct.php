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
if ($page->activation == 'no')
{
    header('Location: activation.php');
}

$sql = "SELECT  p.productId, p.productName, p.category, p.buyNow, 
			CONCAT(s.firstName, ' ', s.lastName) AS sellerName
			FROM Product p
			INNER JOIN Seller1 s
			USING (userId)
			WHERE p.buyNow = (SELECT MAX(p2.buyNow)
							FROM product p2
							WHERE p2.userId = s.userId)
			
			ORDER BY s.firstName";

$products = $db->query($sql);

// Format the members as an HTML table
$table = new HtmlTable($products);
$content = $table->getHTML(array(
    'category' => 'Category',
    'sellerName' => 'Seller Name',
    'buyNow' => 'Price',
    'productName' => 'Product Name'
));

// Finally, place the content in our master page
$page->setTitle('Product Price');
$page->setContent("<p>These are the top priced items of each seller in the market.</p><br />" . $content);
print $page->getHtml($template);

