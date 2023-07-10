<?php
require_once 'siteFunctions/commonFunctions.php';
require_once 'framework/MySQLDB.php';

function validate_user($user)
{
    /* echo "Ino the validation"; */
    $errors = [];
    if (is_blank($user['firstName']))
    {
        $errors[] = "First name cannot be blank.";
    }
    elseif (!has_length($user['firstName'], array(
        'min' => 2,
        'max' => 70
    )))
    {
        $errors[] = "First name must be between 2 and 70 characters.";
    }

    if (is_blank($user['lastName']))
    {
        $errors[] = "Last name cannot be blank.";
    }
    elseif (!has_length($user['lastName'], array(
        'min' => 2,
        'max' => 70
    )))
    {
        $errors[] = "Last name must be between 2 and 70 characters.";
    }

    if (is_blank($user['email']))
    {
        $errors[] = "Email cannot be blank.";
    }
    elseif (!has_length($user['email'], array(
        'max' => 100
    )))
    {
        $errors[] = "Last name must be less than 100 characters.";
    }
    elseif (!has_valid_email_format($user['email']))
    {
        $errors[] = "Email must be a valid format.";
    }

    if (is_blank($user['userName']))
    {
        $errors[] = "Username cannot be blank.";
    }
    elseif (!has_length($user['userName'], array(
        'min' => 6,
        'max' => 70
    )))
    {
        $errors[] = "Username must be between 6 and 70 characters.";
    }
    elseif (!has_unique_username($user['userName'], $user['userType']))
    {
        $errors[] = "Username has been taken. Please enter another username.";
    }

    if (is_blank($user['rawPassword']))
    {
        $errors[] = "Password cannot be blank.";
    }
    elseif (!has_length($user['rawPassword'], array(
        'min' => 8
    )))
    {
        $errors[] = "Password must contain 8 or more characters";
    }
    elseif (!preg_match('/[A-Z]/', $user['rawPassword']))
    {
        $errors[] = "Password must contain at least 1 uppercase letter";
    }
    elseif (!preg_match('/[a-z]/', $user['rawPassword']))
    {
        $errors[] = "Password must contain at least 1 lowercase letter";
    }
    elseif (!preg_match('/[0-9]/', $user['rawPassword']))
    {
        $errors[] = "Password must contain at least 1 number";
    }
    elseif (!preg_match('/[^A-Za-z0-9\s]/', $user['rawPassword']))
    {
        $errors[] = "Password must contain at least 1 symbol";
    }
    elseif ($user['userName'] == $user['rawPassword'])
    {
        $errors[] = "Username and password must be different";
    }

    if (is_blank($user['confirmPassword']))
    {
        $errors[] = "Confirm password cannot be blank.";
    }
    elseif ($user['rawPassword'] !== $user['confirmPassword'])
    {
        $errors[] = "Password and confirm password must match.";
    }
	
	if (is_blank($user['dateOfBirth']))
    {
        $errors[] = "Date of birth cannot be blank.";
    }

    if (($user['userType'] != "buyer") && ($user['userType'] != "seller") && ($user['userType'] != "admin"))
    {
        /* echo "Now <br />";
         echo $user['userType']; */
        $errors[] = "Please select a user type.";
    }

    if (($user['userType'] == "admin"))
    {
        if (is_blank($user['marketName']))
        {
            $errors[] = "Market name cannot be blank.";
        }
        elseif (!has_length($user['marketName'], array(
            'min' => 2,
            'max' => 70
        )))
        {
            $errors[] = "Market name must be between 2 and 70 characters.";
        }
    }

    /* echo "End of validation"; */
    return $errors;
}

function validate_update($user)
{
    /* echo "Ino the validation"; */
    $errors = [];
    if (is_blank($user['firstName']))
    {
        $errors[] = "First name cannot be blank.";
    }
    elseif (!has_length($user['firstName'], array(
        'min' => 2,
        'max' => 70
    )))
    {
        $errors[] = "First name must be between 2 and 70 characters.";
    }

    if (is_blank($user['lastName']))
    {
        $errors[] = "Last name cannot be blank.";
    }
    elseif (!has_length($user['lastName'], array(
        'min' => 2,
        'max' => 70
    )))
    {
        $errors[] = "Last name must be between 2 and 70 characters.";
    }

    if (is_blank($user['email']))
    {
        $errors[] = "Email cannot be blank.";
    }
    elseif (!has_length($user['email'], array(
        'max' => 100
    )))
    {
        $errors[] = "Last name must be less than 100 characters.";
    }
    elseif (!has_valid_email_format($user['email']))
    {
        $errors[] = "Email must be a valid format.";
    }

    if (($user['userType'] != "buyer") && ($user['userType'] != "seller") && ($user['userType'] != "admin"))
    {
        /* echo "Now <br />";
         echo $user['userType']; */
        $errors[] = "Please login again.";
    }
	if (is_blank($user['dateOfBirth']))
    {
        $errors[] = "Date of birth cannot be blank.";
    }

    if (($user['userType'] == "admin"))
    {
        if (is_blank($user['marketName']))
        {
            $errors[] = "Market name cannot be blank.";
        }
        elseif (!has_length($user['marketName'], array(
            'min' => 2,
            'max' => 70
        )))
        {
            $errors[] = "Market name must be between 2 and 70 characters.";
        }
    }

    /* echo "End of validation"; */
    return $errors;
}

function validate_product($user)
{
    /* echo "Ino the validation"; */
    $errors = [];
    if (is_blank($user['productName']))
    {
        $errors[] = "Product name cannot be blank.";
    }
    elseif (!has_length($user['productName'], array(
        'min' => 2,
        'max' => 70
    )))
    {
        $errors[] = "Product name must be between 2 and 70 characters.";
    }

    if ($user['productCategory'] == "Select your product category")
    {
        $errors[] = "Product category cannot be blank.";
    }

    if (is_blank($user['price']))
    {
        $errors[] = "Price cannot be blank.";
    }
    elseif (($user['price']) <= 0)
    {
        $errors[] = "Price cannot be zero dollars or less.";
    }
    elseif (($user['price']) > 100000)
    {
        $errors[] = "Sorry, this market only accepts products $10,000 or less.";
    }

    if ($user['userType'] != "seller")
    {
        /* echo "Now <br />";
         echo $user['userType']; */
        $errors[] = "Only sellers can add a product. Please login as a seller.";
    }

    /* echo "End of validation"; */
    return $errors;
}

function is_blank($value)
{
    return !isset($value) || trim($value) === '';
}

function has_length_greater_than($value, $min)
{
    $length = strlen($value);
    return $length > $min;
}

function has_length_less_than($value, $max)
{
    $length = strlen($value);
    return $length < $max;
}

function has_length_exactly($value, $exact)
{
    $length = strlen($value);
    return $length == $exact;
}

function has_length($value, $options)
{
    if (isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1))
    {
        return false;
    }
    elseif (isset($options['max']) && !has_length_less_than($value, $options['max'] + 1))
    {
        return false;
    }
    elseif (isset($options['exact']) && !has_length_exactly($value, $options['exact']))
    {
        return false;
    }
    else
    {
        return true;
    }
}

function has_valid_email_format($value)
{
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
}

function has_unique_username($username, $user_type)
{
    $db = getNewDatabase();
    $db->connectToServer();
    $db->selectDatabase();

    /* echo "Into the function<br />";
     echo $user_type; */
    if ($user_type == "buyer")
    {
        /* echo "<br />Is buyer"; */
        $result = $db->query("SELECT * FROM Buyer1
							WHERE username='" . db_escape($db->dbConn, $username) . "'");
    }
    elseif ($user_type == "seller")
    {
        /* echo "<br />Is seller"; */
        $result = $db->query("SELECT * FROM Seller1
							WHERE username='" . db_escape($db->dbConn, $username) . "'");
    }
    elseif ($user_type == "admin")
    {
        return true;
    }
    elseif ($user_type == "Please choose your account user type")
    {
        return false;
    }
    /* echo "Size is: " . $result->size(); */

    return $result->size() === 0;

}

function db_escape($connection, $string)
{
    return mysqli_real_escape_string($connection, $string);
}

function display_errors($errors = array())
{
    $output = '';
    if (!empty($errors))
    {
        $output .= "<div class=\"errors\" style=\"color: #e7475e\">";
        $output .= "Please fix the following errors:";
        $output .= "<ul>";
        foreach ($errors as $error)
        {
            $output .= "<li>" . htmlspecialchars($error) . "</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
    }
    return $output;
}

