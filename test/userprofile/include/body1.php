<?php
    $userlevel=$_SESSION['userlevel'];
    
    include '../../config/config.php';
							
	$brnch="SELECT branch FROM user WHERE username='$admin'";
    $resultbrnch = $conn->query($brnch);
    $rowbrnch=mysqli_fetch_assoc($resultbrnch);
    $brnch=$rowbrnch['branch'];
    
	$select = "SELECT * FROM company WHERE id='$brnch'";
	$result1 = $conn->query($select);
	
	while($row = $result1->fetch_assoc()){
		$comid=$row['id'];
		$comname=$row['comname'];
	}
?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="#">APP <span style="color:orange;">CILI : </span> <?php echo $comname; ?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="../dashboard">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Taking Order">
          <a class="nav-link" href="../takingorder">
            <i class="fa fa-fw fa-shopping-cart"></i>
            <span class="nav-link-text">Taking Order</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Payment Due">
          <a class="nav-link" href="../paymentdue">
            <i class="fa fa-fw fa-money"></i>
            <span class="nav-link-text">Payment Due</span>
          </a>
        </li>
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Quotation">
          <a class="nav-link" href="../quotation">
            <i class="fa fa-fw fa-book"></i>
            <span class="nav-link-text">Quotation</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Status">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponent" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Status</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponent">
            <li>
              <a href="../status/">All Order</a>
            </li>
            <li>
              <a href="../status/undone">Job Due</a>
            </li>
			<li>
              <a href="../status/done">Done</a>
            </li>
			<li>
              <a href="../status/delivery">Delivery</a>
            </li>
			<li>
              <a href="../status/summary">Summary</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Cash Check">
          <a class="nav-link" href="../setting/custlist">
            <i class="fa fa-fw fa fa-user"></i>
            <span class="nav-link-text">Customer List</span>
          </a>
        </li>
            <?php
                if ($userlevel!='2') {
            ?>        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Cash Check">
          <a class="nav-link" href="../cashregister">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Cash Check</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Payment Voucher">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseCompo" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-bank"></i>
            <span class="nav-link-text">Payment Voucher</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseCompo">
            <li>
              <a href="../payvoucher/indexrequest">Request P. Voucher</a>
            </li>
            <li>
              <a href="../payvoucher/payvoucherpending">Pending P. Voucher</a>
            </li>
			<li>
              <a href="../payvoucher/payvoucherproved">Approved P. Voucher</a>
            </li>
          </ul>
        </li>
            <?php
                if ($userlevel!='1') {
            ?>	        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Accounting">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseAccount" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file-text-o"></i>
            <span class="nav-link-text">Accounting</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseAccount">
            <li>
              <a href="../transaction/">Transaction</a>
            </li>
            <li>
              <a href="../transaction/account.php">Account</a>
            </li>
          </ul>
        </li>         
            <?php
				}
			?>
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Report">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseReport" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Report</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseReport">
            <li>
              <a href="../report/">Summary</a>
            </li>
            <li>
              <a href="../report/incomestatement.php">Income Statement</a>
            </li>
            <li>
              <a href="../report/balancesheet.php">Balance Sheet</a>
            </li>            
          </ul>
        </li>
			<?php
				}
			?>	
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li id="alert_notificatoin_bar" class="nav-item dropdown">
			<a data-toggle="dropdown" id="notiview" class="nav-link dropdown-toggle mr-lg-2" href="#" aria-haspopup="true" aria-expanded="false">
				
				<i class="fa fa-fw fa-truck"></i>
				<span class="d-lg-none">Delivery</span>
				  <span class="badge badge-pill badge-warning count"></span>
				
			</a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="notiview" id="noti">
			</div>
		</li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Setting</span>
              <span class="badge badge-pill badge-warning"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
            <?php
                if ($userlevel!='2') {
            ?>                
            <a class="dropdown-item" href="../setting">
              <span class="text-success">
                <strong>
                  <i class="fa fa-gear fa-fw"></i>Setting</strong>
              </span>
            </a>
        <div class="dropdown-divider"></div>
            <?php
            }
                if ($userlevel=='0') {
            ?>
                <a class="dropdown-item" href="../userprofile">
              <span class="text-danger">
                <strong><i class="fa fa-user fa-fw"></i>Profile</strong>
              </span>
				</a>
            <?php
            }
                else if ($userlevel=='1') {
            ?>
                <a class="dropdown-item" href="../setting/memberview.php">
              <span class="text-danger">
                <strong><i class="fa fa-user fa-fw"></i>Profile</strong>
              </span>
				</a>
            <?php
            }
                else {
            ?>
                <a class="dropdown-item" href="../setting/memberview.php">
              <span class="text-danger">
                <strong><i class="fa fa-user fa-fw"></i>Profile</strong>
              </span>
				</a>
             <?php
            }
            ?>        
          </div>            
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>