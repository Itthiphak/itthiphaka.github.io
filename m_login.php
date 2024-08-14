<?php require_once('Connections/mysqli.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_mysqli, $mysqli);
$query_m_log = "SELECT * FROM std_it12";
$m_log = mysql_query($query_m_log, $mysqli) or die(mysql_error());
$row_m_log = mysql_fetch_assoc($m_log);
$totalRows_m_log = mysql_num_rows($m_log);

$query_m_log_rec = "SELECT * FROM armza_system";
$m_log_rec = mysql_query($query_m_log_rec, $mysqli) or die(mysql_error());
$row_m_log_rec = mysql_fetch_assoc($m_log_rec);
$totalRows_m_log_rec = mysql_num_rows($m_log_rec);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['name_std'])) {
  $loginUsername=$_POST['name_std'];
  $password=$_POST['code_std'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "member.php";
  $MM_redirectLoginFailed = "m_login.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_mysqli, $mysqli);
  
  $LoginRS__query=sprintf("SELECT name_std, code_std FROM std_it12 WHERE name_std=%s AND code_std=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $mysqli) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login For Html Css</title>
<link rel="stylesheet" href="style_font.css">
</head>
<body>
<div class="login-form">
        <h1>Login</h1>
        <div class="container">
            <div class="main">
                <div class="content">
                    <h2>เข้าสู่ระบบนักเรียนนักศึกษา</h2>
                    <form ACTION="<?php echo $loginFormAction; ?>" method="POST">
                        <input type="text" name="name_std" placeholder="User Name" required autofocus id="name_std">
                        <input type="password" name="code_std" placeholder="User Password" required autofocus id="code_std">
                         <button class="btn" type="submit">เข้าสู่ระบบ</button>

                    </form>
                    <p class="account">Don't Have An Account? <a href="register.php">Register</a></p>
                     
                </div>
                <div class="form-img">
                    <img src="image/pngegg.png" alt="">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
mysql_free_result($m_log);
?>
