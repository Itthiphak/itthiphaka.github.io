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
$query_arm_rec_addmin = "SELECT * FROM armza_system";
$arm_rec_addmin = mysql_query($query_arm_rec_addmin, $mysqli) or die(mysql_error());
$row_arm_rec_addmin = mysql_fetch_assoc($arm_rec_addmin);
$totalRows_arm_rec_addmin = mysql_num_rows($arm_rec_addmin);

mysql_select_db($database_mysqli, $mysqli);
$query_rec_std_a = "SELECT * FROM std_it12";
$rec_std_a = mysql_query($query_rec_std_a, $mysqli) or die(mysql_error());
$row_rec_std_a = mysql_fetch_assoc($rec_std_a);
$totalRows_rec_std_a = mysql_num_rows($rec_std_a);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="table.css">
</head>

<body>
<h2 align="center">ข้อมูลนักเรียนนักศึกษา</h2>
<form id="form1" name="form1" method="post" action="searcha.php">
  <label for="search2"></label>
  <input type="text" name="search2" id="search2" />
  <input type="submit" name="btnnn" id="btnnn" value="ค้นหา" />
</form>
<p align="center">&nbsp;</p>
<table border="1">
  <tr>
    <td><div align="center">ที่</div></td>
    <td><div align="center">รหัสนักศึกษา</div></td>
    <td><div align="center">ชื่อ-นามสกุล</div></td>
    <td><div align="center">แผนก</div></td>
    <td><div align="center">เบอร์โทรศัพท์</div></td>
    <td><div align="center">option</div></td>
    <td><div align="center">option</div></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><div align="center"><?php echo $row_rec_std_a['id']; ?></div></td>
      <td><?php echo $row_rec_std_a['code_std']; ?></td>
      <td><?php echo $row_rec_std_a['name_std']; ?></td>
      <td><?php echo $row_rec_std_a['dep_std']; ?></td>
      <td><?php echo $row_rec_std_a['tel_std']; ?></td>
      <td><a href="delete.php?id=<?php echo $row_rec_std_a['id']; ?>?id=<?php echo $row_rec_std_a['']; ?>?id=<?php echo $row_arm_rec_addmin['id']; ?>">delete</a></td>
      <td><a href="update.php?id=<?php echo $row_rec_std_a['id']; ?>?id=<?php echo $row_rec_std_a['']; ?>?id=<?php echo $row_rec_std_a['']; ?>?id=<?php echo $row_rec_std_a['id']; ?>?id=<?php echo $row_arm_rec_addmin['id']; ?>">update</a></td>
    </tr>
    <?php } while ($row_rec_std_a = mysql_fetch_assoc($rec_std_a)); ?>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($arm_rec_addmin);

mysql_free_result($rec_std_a);
?>
