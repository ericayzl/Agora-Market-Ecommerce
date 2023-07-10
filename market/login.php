<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/masterPage.php';
require_once 'siteFunctions/formFunctions.php';

$pg = new masterPage();
$method = $_SERVER['REQUEST_METHOD'];
$error = null;
$content = '';
$template = new HtmlTemplate();

if (@$_SESSION['memberID'] != null)
{
    header('Location: userProfile.php');
}

if ($method == 'POST')
{
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $user_type = $_POST['userType'];
	
	if ($_POST['userType']="Please choose your account user type")
	{
		header('Location: login.php');
	}

    $memberID = getMemberID($userName, $password, $user_type);
    if ($memberID == null)
    {
        $error = 'Your login credentials were rejected, please try again.';
    }
    else
    {
        $_SESSION['memberID'] = $memberID;
        $_SESSION['memberType'] = $user_type;
        header('Location: userProfile.php');
        exit;
    }
}


if ($error != null)
{
    $content .= "<br/><br/><p style=\"color: #e7475e\">" . $error . '<p><br/>';
}
$login = new HtmlTemplate();
$login->setTemplate('loginForm.html');
$content .= $login->getHtml(array());

$pg->setTitle('Member Login');
$pg->setContent($content);
print $pg->getHtml($template);

