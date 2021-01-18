<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Home</title>

<?php 

	include "../includes/common/header.php";

	if(isset($_GET['msg'])) {

		if($_GET['msg']==1) {

			$msg = 'Branch added successfully';

		} else if($_GET['msg']==5) {

			$msg = 'Branch updated successfully';

		} else if($_GET['msg']==3) {

			$msg = 'Branch deleted successfully';

		} else if($_GET['msg']==4) {

			$msg = 'Branch Code already added';

		}else if($_GET['msg']==2) {

			$msg = 'Please fill all required fields';

		} 

	}



?>

<script type="text/javascript" src="<?php echo PROJECT_PATH.'/home/branch-javascript.js'; ?>"></script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/home-left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">Home</h1>

                        <!--<h1 class="page-subhead-line"> -->

						

						</h1>

                    </div>

                </div>

				<div class="row" style="margin-top:30px;">
					<div class="col-md-3 col-sm-6 icon text-center">
						<a class="home-btn home-btn-app" href="../masters/index.php" title="MASTERS">
						  <i class="fa fa-database"></i>
						  <div class="font-black">Master</div>
						</a>
					</div>
					
					<div class="col-md-3 col-sm-6 icon text-center">
						<a class="home-btn home-btn-app" href="../sales/index.php"  title="SALES">
						  <i class="fa fa-line-chart"></i>
						  <div>Sale</div>
						</a>
					</div>
					<?php if($_SESSION[SESS.'_session_user_branch_type']==1){ ?>
					<div class="col-md-3 col-sm-6 icon text-center">
						<a class="home-btn home-btn-app" href="../distillery/index.php"  title="MANUFACTURING">
						  <i class="fa fa-industry"></i>
						  <div>Manufacturing</div>
						</a>
					</div>
					<?php } ?>
					
					<div class="col-md-3 col-sm-6 icon text-center">
						<a class="home-btn home-btn-app" href="../eva-purchase/index.php"   title="PURCHASE">
						  <i class="fa fa-credit-card"></i>
						  <div>Purchase</div>
						</a>
					</div>
					
					<div class="col-md-3 col-sm-6 icon text-center">
						<a class="home-btn home-btn-app" href="../hr/index.php"   title="HR">
						  <i class="fa fa-users"></i>
						  <div>HR</div>
						</a>
					</div>
					
					<div class="col-md-3 col-sm-6 icon text-center">
						<a class="home-btn home-btn-app" href="../inventory/index.php"  title="INVENTORY">
						  <i class="fa fa-cubes"></i>
						  <div>Inventory</div>
						</a>
					</div>
					
					<div class="col-md-3 col-sm-6 icon text-center">
						<a class="home-btn home-btn-app" href="../finance/index.php"  title="FINANCE">
						  <i class="fa fa-usd"></i>
						  <div>Finance</div>
						</a>
					</div>
					
					<div class="col-md-3 col-sm-6 icon text-center">
						<a class="home-btn home-btn-app" href="../report/index.php"  title="REPORT">
						  <i class="fa fa-bar-chart"></i>
						  <div>Report</div>
						</a>
					</div>
					
					<div class="col-md-3 col-sm-6 icon text-center">
						<a class="home-btn home-btn-app" href="../Reminder/index.php" title="REMINDER">
						  <i class="fa fa-bell-o"></i>
						  <div>Reminder</div>
						</a>
					</div>

                    <!--<div class="col-md-4">

						<div>

							<a href="../masters/index.php" title="MASTERS">

                        	<img src="../images/master.jpg" style=" width:200px; height:150px;"/>

							</a>

						</div>

                    </div>

					<div class="col-md-4">

                        <a href="../sales/index.php"  title="SALES">

                        <img src="../images/Sales1.png" style=" width:200px; height:150px;"/>

                        </a>

                    </div>
					<?php if($_SESSION[SESS.'_session_user_branch_type']==1){ ?>
					<div class="col-md-4">

                        <a href="../distillery/index.php"  title="MANUFACTURING">

                        <img src="../images/Distillery.png" style=" width:200px; height:150px;"/>

                        </a>

                    </div>
					<?php } ?> -->

                   </div>

				<!--div class="row" style="padding-top:100px;">
					<div class="col-md-4">
						<a href="../eva-purchase/index.php"   title="PURCHASE">
						<img src="../images/Finance.png" style=" width:200px; height:150px;"/>
						</a>
					  </div>
					   <div class="col-md-4">
						<a href="../hr/index.php"   title="HR">
						<img src="../images/HR2.png" style=" width:200px; height:150px;"/>
						</a>
                    </div>
					  <div class="col-md-4">
                        <a href="../inventory/index.php"  title="INVENTORY">
                        <img src="../images/Inventory2.png" style=" width:200px; height:150px;"/>
                        </a>
                    </div>
				</div>
				<div class="row" style="padding-top:100px;">
					 <div class="col-md-4">
                        <a href="../finance/index.php"  title="FINANCE">
                        <img src="../images/finance_pic2.png" style=" width:200px; height:150px;"/>
                        </a>
                    </div>
					<div class="col-md-4">
                        <a href="../report/index.php"  title="REPORT">
                        <img src="../images/report.jpg" style=" width:200px; height:150px;"/>
                        </a>
                    </div>
					<div class="col-md-4">
					<a href="../Reminder/index.php" title="REMINDER">
					<img src="../images/Reminder.png" style="width:200px; height:100;"/>
					</a>
					</div>
			  </div>-->
			  
			 
					 
			 

               

			</div>

            <!-- /. PAGE INNER  -->

        </div>

        <!-- /. PAGE WRAPPER  -->

    </div>

    <!-- /. WRAPPER  -->

    <div id="footer-sec" >

        <?=PROJECT_FOOTER?>

    </div>
	
</body>

</html>

