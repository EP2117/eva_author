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

					<li>
                        <a href="#"><i class="fa fa-paypal"></i>Purchase order<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>eva-purchase-order/index.php?page=add"><i class="fa fa-toggle-on"></i>PO Entry</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>eva-purchase-order/index.php"><i class="fa fa-toggle-on"></i>List</a>
                            </li>
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-paypal"></i>Invoice entry<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>eva-invoice-entry/index.php?page=add"><i class="fa fa-toggle-on"></i>Invoice entry</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>eva-invoice-entry/index.php"><i class="fa fa-toggle-on"></i>List</a>
                            </li>
                        </ul>
                    </li>
					<!--<li>
                        <a href="#"><i class="fa fa-paypal"></i>Goods receipt note<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>eva-grn/index.php?page=add"><i class="fa fa-toggle-on"></i>GRN Entry</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>eva-grn/index.php"><i class="fa fa-toggle-on"></i>List</a>
                            </li>
                        </ul>
                    </li>
					
					<li>
                        <a href="#"><i class="fa fa-paypal"></i>Costing entry<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>eva-costing-entry/index.php?page=add"><i class="fa fa-toggle-on"></i>Costing entry</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>eva-costing-entry/index.php"><i class="fa fa-toggle-on"></i>List</a>
                            </li>
                        </ul>
                    </li>-->
					<li>
                        <a href="#"><i class="fa fa-paypal"></i>Payment entry<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>eva-payment-entry/index.php?page=add"><i class="fa fa-toggle-on"></i>Payment entry</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>eva-payment-entry/index.php"><i class="fa fa-toggle-on"></i>List</a>
                            </li>
                        </ul>
                    </li>
					<?php /*?><li>
                        <a href="#"><i class="fa fa-paypal"></i>Recycle Entry<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>recycle-entry/index.php?page=add"><i class="fa fa-toggle-on"></i>Recycle Entry</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>recycle-entry/index.php"><i class="fa fa-toggle-on"></i>List</a>
                            </li>
                        </ul>
                    </li><?php */?>
					<!--<li>
                        <a href="#"><i class="fa fa-paypal"></i>Coin report<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>eva-coin-report/index.php?page=add"><i class="fa fa-toggle-on"></i>Report</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>eva-coin-report/index.php"><i class="fa fa-toggle-on"></i>List</a>
                            </li>
                        </ul>
                    </li>-->
					<li>
                        <a href="#"><i class="fa fa-paypal"></i>Debit note<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>debit-note-entry/index.php?page=add"><i class="fa fa-toggle-on"></i>Debit</a>
                            </li> 
							 <li>
                                <a href="<?=PROJECT_PATH?>debit-note-entry/index.php"><i class="fa fa-toggle-on"></i>List</a>
                            </li>
                        </ul>
                    </li>
					

                    <!--<li>

                        <a  href="blank.html"><i class="fa fa-square-o "></i>Blank Page</a>

                    </li>-->

                </ul>

            </div>



        </nav>

        <!-- /. NAV SIDE  -->

