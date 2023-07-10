<?php
include_once 'siteFunctions/commonFunctions.php';
include_once 'siteFunctions/masterPage.php';
require_once 'framework/htmlTemplate.php';
require_once 'framework/htmlTable.php';

$page = new MasterPage();
$template = new HtmlTemplate();

$page->setTitle('Status');

$content = '';

if ($_SESSION['memberType'] == 'admin')
{
    $content = '<p>Agora Team is activating your account. This will take approximately 3 working days. Once activated, you will be able to access the Market and Product pages.</p>';
}
elseif (($_SESSION['memberType'] == 'buyer') || ($_SESSION['memberType'] == 'seller'))
{
    $content = '<p>Your account is pending activation from the market admin. Once activated, you will be able to use this feature!</p>';
}
else
{
    header('Location: login.php');
}

$page->setContent($content);
print $page->getHtml($template);

