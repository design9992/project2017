<?php require_once('../../Connections/conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";


// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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
}if (!function_exists("GetSQLValueString")) {
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_lr2 = 5;
$pageNum_lr2 = 0;
if (isset($_GET['pageNum_lr2'])) {
  $pageNum_lr2 = $_GET['pageNum_lr2'];
}
$startRow_lr2 = $pageNum_lr2 * $maxRows_lr2;

$colname_lr2 = "-1";
if (isset($_SESSION['MM_UserId'])) {
  $colname_lr2 = $_SESSION['MM_UserId'];
}
mysql_select_db($database_conn, $conn);
$query_lr2 = sprintf("SELECT * FROM lr_reminders WHERE user_id = %s", GetSQLValueString($colname_lr2, "int"));
$query_limit_lr2 = sprintf("%s LIMIT %d, %d", $query_lr2, $startRow_lr2, $maxRows_lr2);
$lr2 = mysql_query($query_limit_lr2, $conn) or die(mysql_error());
$row_lr2 = mysql_fetch_assoc($lr2);

if (isset($_GET['totalRows_lr2'])) {
  $totalRows_lr2 = $_GET['totalRows_lr2'];
} else {
  $all_lr2 = mysql_query($query_lr2);
  $totalRows_lr2 = mysql_num_rows($all_lr2);
}
$totalPages_lr2 = ceil($totalRows_lr2/$maxRows_lr2)-1;

$queryString_lr2 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_lr2") == false && 
        stristr($param, "totalRows_lr2") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_lr2 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_lr2 = sprintf("&totalRows_lr2=%d%s", $totalRows_lr2, $queryString_lr2);
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
    <?php if ($totalRows_lr2 > 0) { // Show if recordset not empty ?>
      <div class="col-md-12">
        <div class="col-md-12">
          <h3>List my reminders</h3>
          <div class="table-responsive">
            <table class="table table-striped">
              <tr>
                <td><strong>title</strong></td>
                <td><strong>emailTo</strong></td>
                <td><strong>message</strong></td>
                <td><strong>fileLink</strong></td>
                <td><strong>status</strong></td>
                <td><strong>reminder_created_dt</strong></td>
                <td>Edit</td>
                <td>Delete</td>
              </tr>
              <?php do { ?>
              <tr>
                <td><?php echo $row_lr2['title']; ?></td>
                <td><?php echo $row_lr2['emailTo']; ?></td>
                <td><?php echo nl2br($row_lr2['message']); ?></td>
                <td><?php echo $row_lr2['fileLink']; ?></td>
                <td><?php echo $row_lr2['status']; ?></td>
                <td><?php echo $row_lr2['reminder_created_dt']; ?></td>
                <td><a href="edit_reminder.php?reminder_id=<?php echo $row_lr2['reminder_id']; ?>">Edit</a></td>
                <td><a href="delete_reminder.php?reminder_id=<?php echo $row_lr2['reminder_id']; ?>">Delete</a></td>
              </tr>
              <?php } while ($row_lr2 = mysql_fetch_assoc($lr2)); ?>
            </table>
          </div>
          <p>&nbsp;
          <table border="0">
            <tr>
              <td><?php if ($pageNum_lr2 > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_lr2=%d%s", $currentPage, 0, $queryString_lr2); ?>">First</a>
                <?php } // Show if not first page ?></td>
              <td><?php if ($pageNum_lr2 > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_lr2=%d%s", $currentPage, max(0, $pageNum_lr2 - 1), $queryString_lr2); ?>">Previous</a>
                <?php } // Show if not first page ?></td>
              <td><?php if ($pageNum_lr2 < $totalPages_lr2) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_lr2=%d%s", $currentPage, min($totalPages_lr2, $pageNum_lr2 + 1), $queryString_lr2); ?>">Next</a>
                <?php } // Show if not last page ?></td>
              <td><?php if ($pageNum_lr2 < $totalPages_lr2) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_lr2=%d%s", $currentPage, $totalPages_lr2, $queryString_lr2); ?>">Last</a>
                <?php } // Show if not last page ?></td>
            </tr>
          </table>
          <p></p>
          <p>&nbsp;</p>
          <?php if ($totalRows_lr2 == 0) { // Show if recordset empty ?>
          <p>No reminders to show</p>
          <?php } // Show if recordset empty ?>
        </div>
      </div>
      <?php } // Show if recordset not empty ?>
  </div>
<!-- InstanceEndEditable -->


</div>

</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($lr2);
?>
