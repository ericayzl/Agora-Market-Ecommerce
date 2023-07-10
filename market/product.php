<?php
require_once 'framework/htmlTemplate.php';
require_once 'framework/htmlTable.php';
require_once 'models/member.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/masterPage.php';

try
{
    $pg = new MasterPage();
    $product_id = $_GET['productId'];
	$template = new HtmlTemplate();

    if ($_SESSION['memberID'] == null)
    {
        header('Location: login.php');
    }

    if ($pg->activation == 'no')
    {
        header('Location: activation.php');
    }

    if ($product_id == null)
    {
        throw new Exception("Not valid product id");
    }

    // Getting page content
    $product_setup = new MasterPage();
    $content = $product_setup->getProductHtml($product_id, $template) . '<br /><br /><br />';

    // Buyers can buy the product
    if ($_SESSION['memberType'] == 'buyer')
    {
        $content .= '</table><a href="productsUser.php"><button type="button" class="btn my-button mt-4 mb-3">Buy Now</button></a><br /><br /><br />';
    }
    $pg->setTitle('Product');
    $pg->setContent($content);
    print $pg->getHtml($template);

}
catch(exception $ex)
{
    header('Location: productsSeller.php');
}

