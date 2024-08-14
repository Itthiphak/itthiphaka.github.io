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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE std_it12 SET code_std=%s, name_std=%s, dep_std=%s, tel_std=%s WHERE id=%s",
                       GetSQLValueString($_POST['code_std'], "text"),
                       GetSQLValueString($_POST['name_std'], "text"),
                       GetSQLValueString($_POST['dep_std'], "text"),
                       GetSQLValueString($_POST['tel_std'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_mysqli, $mysqli);
  $Result1 = mysql_query($updateSQL, $mysqli) or die(mysql_error());

  $updateGoTo = "addmin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_up_d = "-1";
if (isset($_GET['id'])) {
  $colname_up_d = $_GET['id'];
}
mysql_select_db($database_mysqli, $mysqli);
$query_up_d = sprintf("SELECT * FROM std_it12 WHERE id = %s", GetSQLValueString($colname_up_d, "int"));
$up_d = mysql_query($query_up_d, $mysqli) or die(mysql_error());
$row_up_d = mysql_fetch_assoc($up_d);
$totalRows_up_d = mysql_num_rows($up_d);

mysql_free_result($up_d);
?>
<p align="center">Udate</p>
<form method="post" name="form2" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Code_std:</td>
      <td><input type="text" name="code_std" value="<?php echo htmlentities($row_up_d['code_std'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Name_std:</td>
      <td><input type="text" name="name_std" value="<?php echo htmlentities($row_up_d['name_std'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Dep_std:</td>
      <td><input type="text" name="dep_std" value="<?php echo htmlentities($row_up_d['dep_std'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Tel_std:</td>
      <td><input type="text" name="tel_std" value="<?php echo htmlentities($row_up_d['tel_std'], ENT_COMPAT, ''); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form2">
  <input type="hidden" name="id" value="<?php echo $row_up_d['id']; ?>">
</form>
<p>&nbsp;</p>
<p align="center">&nbsp;</p>
