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
                        <a  href="../home/index.php"><i class="fa fa-dashboard "></i>Home</a>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-desktop "></i>Purchase Reminder<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                             <li>
                                <a href="<?=PROJECT_PATH?>purchase-reminder/index.php"><i class="fa fa-toggle-on"></i>Purchase Reminder Report</a>
                            </li> 
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-desktop "></i>Gate Pass Reminder <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                             <li>
                                <a href="<?=PROJECT_PATH?>gate-pass-reminder/index.php"><i class="fa fa-toggle-on"></i>Gate Pass Reminder Report</a>
                            </li> 
							 
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-desktop "></i>Delivery To Customer Reminder <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                             <li>
                                <a href="<?=PROJECT_PATH?>delivery-to-customer-reminder/index.php"><i class="fa fa-toggle-on"></i>Delivery To Customer Reminder Report</a>
                            </li> 
							 
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-desktop "></i>Production Order Reminder <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                             <li>
                                <a href="<?=PROJECT_PATH?>production-order-reminder/index.php"><i class="fa fa-toggle-on"></i>Production Order Reminder Report</a>
                            </li> 
							 
                        </ul>
                    </li>
					<!--<li>
                        <a href="#"><i class="fa fa-desktop "></i>Purchase List<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                             <li>
                                <a href="<?=PROJECT_PATH?>Quotation-pending/index.php"><i class="fa fa-toggle-on"></i>Quotation Pending</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>purchase-order-pending/index.php"><i class="fa fa-toggle-on"></i>Purchase Order Pending</a>
                            </li> 
							<li>
                                <a href="<?=PROJECT_PATH?>supplier-do-pending/index.php"><i class="fa fa-toggle-on"></i>Supplier DO Pending</a>
                            </li> -->
                        </ul>
                    </li>
					
                </ul>
            </div>

        </nav>
        <!-- /. NAV SIDE  -->
