<?php
include_once ("framework/MySQLDB.php");

function getConnection()
{
    $host = 'localhost';
    $dbUser = 'root';
    $dbPass = '';
    $dbName = 'AGmarkets';

    // create a new database object and connect to server
    $db = new MySQL($host, $dbUser, $dbPass, $dbName);
    return $db;
}

function getNewDatabase()
{

    // create a new database object and connect to server
    $db = getConnection();
    /*
    //  drop the database and then create it again
    try {
    $db->dropDatabase();
    } catch (exception $ex) {
    }
    */
    $db->createDatabase();

    // select the database
    $db->selectDatabase();
    return $db;
}

function getDatabase()
{

    $db = getConnection();
    $db->selectDatabase();
    return $db;
}

// gets a parameter from the URL, or null if not specified
function getFromURL($key)
{
    if (isset($_GET[$key]))
    {
        return $_GET[$key];
    }
    return null;
}

function sqlSafe($input)
{
    $link = mysqli_connect('localhost', 'root', '', 'AGmarkets');
    return mysqli_real_escape_string($link, stripslashes($input));
}

function getMemberID($username, $password, $user_type)
{
    /* echo "Hello";
     echo $username; */
    $entered_username = sqlSafe($username);
    $entered_password = sqlSafe($password);
    $target_details = "{$username}{$password}";

    // Depends if user is buyer or seller
    if ($user_type == "buyer")
    {
        $table_name = "Buyer1";
    }
    elseif ($user_type == "seller")
    {
        $table_name = "Seller1";
    }
    elseif ($user_type == "admin")
    {
        $table_name = "Admin1";
    }

    $db = getDatabase();
    $sql = "select userId, password from {$table_name} where username='" . $entered_username . "'";
    $result = $db->query($sql);
    if ($result->size() == 1)
    {
        /* echo "Found username"; */
        $row = $result->fetch();
        $hash = $row['password'];
        $id = $row['userId'];
        if (password_verify($target_details, $hash))
        {
            return $id;
        }
    }
    return null;
}

