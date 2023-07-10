<?php
include_once 'siteFunctions/commonFunctions.php';
include_once 'siteFunctions/masterPage.php';
require_once 'framework/htmlTemplate.php';
require_once 'framework/htmlTable.php';

$page = new MasterPage();
$template = new HtmlTemplate();

if ($_SESSION['memberID'] == null)
{
    header('Location: login.php');
}

if ($page->activation == 'no')
{
    header('Location: activation.php');
}

$page->setTitle('Your Cart');
$page->setContent('<p>This feature is coming soon!</p>');
print $page->getHtml($template);

