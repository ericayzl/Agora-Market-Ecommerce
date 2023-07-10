<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/masterPage.php';
require_once 'siteFunctions/formFunctions.php';

$pg = new MasterPage();
$method = $_SERVER['REQUEST_METHOD'];
$template = new HtmlTemplate();

$error = null;
$form_errors = [];
if ($method == 'POST')
{
    $user = [];
    $user['userType'] = $_SESSION['memberType'];
    $user['productName'] = htmlspecialchars($_POST['productName']);
    $user['productDescription'] = htmlspecialchars($_POST['productDescription']);
    $user['productCategory'] = htmlspecialchars($_POST['productCategory']);
    $user['price'] = htmlspecialchars($_POST['price']);

    $form_errors = validate_product($user);
    if (!$form_errors)
    {
        $db = getNewDatabase();
        $db->insertRow("INSERT INTO Product
					(userId, productName, productDescription, category, buyNow)
					VALUES ({$_SESSION['memberID']}, '{$user['productName']}', '{$user['productDescription']}','{$user['productCategory']}','{$user['price']}')");
        header('Location: productsSeller.php');
    }
}
if ($_SESSION['memberType'] != "seller")
{
    header('Location: marketUsers.php');
}
$login = new HtmlTemplate();
$login->setTemplate('addProduct.html');
$content = '';
if ($form_errors != null)
{
    echo "Is it here?";
    $content .= '<br/><br/>' . display_errors($form_errors) . '<br/>';
}
$content .= $login->getHtml(array());

$pg->setTitle('Add Product');
$pg->setContent($content);
print $pg->getHtml($template);

