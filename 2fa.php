<?php
session_start();
   //Establishes the Connection to the Database
   //require '../dbConnect.php';
   $dbConnect = mysqli_connect("138.88.73.64", "amorphew", "Climatal11!", "amorphew");
   //prints based on if the connection is correct
   if($dbConnect == false) {
     print "Unable to connect to the database: " . mysqli_errno();
   }
   else {
     if(isset($_POST['Submit']))
     {
         $code = mysqli_real_escape_string($dbConnect,$_POST['2FAPin']);
         if ($code != "")
         {
           $email = $_SESSION['email'];
           $tableNamePin = 'auth_pin';
            //select the number of accounts with the similar email address (should one be one email)
            $sql_query = "SELECT COUNT(Acc_Email) AS cntUser FROM $tableNamePin WHERE Acc_Email='$email';";
            $result = mysqli_query($dbConnect,$sql_query);
            $row = mysqli_fetch_array($result);

            //select the OTP from the OTP table where the emails match

            $sql_query2 = "SELECT OTP FROM $tableNamePin WHERE Acc_Email= '$email';";
            $result2 = mysqli_query($dbConnect,$sql_query2);
            $row2 = mysqli_fetch_array($result2);

            $count = $row['cntUser'];
            $dbOTP = $row2['OTP'];

            //verify that their is only one account with the email, and that the OTPs match
            if($count == 1 && $dbOTP == $code)
            {
                //similar function to create a random 6-digit string
                 $tableNamePin = 'auth_pin';
                 //create a query to add to a second table in the database
                 $query2 = "DELETE FROM $tableNamePin WHERE OTP = '$code';";
                 //run the query on the database
                 $result2 = mysqli_query($dbConnect, $query2);

                //redirect the user to the 2FA page
                header("Location:http://138.88.73.64/2FAProject/internalWebpage/welcome.php");
                exit();
             }
             else
             {
                 echo "<script type ='text/javascript'>alert('Incorrect Code')</script>";
             }

         }
         else
         {
             //echo an error - a code needs to be entered
             echo "<script type ='text/javascript'>alert('Enter a Code')</script>";
         }
     }
     else if (isset($_POST['no'])) { //when no code was delivered
       {
          $tableNamePin = 'auth_pin';
          $email = $_SESSION['email'];
          //create a query to delete an OTP
          $query2 = "DELETE FROM $tableNamePin WHERE Acc_Email = '$email';";
          //run the query on the database
          $result2 = mysqli_query($dbConnect, $query2);

          header("Location:http://138.88.73.64/2FAProject/index.php");
          exit();
       }
     }
  }
  mysqli_close($dbConnect);
?>
<!DOCTYPE php>
<meta charset='UTF-8'>
<html lang='en'>
  <head>
      <title>2FA Project - Authentication</title>
      <style>
        @import url("../style/style.css");
      </style>
  </head>
  <body>
    <form method='POST'>
    <div id="mainBody">
        <div id="innerbodySU">
            <div id="titleBoxSU">
              <h1>Multi-Factor PIN</h1>
              <h2 class="lowerSel">Please Check Your Account Email Address for PIN</h2>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div id="lower2FA">
              <p><b>PIN:</b></p>
                <input style="height:30%;" class="input" type="text" id="PIN" name="2FAPin" minlength="1" maxlength="6">
            </div>

            <br>
            <br>
            <br>
            <input class="subButtonSU" type="submit" name='Submit' value="Proceed:"><input class="accButtonSU" type="submit" name='no' value="No PIN? Click Here">
        </div>
    </div>
  </form>
  </body>
</html>
