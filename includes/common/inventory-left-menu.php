        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">

            <div class="navbar-header">

                <button type="button" class="navbar-toggle" data-toggle="collapse" aria-expanded="false" data-target=".sidebar-collapse">

                    <span class="sr-only">Toggle navigation</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                </button>

                <a class="navbar-brand" style="padding-top:13px;" href="../home/index.php">
					<!--EVA STEEL-->
					<img src="../images/EVA_Logo.jpg" style=" width:70px; height:50px;"/>
				</a>

            </div>



            <div class="header-right">



              <!--<a href="message-task.html" class="btn btn-info" title="New Message"><b>30 </b><i class="fa fa-envelope-o fa-2x"></i></a>

                <a href="message-task.html" class="btn btn-primary" title="New Task"><b>40 </b><i class="fa fa-bars fa-2x"></i></a>-->

                <a href="<?=PROJECT_PATH?>logout.php" class="btn btn-danger" title="Logout"><i class="fa fa-exclamation-circle fa-2x"></i></a>





            </div>

        </nav>

        <!-- /. NAV TOP  -->

        <nav class="navbar-default navbar-side" role="navigation">

            <div class="sidebar-collapse collapse in">

                <ul class="nav" id="main-menu" style="margin-top:30px;">
				<!--<li>

                        <div class="user-img-div">

                           <img src="../images/EVA_Logo.jpg" style=" width:50px; height:30px;"/>



                             <div class="inner-text">

                                Aluzinc Colour Roofing Sheet

                            <br />

                                <small>C&Z-Channel, Decking Sheets, Enduframe & Accessories,</small>

                            </div>


                        </div>



                    </li>-->

					  <li>
                        <a  href="<?=PROJECT_PATH?>home/"><i class="fa fa-dashboard "></i>Home</a>
                    </li>
					
					 <!--<li>
                        <a href="<?=PROJECT_PATH?>stock-available/index.php"><i class="fa fa-paypal"></i>Stock ledger<span class="fa arrow"></span></a>
                   	 </li>
					 <li>
                        <a href="#"><i class="fa fa-paypal"></i>Delivery To Customer<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>delivery-customer/index.php?page=add"><i class="fa fa-toggle-on"></i>Delivery To Customer</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>delivery-customer/index.php"><i class="fa fa-toggle-on"></i>List</a>
                            </li>
                        </ul>
                    </li>-->
                 	<li>
                        <a href="#"><i class="fa fa-paypal"></i>Gatepass Entry<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>gatepass-entry/index.php?page=add"><i class="fa fa-toggle-on"></i>Gatepass</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>gatepass-entry/index.php"><i class="fa fa-toggle-on"></i>List</a>
                            </li>
                        </ul>
                    </li>
					<!--<li>
                        <a href="#"><i class="fa fa-paypal"></i>Reserve<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>reserve-entry/index.php?page=add"><i class="fa fa-toggle-on"></i>Reserve</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>reserve-entry/index.php"><i class="fa fa-toggle-on"></i>List</a>
                            </li>
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-paypal"></i>Stock transfer<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>stock-transfer/index.php?page=add"><i class="fa fa-toggle-on"></i>Stock transfer</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>stock-transfer/index.php"><i class="fa fa-toggle-on"></i>List</a>
                            </li>
                        </ul>
                    </li>
					
					<li>
                        <a href="#"><i class="fa fa-paypal"></i>Damag & missing / scrp<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>damage-entry/index.php?page=add"><i class="fa fa-toggle-on"></i>Damag & missing / scrp</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>damage-entry/index.php"><i class="fa fa-toggle-on"></i>List</a>
                            </li>
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-paypal"></i>Write-off<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>write-off/index.php?page=add"><i class="fa fa-toggle-on"></i>write-off</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>write-off/index.php"><i class="fa fa-toggle-on"></i>List</a>
                            </li>
                        </ul>
                    </li>
					<?php if($_SESSION[SESS.'_session_user_branch_type']==1){ ?>
					<li>
                        <a href="#"><i class="fa fa-paypal"></i>Re-Cycle entry<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>recycle-entry/index.php?page=add"><i class="fa fa-toggle-on"></i>Re-Cycle entry</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>recycle-entry/index.php"><i class="fa fa-toggle-on"></i>List</a>
                            </li>
                        </ul>
                    </li>
					<?php } ?>
					 <li>
                        <a href="<?=PROJECT_PATH?>reserve-entry-report/index.php"><i class="fa fa-paypal"></i>Reserve Entry Report<span class="fa arrow"></span></a>
                   	 </li>
					  <li>
                        <a href="<?=PROJECT_PATH?>stock-transfer-report/index.php"><i class="fa fa-paypal"></i>Stock transfer report<span class="fa arrow"></span></a>
                   	 </li>
					  <li>
                        <a href="<?=PROJECT_PATH?>write-off-report/index.php"><i class="fa fa-paypal"></i>write off report<span class="fa arrow"></span></a>
                   	 </li>
                    <li>
                        <a  href="blank.html"><i class="fa fa-square-o "></i>Blank Page</a>
                    </li>-->

                </ul>

            </div>



        </nav>

        <!-- /. NAV SIDE  -->

