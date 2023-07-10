<?php
require_once 'framework/htmlTemplate.php';
require_once 'framework/htmlTable.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/masterPage.php';
require_once 'siteFunctions/formFunctions.php';

try
{
    $pg = new MasterPage();
    $method = $_SERVER['REQUEST_METHOD'];
    $member = $pg->getMember();
    $form_errors = [];
	$template = new HtmlTemplate();

    if ($method == 'POST')
    {
        $user = [];
        $user['userType'] = $_SESSION['memberType'];
        $user['marketName'] = htmlspecialchars($_POST['marketName']);
        $user['marketDescription'] = htmlspecialchars($_POST['marketDescription']);
        $user['firstName'] = htmlspecialchars($_POST['firstName']);
        $user['lastName'] = htmlspecialchars($_POST['lastName']);
        $user['email'] = htmlspecialchars($_POST['email']);
        $user['dateOfBirth'] = htmlspecialchars($_POST['dateOfBirth']);

        $form_errors = validate_update($user);
		
		// if no errors, then update
        if (!$form_errors)
        {
            $db = getNewDatabase();

            $db->query("UPDATE Admin1
						SET
							firstName = '{$user['firstName']}',
							lastName = '{$user['lastName']}',
							email = '{$user['email']}',
							dateOfBirth = '{$user['dateOfBirth']}',
							marketName = '{$user['marketName']}',
							marketDescription = '{$user['marketDescription']}'
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
    elseif ($profile->usertype != 'admin')
    {
        header('Location: update.php');
    }
	
    $content = '';
	// If errors in form entry
    if ($form_errors != null)
    {

        $content .= '<br/><br/>' . display_errors($form_errors) . '<br/>';
    }

    $content .= $profile->getAdminUpdateHtml($template);

    $pg->setTitle('Update');
    $pg->setContent($content);
    print $pg->getHtml($template);

}
catch(exception $ex)
{
    header("location: login.php");
}


