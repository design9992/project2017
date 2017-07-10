<?php require_once('../../Connections/conn.php'); ?>
<?php
$threeDays = time()-(60*60); // three days from today. 24*3

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

$maxRows_Recordset1 = 5;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_conn, $conn);
$query_Recordset1 = "SELECT * FROM lr_users WHERE lr_users.emailFlag1 =1 AND lr_users.emailFlag1Date <$threeDays AND lr_users.cronFlag =0";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?>
  <table border="1">
    <tr>
      <td>user_id</td>
      <td>email</td>
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
	<?php
	$colname_reminders = "-1";
if (isset($row_Recordset1['user_id'])) {
  $colname_reminders =$row_Recordset1['user_id'];
}
mysql_select_db($database_conn, $conn);
$query_reminders = sprintf("SELECT * FROM lr_reminders WHERE user_id = %s", GetSQLValueString($colname_reminders, "int"));
$reminders = mysql_query($query_reminders, $conn) or die(mysql_error());
$row_reminders = mysql_fetch_assoc($reminders);
$totalRows_reminders = mysql_num_rows($reminders);?>
<?php if ($totalRows_reminders > 0) { // Show if recordset not empty ?>
  <table border="1">
    <tr>
      <td>reminder_id</td>
      <td>user_id</td>
      <td>title</td>
      <td>emailTo</td>
      <td>message</td>
      <td>fileLink</td>
      <td>status</td>
      <td>reminder_created_dt</td>
    </tr>
    <?php do { ?>
     <?php 
  $message =" {$row_reminders['title']}
  {$row_Recordset1['first_name']} is not alive today. He/She has send a special message to you. The message is:
  {$row_reminders['message']}
  File Link: {$row_reminders['fileLink']}
  
  Thank You,
  Life Reminder Admin
  
  ";
  
  echo nl2br($message);
  // @mail($row_reminders['emailTo'], $row_reminders['title'], $message, 'From: Admin<admin@lifereminder.com>');
  ?>
      <tr>
        <td><?php echo $row_reminders['reminder_id']; ?></td>
        <td><?php echo $row_reminders['user_id']; ?></td>
        <td><?php echo $row_reminders['title']; ?></td>
        <td><?php echo $row_reminders['emailTo']; ?></td>
        <td><?php echo $row_reminders['message']; ?></td>
        <td><?php echo $row_reminders['fileLink']; ?></td>
        <td><?php echo $row_reminders['status']; ?></td>
        <td><?php echo $row_reminders['reminder_created_dt']; ?></td>
      </tr>
      <?php } while ($row_reminders = mysql_fetch_assoc($reminders)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
  
  <?php 
  // update, cronFlag = 1;
  
  $updateSQL = sprintf("UPDATE lr_users SET cronFlag = 1 WHERE user_id = %s",
					   GetSQLValueString($row_Recordset1['user_id'],"int"));
  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn)or die(mysql_error());
  
  ?>
  
  
      <tr>
        <td><?php echo $row_Recordset1['user_id']; ?></td>
        <td><?php echo $row_Recordset1['email']; ?></td>
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
  <?php } // Show if recordset not empty ?>
<p>&nbsp;</p>
<p>&nbsp;</p>

</body>
</html>
<?php
mysql_free_result($Recordset1);

// mysql_free_result($reminders); deleted
?>
