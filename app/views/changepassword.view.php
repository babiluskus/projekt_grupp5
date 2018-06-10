<html>
<head>
<title> <?php echo $data[0]['fname']; ?>'s page</title> <!-- prints out the users surname, is currently overrided with the header.php file -->
<link rel="stylesheet" href="css/account.css" type="text/css"/>
</head>
<div class="container">

<?php

if(!isset($_SESSION['loggedIn']['uid'])){ //if login in session is not set, return to index-page
    header("Location: index.php");
}

//var_dump($data);

//Users title 

printf("<h1 class='text-uppercase text-center'> %s</h1>", $data[0] ['fname'] . " " . $data[0] ['lname']); //displays the users surname and lastname

?>

<a  href="<?php echo URLrewrite::BaseURL(). 'account'?>"><button id="" class="btn btn-primary">My details</button></a> 
<a  href="<?php echo URLrewrite::BaseURL().'orderhistory'?>"><button id="" class="btn btn-primary">My Order History</button></a><!-- here is the options between the users account and order history -->
<a href="<?php echo URLrewrite::BaseURL().'updateuser' ?>"><button id="updateUser" class="btn btn-primary updateButton">Update User Information</button></a>
<a href="<?php echo URLrewrite::BaseURL().'changepassword' ?>" class="btn btn-primary">Change password</a><br>

<!--- Change password form -->

<?php
    $uid = $_SESSION['loggedIn']['uid'];

if (isset($_POST['submit'])) { //using this tutorial https://www.youtube.com/watch?v=IC_H-91DnVs

    //echo "test";

    //check fields
    $oldpassword = md5($_POST['oldpassword']);
    $newpassword = md5($_POST['newpassword']);
    $repeatnewpassword = md5($_POST['repeatnewpassword']);

    //echo"$oldpassword/$newpassword/$repeatnewpassword";

    $oldpassworddb = $data[0] ['password'];

    //echo $oldpassworddb."<br>"; only debugg 
    //echo $oldpassword."<br>"; only debugg 

    //check password

    if ($oldpassword==$oldpassworddb){

        //check two new passwords
        if ($newpassword==$repeatnewpassword){

            //sucess
            //change password in db

            echo "Sucess!";
           /* $querychange = mysql_query("UPDATE account SET password='$newpassword' WHERE uid=:uid");

            die("Your password has been changed");
            session_destroy();
            header('Location:'.URLrewrite::baseURL()); */
        }

        else {

            die("New passwords don't match!");
        }

    }

    else {
        die("Old password is incorrect, try again!");
    }


}

else { 

echo"
<h3 class='text-center'>Change password </h3> <br>

<div class='form-group'>
    <form action='".URLrewrite::BaseURL().'changepassword/changeUserPassword/'.$uid."'method='POST'>
    <label for=''>Old password</label>
    <input type='text' class='form-control' id='' name='oldpassword'>
    <label for=''>New password</label>
    <input type='password' class='form-control' id='' name='newpassword' required>
    <label for=''>Repeat new password</label>
    <input type='password' class='form-control' id='' name='repeatnewpassword'>
  <input type='submit' class='btn btn-primary' name='submit' value='Change password'>
  </div>
  </form>";
}
  ?>

</div>

</body>

</html>