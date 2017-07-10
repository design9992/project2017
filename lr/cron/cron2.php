<?php require_once('../../Connections/conn.php'); ?>
<?php
$threeDays = time() - (60*60); // should be three 60*60*24*3
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

mysql_select_db($database_conn, $conn);
$query_Recordset1 = "SELECT * FROM lr_users WHERE lr_users.emailFlag1 =1 AND lr_users.emailFlag1Date < $threeDays LIMIT 5";
$Recordset1 = mysql_query($query_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_free_result($Recordset1);
?>

<table border="1">
  <tr>
    <td>user_id</td>
    <td>email</td>
    <td>password</td>
    <td>first_name</td>
    <td>last_name</td>
    <td>gender</td>
    <td>birth_year</td>
    <td>created_dt</td>
    <td>login_dt</td>
    <td>emailFlag1</td>
    <td>emailFlag1Date</td>
    <td>cronFlag</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['user_id']; ?></td>
      <td><?php echo $row_Recordset1['email']; ?></td>
      <td><?php echo $row_Recordset1['password']; ?></td>
      <td><?php echo $row_Recordset1['first_name']; ?></td>
      <td><?php echo $row_Recordset1['last_name']; ?></td>
      <td><?php echo $row_Recordset1['gender']; ?></td>
      <td><?php echo $row_Recordset1['birth_year']; ?></td>
      <td><?php echo $row_Recordset1['created_dt']; ?></td>
      <td><?php echo $row_Recordset1['login_dt']; ?></td>
      <td><?php echo $row_Recordset1['emailFlag1']; ?></td>
      <td><?php echo $row_Recordset1['emailFlag1Date']; ?></td>
      <td><?php echo $row_Recordset1['cronFlag']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
