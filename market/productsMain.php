<?php
include_once 'siteFunctions/commonFunctions.php';
include_once 'siteFunctions/masterPage.php';
require_once 'framework/htmlTemplate.php';
require_once 'framework/htmlTable.php';

$pg = new masterPage();

if ($_SESSION['memberType'] == 'admin')
{
    header('Location: marketUsers.php');
}
elseif ($_SESSION['memberType'] == 'buyer')
{
    header('Location: productsUser.php');
}
elseif ($_SESSION['memberType'] == 'seller')
{
    header('Location: productsSeller.php');
}
else
{
    header('Location: login.php');
}

