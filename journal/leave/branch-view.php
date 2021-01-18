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

                        <h1 class="page-subhead-line">

						

						</h1>

                    </div>

                </div>

				<div class="row" >

                    <div class="col-md-4">

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

					<div class="col-md-4">

                        <a href="../distillery/index.php"  title="DISTILLERY">

                        <img src="../images/Distillery.png" style=" width:200px; height:150px;"/>

                        </a>

                    </div>

                   </div>

				<div class="row" style="padding-top:100px;">
					<div class="col-md-4">
                        <a href="../eva-purchase/index.php"   title="Purchase">
                        <img src="../images/Finance.png" style=" width:200px; height:150px;"/>
                        </a>
                      </div>
			  </div>

               

                    

            <!-- /. PAGE INNER  -->

        </div>

        <!-- /. PAGE WRAPPER  -->

    </div>

    <!-- /. WRAPPER  -->

    <div id="footer-sec" >

        &copy; 2017 Authors | Design By : <a href="http://www.binarytheme.com/" target="_blank">www.Authorsmyanmar.com</a>

    </div>

    <!-- /. FOOTER  -->

    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->

    <!-- JQUERY SCRIPTS -->

    <script src="../assets/js/jquery-1.10.2.js"></script>

    <!-- BOOTSTRAP SCRIPTS -->

    <script src="../assets/js/bootstrap.js"></script>

    <!-- METISMENU SCRIPTS -->

    <script src="../assets/js/jquery.metisMenu.js"></script>

    <!-- CUSTOM SCRIPTS -->

    <script src="../assets/js/custom.js"></script>

</body>

</html>

