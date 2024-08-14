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

$colname_arm_rec_search = "-1";
if (isset($_POST['search'])) {
  $colname_arm_rec_search = $_POST['search'];
}
mysql_select_db($database_mysqli, $mysqli);
$query_arm_rec_search = sprintf("SELECT * FROM armza_system WHERE uname LIKE %s", GetSQLValueString("%" . $colname_arm_rec_search . "%", "text"));
$arm_rec_search = mysql_query($query_arm_rec_search, $mysqli) or die(mysql_error());
$row_arm_rec_search = mysql_fetch_assoc($arm_rec_search);
$totalRows_arm_rec_search = mysql_num_rows($arm_rec_search);

$colname_se_rec_std = "-1";
if (isset($_POST['search'])) {
  $colname_se_rec_std = $_POST['search'];
}
mysql_select_db($database_mysqli, $mysqli);
$query_se_rec_std = sprintf("SELECT * FROM std_it12 WHERE name_std LIKE %s", GetSQLValueString("%" . $colname_se_rec_std . "%", "text"));
$se_rec_std = mysql_query($query_se_rec_std, $mysqli) or die(mysql_error());
$row_se_rec_std = mysql_fetch_assoc($se_rec_std);
$totalRows_se_rec_std = mysql_num_rows($se_rec_std);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="table.css">
</head>

<body>
<table border="1">
  <tr>
    <td><div align="center">ที่</div></td>
    <td><div align="center">รหัสนักศึกษา</div></td>
    <td><div align="center">ชื่อ-นามสกุล</div></td>
    <td><div align="center">แผนก</div></td>
    <td><div align="center">เบอร์โทรศัพท์</div></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><div align="center"><?php echo $row_se_rec_std['id']; ?></div></td>
      <td><?php echo $row_se_rec_std['code_std']; ?></td>
      <td><?php echo $row_se_rec_std['name_std']; ?></td>
      <td><?php echo $row_se_rec_std['dep_std']; ?></td>
      <td><?php echo $row_se_rec_std['tel_std']; ?></td>
    </tr>
    <?php } while ($row_se_rec_std = mysql_fetch_assoc($se_rec_std)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($arm_rec_search);

mysql_free_result($se_rec_std);
?>
