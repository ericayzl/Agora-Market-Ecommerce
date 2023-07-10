<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/masterPage.php';
require_once 'siteFunctions/formFunctions.php';

session_save_path('.\sessions');
session_start();
session_destroy();

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
    $user['userType'] = 'admin';
    $user['marketDescription'] = htmlspecialchars($_POST['marketDescription']);
    $user['marketName'] = htmlspecialchars($_POST['marketName']);

    $form_errors = validate_user($user);
    if (!$form_errors)
    {
        $db = getNewDatabase();
        $db->insertRow("INSERT INTO Admin1
					(firstName, lastName, username, password, email, dateOfBirth, marketName, marketDescription)
					VALUES ('{$user['firstName']}', '{$user['lastName']}', '{$user['userName']}','{$user['password']}','{$user['email']}', '{$user['dateOfBirth']}', '{$user['marketName']}', '{$user['marketDescription']}')");
        header('Location: login.php');
    }
}

// Get
$login = new HtmlTemplate();
$login->setTemplate('signUpFormAdmin.html');
$content = '';
if ($form_errors != null)
{
    $content .= '<br/><br/>' . display_errors($form_errors) . '<br/>';
}
$content .= $login->getHtml(array());

$pg->setTitle('Market Creation');
$pg->setContent($content);
print $pg->getMarketCreationHtml($template);

