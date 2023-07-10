<?php
require_once 'framework/htmlTemplate.php';
require_once 'framework/htmlTable.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/masterPage.php';

try
{
    $pg = new MasterPage();
    $member = $pg->getMember();
	$template = new HtmlTemplate();

    $profile = new MasterPage();
    if ($profile->usertype == null)
    {
        throw new Exception("Not logged in");
    }
    elseif ($profile->usertype == 'admin')
    {
        $content = $profile->getAdminProfileHtml($template);
    }
    else
    {	
		
        $content = $profile->getProfileHtml($template);
    }

    // For Admin:
    if ($_SESSION['memberType'] == 'admin')
    {
        $content .= '</table><a href="updateAdmin.php"><button type="button" class="btn my-button mt-4 mb-3">Update</button></a><br /><br /><br />';
        
    }
	// For Buyer or Seller:
    elseif (($_SESSION['memberType'] == 'buyer') || ($_SESSION['memberType'] == 'seller'))
    {
        $content .= '</table><a href="update.php"><button type="button" class="btn my-button mt-4 mb-3">Update</button></a><br /><br /><br />';
    }

    $pg->setTitle('Account');
    $pg->setContent($content);
    print $pg->getHtml($template);

}
catch(exception $ex)
{

    header("location: login.php");
}

