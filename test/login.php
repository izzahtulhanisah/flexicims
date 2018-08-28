<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FLEXICIMS</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>

  .navbar {
      font-family: Luxida Fax, sans-serif;
      margin-bottom: 0;
      background-color: #ADD8E6;
      border: 0;
      font-size: 11px !important;

      letter-spacing: 4px;
      opacity: 0.9;
  }
  /* .navbar li a, .navbar .navbar-brand {
      color: #d5d5d5 !important;
  }
  .navbar-nav li a:hover {
      color: #fff !important;
  }
  .navbar-nav li.active a {
      color: #fff !important;
      background-color: #29292c !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
  } */


  </style>


	 <script>

       function $_GET(param) {
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace(
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;
	}
	return vars;
}

    var $_GET = $_GET(),


    locs = $_GET['location'];

    if(locs==undefined){
        loc = 'home';
    }else{
        loc = $_GET['location'];
    }


    //var loc= getAllUrlParams().location;

    var param = {location: loc};

	</script>
</head>

<body style="background-color:dimgray;">
<?php

include 'config.php';

if(isset($_POST['send'])){

echo '<p></p>';

}

else{

}

?>

              <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#myPage" style="color:black; font-size:30px; font-family:Arial;">FLEXI<b><i>CIMS</i></b>
                    </a>



                  </div>
                  <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                      <!-- <li><a href="#myPage">HOME</a></li>
                      <li><a href="#band">BAND</a></li>
                      <li><a href="#tour">TOUR</a></li> -->
                      <li style="color:black; font-size:15px;"><a href="#" style="color:black;">Computerized Inventory Management System</a></li>

                      <!-- <li><a href="#"><span class="glyphicon glyphicon-search"></span></a></li> -->
                    </ul>
                  </div>
                </div>
              </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="color:black;"><center>Sign in to explore Live Demo

</center></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="sql_login.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>

                                <hr>
                                <i><b><center><p style="color:green; font-size:20px;">Demo Mode:</p></center></b></i>
              									<p style="text-align:center;">Admin Username: <b>AdminDemo</b></p>
                                <!-- <p style="text-align:right;">Manager Username: <b>ManagerDemo</b></p>
                                <p style="text-align:right;">Staff Username: <b>StaffDemo</b></p> -->
              									<p style="text-align:center;">Password: <b>password</b></p>
                                <hr>
                                <!-- <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div> -->
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Login">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
