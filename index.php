<?php
  session_unset();
?>
<!DOCTYPE php>
<meta charset='UTF-8'>
<html lang='en'>
  <head>
      <title>2FA Project - Sign-Up/Login Option</title>
      <style>
        @import url("../2FAProject/style/style.css");
      </style>
      <script type="text/javascript">
          history.pushState(null, null, 'no-back-button');
          window.addEventListener('popstate', function(event) {
              history.pushState(null, null, 'no-back-button');
          });
    </script>
  </head>
  <body>
    <div id="mainBody">
        <div id="innerbodySel">
            <div id="titleBoxSel">
                <h1>Two-Factor Authentication Learning Experience</h1>
                <h2 class="lowerSel"> Please Select One Below to Access the Website</h2>
            </div>
            <input class="suButtonSel" type="button" value="Sign-Up" onclick="location.href='../2FAProject/SignUp/SignUp.php'">
            <input class="liButtonSel" type="button" value="Login" onclick="location.href='../2FAProject/Login/Login.php'">
        </div>
    </div>
  </body>
</html>
