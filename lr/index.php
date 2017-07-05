<!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/lr.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>html5</title>
<!-- InstanceEndEditable -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link href="css/navbar-static-top.css" rel="stylesheet">


<!-- jQuery (necessary for Bootstrap's JavaScript plugins put before bootstrap js) -->
<script src="js/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>



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
            <li><a href="../navbar/">Default</a></li>
            <li class="active"><a href="./">Static top <span class="sr-only">(current)</span></a></li>
            <li><a href="../navbar-fixed-top/">Fixed top</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<div class="container">
<!-- InstanceBeginEditable name="EditRegion3" -->
  <div class="row">
  <div class="col-md-12">
  <h3>Register as a new user</h3>
  <form id="form1" name="form1" action="">
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Create Password">
  </div>
  
  <div class="form-group">
    <label for="confirm_password">Confirm Password</label>
    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
  </div>
  
  <div class="first_name">
    <label for="first_name">First Name</label>
    <input type="first_name" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name">
  </div>
  
    <div class="last_name">
    <label for="last_name">Last Name</label>
    <input type="last_name" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name">
  </div>
  <div class="form-group">
    <label for="confirm_password">Gender</label>
  <div class="radio">
  <label>
    <input type="radio" name="gender" id="gender_male" name="male" value="male" checked>
    Male
    
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="gender" id="gender_female" value="female">
    Female
   
  </label>
</div></div>

  <div class="form-group">
    <label for="birth_year">Birth Year</label>
    <input type="number" class="form-control" id="birth_year" name="birth_year" placeholder="Enter Birth Year">
  </div>
  
  <input name="created_dt" type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>">
  <input name="login_dt" type="hidden" value="<?php echo time(); ?>">
<!--  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" id="exampleInputFile">
    <p class="help-block">Example block-level help text here.</p>
  </div>-->
  <div class="checkbox">
    <label>
      <input type="checkbox" id="terms" >I accept terms and conditions
    </label>
  </div>
  <button type="submit" class="btn btn-default">Register</button>
</form></div>
  <div></div>
  
  
  
  
  </div>
<!-- InstanceEndEditable -->


</div>

</body>
<!-- InstanceEnd --></html>
