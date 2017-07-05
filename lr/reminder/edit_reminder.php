<?php require_once('../../Connections/conn.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE lr_reminders SET title=%s, emailTo=%s, message=%s, fileLink=%s, status=%s WHERE reminder_id=%s",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['emailTo'], "text"),
                       GetSQLValueString($_POST['message'], "text"),
                       GetSQLValueString($_POST['fileLink'], "text"),
                       GetSQLValueString($_POST['status'], "int"),
                       GetSQLValueString($_POST['reminder_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($updateSQL, $conn) or die(mysql_error());

  $updateGoTo = "list_reminders.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['reminder_id'])) {
  $colname_Recordset1 = $_GET['reminder_id'];
}
mysql_select_db($database_conn, $conn);
$query_Recordset1 = sprintf("SELECT * FROM lr_reminders WHERE reminder_id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/lr.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>html5</title>
<!-- InstanceEndEditable -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link href="../css/navbar-static-top.css" rel="stylesheet">


<!-- jQuery (necessary for Bootstrap's JavaScript plugins put before bootstrap js) -->
<script src="../js/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="../js/bootstrap.min.js"></script>



<!--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->


<!-- InstanceBeginEditable name="head" -->
<meta charset="utf-8">

<!-- InstanceEndEditable -->
</head>

<body>
 <!-- Static navbar -->
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../../navbar/">Default</a></li>
            <li class="active"><a href="./">Static top <span class="sr-only">(current)</span></a></li>
            <li><a href="../../navbar-fixed-top/">Fixed top</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<div class="container">
<!-- InstanceBeginEditable name="EditRegion3" -->
  <div class="row">
  <div class="col-md-12">
    <h3>Edit reminder</h3>
    <form method="POST" name="form1" id="form1" action="<?php echo $editFormAction; ?>">
  <div class="form-group">
    <label for="title">Title</label>
    <input name="title" type="text" class="form-control" id="title" value="<?php echo $row_Recordset1['title']; ?>" placeholder="Enter Title">
  </div>
  <div class="form-group">
    <label for="emailTo">Email To</label>
    <input name="emailTo" type="text" class="form-control" id="emailTo" value="<?php echo $row_Recordset1['emailTo']; ?>" placeholder="Enter Email">
  </div>

   <div class="form-group">
    <label for="message">Your Message</label>
    <textarea class="form-control" name="message" id="message" row="5" placeholder="Leave Message"><?php echo $row_Recordset1['message']; ?></textarea></div>
  
     <div class="form-group">
    <label for="fileLink">File Link</label>
    <input name="fileLink" type="text" class="form-control" id="fileLink" value="<?php echo $row_Recordset1['fileLink']; ?>" placeholder="Enter Link">
  </div>

  <div class="form-group">
    <label for="status">Status</label><br>
    
      <label>
        <input <?php if (!(strcmp($row_Recordset1['status'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="status" value="1" id="status_0">
        Active</label>
      
      <label>
        <input <?php if (!(strcmp($row_Recordset1['status'],"0"))) {echo "checked=\"checked\"";} ?> type="radio"  name="status" value="0" id="status_1">
        Inactive</label>
      <br>
   
  </div>
  
 </div>

   <button type="submit" class="btn btn-default">Update Reminder</button>
  
  
 
  <input type="hidden" name="MM_insert" value="form1">
    <input name="reminder_id" type="hidden" id="reminder_id" value="<?php echo $row_Recordset1['reminder_id']; ?>">
    <input type="hidden" name="MM_update" value="form1">
    </form>
  </div>
  
  
  
  
  
  
   </div>
<!-- InstanceEndEditable -->


</div>

</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($Recordset1);
?>
