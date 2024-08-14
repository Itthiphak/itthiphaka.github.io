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

$colname_search_a = "-1";
if (isset($_POST['search2'])) {
  $colname_search_a = $_POST['search2'];
}
mysql_select_db($database_mysqli, $mysqli);
$query_search_a = sprintf("SELECT * FROM std_it12 WHERE name_std LIKE %s", GetSQLValueString("%" . $colname_search_a . "%", "text"));
$search_a = mysql_query($query_search_a, $mysqli) or die(mysql_error());
$row_search_a = mysql_fetch_assoc($search_a);
$totalRows_search_a = mysql_num_rows($search_a);
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
    <td><div align="center">option</div></td>
    <td><div align="center">option</div></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><div align="center"><?php echo $row_search_a['id']; ?></div></td>
      <td><?php echo $row_search_a['code_std']; ?></td>
      <td><?php echo $row_search_a['name_std']; ?></td>
      <td><?php echo $row_search_a['dep_std']; ?></td>
      <td><?php echo $row_search_a['tel_std']; ?></td>
      <td><a href="delete.php?id=<?php echo $row_search_a['id']; ?>">Delete</a></td>
      <td><a href="update.php?id=<?php echo $row_search_a['id']; ?>">Update</a></td>
    </tr>
    <?php } while ($row_search_a = mysql_fetch_assoc($search_a)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($search_a);
?>
