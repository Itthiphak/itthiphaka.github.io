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
$query_arm_rec_home = "SELECT * FROM armza_system";
$arm_rec_home = mysql_query($query_arm_rec_home, $mysqli) or die(mysql_error());
$row_arm_rec_home = mysql_fetch_assoc($arm_rec_home);
$totalRows_arm_rec_home = mysql_num_rows($arm_rec_home);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="stylehome.css">
</head>

<body>
<div align="center">
  <table border="1">
    <tr>
      <td>id</td>
      <td>uname</td>
      <td>myname</td>
      <td>email</td>
      <td>tel</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_arm_rec_home['id']; ?></td>
        <td><?php echo $row_arm_rec_home['uname']; ?></td>
        <td><?php echo $row_arm_rec_home['myname']; ?></td>
        <td><?php echo $row_arm_rec_home['email']; ?></td>
        <td><?php echo $row_arm_rec_home['tel']; ?></td>
      </tr>
      <?php } while ($row_arm_rec_home = mysql_fetch_assoc($arm_rec_home)); ?>
  </table>
</div>
</body>
</html>
<?php
mysql_free_result($arm_rec_home);
?>
