<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/masterPage.php';
require_once 'siteFunctions/formFunctions.php';

$pg = new masterPage();
/* echo "In here"; */
$method = $_SERVER['REQUEST_METHOD'];
$error = null;
if ($method == 'POST')
{
    if ($_POST['market'] == "le_ciel_gifts")
    {
        header('Location: login.php');
    }
}
else
{
    header('Location: ../index.php');
}

