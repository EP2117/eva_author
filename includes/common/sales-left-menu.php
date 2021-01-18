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



                        <a href="#"><i class="fa fa-desktop "></i>Quotation Entry <span class="fa arrow"></span></a>



                         <ul class="nav nav-second-level">



                            <li>



                                <a href="<?=PROJECT_PATH?>quotation-entry/index.php?page=add"><i class="fa fa-toggle-on"></i>Add Quotation Entry</a>



                            </li>



                            <li>



                                <a href="<?=PROJECT_PATH?>quotation-entry/index.php"><i class="fa fa-bell "></i>Quotation Entry List</a>



                            </li>



                        </ul>



                    </li>



					<li>



                        <a href="#"><i class="fa fa-desktop "></i>Advance Entry <span class="fa arrow"></span></a>



                         <ul class="nav nav-second-level">



                            <li>



                                <a href="<?=PROJECT_PATH?>advance-entry/index.php?page=add"><i class="fa fa-toggle-on"></i>Add Advance Entry</a>

                            </li>



                            <li>



                                <a href="<?=PROJECT_PATH?>advance-entry/index.php"><i class="fa fa-bell "></i>Advance Entry List</a>



                            </li>



                        </ul>



                    </li>					



					<li>
                        <a href="#"><i class="fa fa-desktop "></i>Invoice Entry<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>invoice-entry/index.php?page=add"><i class="fa fa-toggle-on"></i>Add Invoice Entry</a>
                            </li>
                            <li>
                                <a href="<?=PROJECT_PATH?>invoice-entry/index.php"><i class="fa fa-bell "></i>Invoice Entry List</a>
                            </li>
                        </ul>
                    </li>
					<li>
                        <a href="#"><i class="fa fa-desktop "></i>Direct Invoice Entry<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="<?=PROJECT_PATH?>direct-invoice-entry/index.php?page=add"><i class="fa fa-toggle-on"></i>Add Direct Invoice Entry</a>
                            </li>
                            <li>
                                <a href="<?=PROJECT_PATH?>direct-invoice-entry/index.php"><i class="fa fa-bell "></i> Direct Invoice Entry List</a>
                            </li>
                        </ul>
                    </li>
					<li>



                        <a href="#"><i class="fa fa-desktop "></i>Delivery Entry For Sale<span class="fa arrow"></span></a>



                         <ul class="nav nav-second-level">



                            <li>



                                <a href="<?=PROJECT_PATH?>delivery-entry/index.php?page=add"><i class="fa fa-toggle-on"></i>Add Delivery Entry</a>



                            </li>



                            <li>



                                <a href="<?=PROJECT_PATH?>delivery-entry/index.php"><i class="fa fa-bell "></i>Delivery Entry List</a>



                            </li>



                        </ul>



                    </li>



					<li>



                        <a href="#"><i class="fa fa-desktop "></i>Production Order<span class="fa arrow"></span></a>



                         <ul class="nav nav-second-level">



                            <!--<li>



                                <a href="<?=PROJECT_PATH?>production-order-sale/index.php?page=add"><i class="fa fa-toggle-on"></i>Add Production Order</a>



                            </li>-->



                            <li>



                                <a href="<?=PROJECT_PATH?>production-order-sale/index.php"><i class="fa fa-bell "></i>Production Order List</a>



                            </li>



                        </ul>



                    </li>



					<?php /*?><li>



                        <a href="#"><i class="fa fa-desktop "></i>Delivery Entry For Warehouse<span class="fa arrow"></span></a>



                         <ul class="nav nav-second-level">



                            <li>



                                <a href="<?=PROJECT_PATH?>delivery-entry-sale/index.php?page=add"><i class="fa fa-toggle-on"></i>Add Delivery Entry</a>



                            </li>



                            <li>



                                <a href="<?=PROJECT_PATH?>delivery-entry-sale/index.php"><i class="fa fa-bell "></i>Delivery Entry List</a>



                            </li>



                        </ul>



                    </li><?php */?>


					<li>



                        <a href="#"><i class="fa fa-desktop "></i>Credit Note Entry<span class="fa arrow"></span></a>



                         <ul class="nav nav-second-level">



                            <li>
                                <a href="<?=PROJECT_PATH?>credit-note-entry/index.php?page=add"><i class="fa fa-toggle-on"></i>Add Credit Note Entry</a>
                            </li>
                            <li>
                                <a href="<?=PROJECT_PATH?>credit-note-entry/index.php"><i class="fa fa-bell "></i>Credit Note Entry List</a>
                            </li>
                        </ul>



                    </li>
					<?php if($_SESSION[SESS.'_session_user_branch_type']==2){ ?>
					<li>



                        <a href="#"><i class="fa fa-desktop "></i>Direct Production Order<span class="fa arrow"></span></a>



                         <ul class="nav nav-second-level">



                            <li>



                                <a href="<?=PROJECT_PATH?>production-order/index.php?page=add"><i class="fa fa-toggle-on"></i>Add Production Order</a>



                            </li>



                            <li>



                                <a href="<?=PROJECT_PATH?>production-order/index.php"><i class="fa fa-bell "></i>Production Order List</a>



                            </li>



                        </ul>



                    </li>
					<?php } ?>
					<li>



                        <a href="#"><i class="fa fa-desktop "></i>Collection Entry<span class="fa arrow"></span></a>



                         <ul class="nav nav-second-level">



                            <li>



                                <a href="<?=PROJECT_PATH?>collection-entry/index.php?page=add"><i class="fa fa-toggle-on"></i>Add Collection</a>



                            </li>



                            <li>



                                <a href="<?=PROJECT_PATH?>collection-entry/index.php"><i class="fa fa-bell "></i>Collection List</a>



                            </li>



                        </ul>



                    </li>



					

					

					



                    <li>



                        <a  href="blank.html"><i class="fa fa-square-o "></i>Blank Page</a>



                    </li>



                </ul>



            </div>







        </nav>



        <!-- /. NAV SIDE  -->



