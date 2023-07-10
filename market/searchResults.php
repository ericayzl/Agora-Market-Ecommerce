<?php
include_once 'siteFunctions/commonFunctions.php';
include_once 'siteFunctions/masterPage.php';
require_once 'framework/htmlTemplate.php';
require_once 'framework/htmlTable.php';

$page = new MasterPage();
$template = new HtmlTemplate();

$page->setTitle('Search results');
$page->setContent('<p>This feature is coming soon!</p>');
print $page->getHtml($template);

