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
$query_rec_mb = "SELECT * FROM std_it12";
$rec_mb = mysql_query($query_rec_mb, $mysqli) or die(mysql_error());
$row_rec_mb = mysql_fetch_assoc($rec_mb);
$totalRows_rec_mb = mysql_num_rows($rec_mb);

mysql_select_db($database_mysqli, $mysqli);
$query_lo_rec = "SELECT * FROM armza_system";
$lo_rec = mysql_query($query_lo_rec, $mysqli) or die(mysql_error());
$row_lo_rec = mysql_fetch_assoc($lo_rec);
$totalRows_lo_rec = mysql_num_rows($lo_rec);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="table.css">
</head>

<body>
<div align="center">
  <h2>ข้อมูลนักเรียนนักศึกษา</h2></div>
<form id="form2" name="form2" method="post" action="search.php">
  <label for="search"></label>
  <input type="text" name="search" id="search" />
  <input type="submit" name="btnn" id="btnn" value="ค้นหา" />
</form>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <div align="center">
    <table border="1">
      <tr>
        <td><div align="center">ที่</div></td>
        <td><div align="center">รหัสนักศึกษา</div></td>
        <td><div align="center">ชื่อ-นามสกุล</div></td>
        <td><div align="center">แผนกวิชา</div></td>
        <td><div align="center">เบอร์โทรศัพท์</div></td>
      </tr>
      <?php do { ?>
        <tr>
          <td><?php echo $row_rec_mb['id']; ?></td>
          <td><?php echo $row_rec_mb['code_std']; ?></td>
          <td><?php echo $row_rec_mb['name_std']; ?></td>
          <td><?php echo $row_rec_mb['dep_std']; ?></td>
          <td><?php echo $row_rec_mb['tel_std']; ?></td>
        </tr>
        <?php } while ($row_rec_mb = mysql_fetch_assoc($rec_mb)); ?>
    </table>
  </div>
</form>
</body>
</html>
<?php
mysql_free_result($rec_mb);

mysql_free_result($lo_rec);
?>
