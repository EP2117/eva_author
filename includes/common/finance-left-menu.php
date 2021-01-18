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

                <a href="message-task.html" class="btn btn-primary" title="New Task"><b>40 </b><i class="fa fa-bars fa-2x"></i></a> -->

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



                               <div class="inner-text">

                                Aluzinc Colour Roofing Sheet

                            <br />

                                <small>C&Z-Channel, Decking Sheets, Enduframe & Accessories,</small>

                            </div>

                        </div>



                    </li>

                    <li>

                        <a  href="index.html"><i class="fa fa-dashboard "></i>Dashboard</a>

                    </li>-->

                    <li>

                        <a  href="<?=PROJECT_PATH?>home/"><i class="fa fa-dashboard "></i>Home</a>

                    </li>

					
					<li>
                        <a href="#"><i class="fa fa-paypal"></i>Account Head<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>account-head/index.php?page=add"><i class="fa fa-toggle-on"></i>Acc Head Add</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>account-head/index.php"><i class="fa fa-toggle-on"></i>List Acc Head</a>
                            </li>
                        </ul>
                    </li>
					
					<li>
                        <a href="#"><i class="fa fa-paypal"></i>Sub Account<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>account-sub/index.php?page=add"><i class="fa fa-toggle-on"></i>Acc Sub Add</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>account-sub/index.php"><i class="fa fa-toggle-on"></i>List Acc Sub</a>
                            </li>
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-paypal"></i>A/C setup<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>account-setup/index.php?page=add"><i class="fa fa-toggle-on"></i>A/C setup</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>account-setup/index.php"><i class="fa fa-toggle-on"></i>List</a>
                            </li>
                        </ul>
                    </li>
					 <li>
                        <a href="<?=PROJECT_PATH?>account-opening-balance/index.php"><i class="fa fa-paypal"></i>Opening balance<span class="fa arrow"></span></a>
                   	 </li>
					 
					<!--<li>
                        <a href="#"><i class="fa fa-paypal"></i>Expense payable<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>expense-payable/index.php?page=add"><i class="fa fa-toggle-on"></i>Expense payable</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>expense-payable/index.php"><i class="fa fa-toggle-on"></i>List</a>
                            </li>
                        </ul>
                    </li>-->
					
					<li>
                        <a href="#"><i class="fa fa-paypal"></i>Account payable<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>account-payable/index.php?page=add"><i class="fa fa-toggle-on"></i>Account payable</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>account-payable/index.php"><i class="fa fa-toggle-on"></i>List</a>
                            </li>
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-paypal"></i>Account receivable<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>account-receiveable/index.php?page=add"><i class="fa fa-toggle-on"></i>Receivable</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>account-receiveable/index.php"><i class="fa fa-toggle-on"></i>List</a>
                            </li>
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-paypal"></i>Journal<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>journal/index.php?page=add"><i class="fa fa-toggle-on"></i>Journal</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>journal/index.php"><i class="fa fa-toggle-on"></i>List</a>
                            </li>
                        </ul>
                    </li>
					<!--<li>
                       <a href="<?=PROJECT_PATH?>account-profitloss/index.php"><i class="fa fa-paypal"></i>Profit & Loss<span class="fa arrow"></span></a>
                    </li>
					 <li>
                       <a href="<?=PROJECT_PATH?>account-balance-sheet/index.php"><i class="fa fa-paypal"></i>Balance sheet<span class="fa arrow"></span></a>
                    </li>
					 <li>
                       <a href="<?=PROJECT_PATH?>account-trail-balance/index.php"><i class="fa fa-paypal"></i>Trail balance<span class="fa arrow"></span></a>
                    </li>-->
					 <li>
                       <a href="<?=PROJECT_PATH?>account-ledger/index.php"><i class="fa fa-paypal"></i>Ledger<span class="fa arrow"></span></a>
                    </li>
					 <li>
                       <a href="<?=PROJECT_PATH?>account-cash-book/index.php"><i class="fa fa-paypal"></i>Cash & Bank book<span class="fa arrow"></span></a>
                    </li>
					<!--<li>
                       <a href="<?=PROJECT_PATH?>account-manufacture/index.php"><i class="fa fa-paypal"></i>Manufacture	Report<span class="fa arrow"></span></a>
                    </li>-->
					<!-- <li>
                       <a href="<?=PROJECT_PATH?>account-bank-book/index.php"><i class="fa fa-paypal"></i>Bank book<span class="fa arrow"></span></a>
                    </li>-->

                    <li>

                        <a  href="blank.html"><i class="fa fa-square-o "></i>Blank Page</a>

                    </li>

                </ul>

            </div>



        </nav>

        <!-- /. NAV SIDE  -->