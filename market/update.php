<?php
require_once 'framework/htmlTemplate.php';
require_once 'framework/htmlTable.php';
require_once 'models/member.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/masterPage.php';
require_once 'siteFunctions/formFunctions.php';

try
{
    $pg = new MasterPage();
    $method = $_SERVER['REQUEST_METHOD'];

    $member = $pg->getMember();
    $memberID = $member->getID();
	$template = new HtmlTemplate();

    $form_errors = [];

    if ($method == 'POST')
    {
        $user = [];
        $user['userType'] = $_SESSION['memberType'];
        $user['firstName'] = htmlspecialchars($_POST['firstName']);
        $user['lastName'] = htmlspecialchars($_POST['lastName']);
        $user['email'] = htmlspecialchars($_POST['email']);
        $user['dateOfBirth'] = htmlspecialchars($_POST['dateOfBirth']);
        $user['profileDescription'] = htmlspecialchars($_POST['profileDescription']);

        if ($_SESSION['memberType'] == "buyer")
        {
            $table_name = "Buyer1";
        }
        elseif ($_SESSION['memberType'] == "seller")
        {
            $table_name = "Seller1";
        }

        $form_errors = validate_update($user);
        if (!$form_errors)
        {
            $db = getNewDatabase();

            $db->query("UPDATE {$table_name}
						SET
							firstName = '{$user['firstName']}',
							lastName = '{$user['lastName']}',
							email = '{$user['email']}',
							dateOfBirth = '{$user['dateOfBirth']}',
							profileDescription = '{$user['profileDescription']}'
						WHERE userId = '{$_SESSION['memberID']}'");
            header('Location: userProfile.php');
        }
    }

    // GET
    $profile = new MasterPage();
    if ($profile->usertype == null)
    {
        throw new Exception("Not logged in");
    }
    elseif ($profile->usertype == 'admin')
    {
        header('Location: updateAdmin.php');
    }

    $content = '';

    if ($form_errors != null)
    {
        $content .= '<br/><br/>' . display_errors($form_errors) . '<br/>';
    }

    $content .= $profile->getUpdateHtml($template);

    $pg->setTitle('Update');
    $pg->setContent($content);
    print $pg->getHtml($template);

}
catch(exception $ex)
{
    header("location: login.php");
}

