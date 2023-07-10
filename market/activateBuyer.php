<?php
require_once 'framework/htmlTemplate.php';
require_once 'framework/htmlTable.php';
require_once 'models/member.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/masterPage.php';

try
{
    $pg = new MasterPage();
    $user_id = $_GET['userId'];

    if ($user_id == null)
    {
        throw new Exception("Not valid product id");
    }

    $db = $pg->getDB();
    $sql_initial = "SELECT *
				FROM Buyer1
				WHERE userId={$user_id}";

    $user_details = $db->query($sql_initial);
    if ($user_details->fetch() == "")
    {
        throw new Exception("Not valid buyer id");
    }

    // Updating/ activating buyer
    $sql_insert = "UPDATE Buyer1
			SET activated ='yes'
			WHERE userId={$user_id}";

    $db->query($sql_insert);
    header('Location: marketAdmin.php');
}
catch(exception $ex)
{
    header('Location: marketAdmin.php');
}

