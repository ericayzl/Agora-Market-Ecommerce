<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/masterPage.php';
require_once 'siteFunctions/formFunctions.php';

$pg = new masterPage();
$method = $_SERVER['REQUEST_METHOD'];
$error = null;
if ($_SESSION['memberType'] == 'admin')
{
    header('Location: marketAdmin.php');
}
elseif (($_SESSION['memberType'] == 'buyer') || ($_SESSION['memberType'] == 'seller'))
{
    header('Location: marketUsers.php');
}
else
{
    header('Location: login.php');
}

