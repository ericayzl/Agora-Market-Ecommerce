<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/masterPage.php';
require_once 'siteFunctions/formFunctions.php';

$pg = new MasterPage();
$method = $_SERVER['REQUEST_METHOD'];
$template = new HtmlTemplate();

$error = null;
$form_errors = [];
if ($method == 'POST')
{
    $details_to_hash = "{$_POST['userName']}{$_POST['password']}";

    $user = [];
    $user['firstName'] = htmlspecialchars($_POST['firstName']);
    $user['lastName'] = htmlspecialchars($_POST['lastName']);
    $user['userName'] = htmlspecialchars($_POST['userName']);
    $user['rawPassword'] = htmlspecialchars($_POST['password']);

    $user['password'] = password_hash($details_to_hash, PASSWORD_DEFAULT);

    $user['email'] = htmlspecialchars($_POST['email']);
    $user['dateOfBirth'] = htmlspecialchars($_POST['dateOfBirth']);
    $user['confirmPassword'] = htmlspecialchars($_POST['confirmPassword']);
    $user['userType'] = htmlspecialchars($_POST['userType']);
    $user['profileDescription'] = htmlspecialchars($_POST['profileDescription']);

    if ($user['userType'] == "buyer")
    {
        $table_name = "Buyer1";
    }
    elseif ($user['userType'] == "seller")
    {
        $table_name = "Seller1";
    }

    $form_errors = validate_user($user);

    if (!$form_errors)
    {
        $db = getNewDatabase();
        $db->insertRow("INSERT INTO {$table_name}
					(firstName, lastName, username, password, email, dateOfBirth, profileDescription)
					VALUES ('{$user['firstName']}', '{$user['lastName']}', '{$user['userName']}','{$user['password']}','{$user['email']}', '{$user['dateOfBirth']}', '{$user['profileDescription']}')");
        header('Location: login.php');
    }

}

$login = new HtmlTemplate();
$login->setTemplate('signUpForm.html');
$content = '';
if ($form_errors != null)
{
    $content .= '<br/><br/>' . display_errors($form_errors) . '<br/>';
}
$content .= $login->getHtml(array());

$pg->setTitle('Member Sign Up');
$pg->setContent($content);
print $pg->getHtml($template);

