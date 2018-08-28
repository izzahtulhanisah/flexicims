<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header" style="background-color:lightblue">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" style="color:black; font-size:30px;">FLEXI<b><i>CIMS</i></b></a>

            </div>
            <!-- /.navbar-header -->

			<ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:black; ">
                       Hi! <?php echo $username; ?><i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
					<?php

					if($secpass>= 1){

					?>
						<li><a href="profile.php""><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
					<?php

					}else{

					?>
                        <li><a href="userprofile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
					<?php

					}

					?>
						<!-- <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li> -->
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-home"></i> Home</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cubes"></i> Inventory Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="home.php">Inventory</a>
                                </li>
								                <li>
                                    <a href="location.php">Location</a>
                                </li>
                                <li>
                                    <a href="type.php">Product Type</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						 <?php

						if($secpass>= 3){}else{
						?>
                        <li>
                            <a href="#"><i class="fa fa-history"></i> Activity Tracking<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <li>
                                    <a href="incoming.php">Incoming</a>
                                </li>
								<li>
                                    <a href="outgoing.php">Outgoing</a>
                                </li>
                                <li>
                                    <a href="record.php">Record</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						 <?php

						if($secpass>= 2){}else{
						?>
                        <li>
                            <a href="report.php"><i class="fa fa-folder-open"></i> Report</a>
                        </li>
                        <li>
                            <a href="userprofile.php"><i class="fa fa-users"></i> Users</a>
                        </li>
						<?php
						}
						}
						?>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>