<?php 
require_once('../project-config/utility-function.php'); 
if(getFileName() == 'index') { 
$msg_style = messageAlert();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- display favicon open the page-->
<title><?php echo PROJECT_NAME; ?> - Payroll</title>
<link href="<?php echo PROJECT_PATH; ?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo PROJECT_PATH; ?>/css/month-year-picker.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo PROJECT_PATH; ?>/js/validator.js"> </script>
<script type="text/javascript" src="<?php echo PROJECT_PATH; ?>/js/jquery-latest.js"></script>
<script type="text/javascript" src="<?php echo PROJECT_PATH; ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo PROJECT_PATH; ?>/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo PROJECT_PATH; ?>/js/month-year-picker.js"></script>
<script type="text/javascript" src="<?php echo PROJECT_PATH; ?>/js/utility-javascript.js"></script>
<script type="text/javascript" src="<?php echo PROJECT_PATH; ?>/payroll/payroll-javascript.js"></script>
<script>
$(function() {

//document.getElementById('financial_year_from_date').value;
var min_date = new Date(<?php echo  financialYearDateformat('Y', $_SESSION['session_financial_year_from_date']); ?>, <?php echo  financialYearDateformat('n', $_SESSION['session_financial_year_from_date']); ?> - 1, <?php echo  financialYearDateformat('j', $_SESSION['session_financial_year_from_date']); ?>);
var max_date = new Date(<?php echo  financialYearDateformat('Y', $_SESSION['session_financial_year_to_date']); ?>, <?php echo  financialYearDateformat('n', $_SESSION['session_financial_year_to_date']); ?> - 1, <?php echo  financialYearDateformat('j', $_SESSION['session_financial_year_to_date']); ?>);
$( "#payroll_upto" ).datepicker({ minDate: min_date, maxDate: max_date});
//$( "#search_attendance_date" ).datepicker( "option", "dateFormat", "dd/mm/yy");

});
</script>
</head>
<body>
<div id="header">
  <?php require_once('../includes/header.php'); ?>
</div>
<div style="margin:0 auto; width:100%;">
  <div id="content">
    <div id="left-panel">
      <?php  require_once('../includes/left-menu.php'); ?>
    </div>
    <div id="right-content">
      <div class="form-box welcome-box left">
        <?php  require_once('../includes/welcome-box.php'); ?>
      </div>
      <div class="form-box inner-formbox">
        <h2>Payroll</h2>
        <div class="div-bg"></div>
        <table width="100%" border="0">
          <?php if((isset($_GET['page'])) && ($_GET['page']=='add')) { ?>
          <tr>
            <td align="center"><form action="index.php" method="post" name="generate_payslip_form" id="generate_payslip_form" onSubmit="return v.exec()" enctype="multipart/form-data"/>
              <table width="100%" border="0" cellspacing="0" cellpadding="5">
                <tr>
                  <td class="<?php echo $msg_style; ?>" align="center"><?php  messageDisplay(); ?></td>
                </tr>
                <tr>
                  <td align="center" id="t_payroll_branch_id"><span class="required">*</span> Branch &nbsp;&nbsp;
				  
<?php if(($_SESSION['session_admin_user_level']=='admin') || ($_SESSION['session_admin_user_level']=='head-office')){?>
					<select  name="payroll_branch_id" id="payroll_branch_id"   class="textbox" tabindex="4">					
					 <?php if(isset($_POST['payroll_branch_id']) &&(!empty($_POST['payroll_branch_id']))) { ?>
                        <option value="<?php echo $branch_id;?>" ><?php echo ucfirst($branch_name);?></option>
                        <?php foreach($arr_branch as $get_branch) { 
										if($get_branch['branch_id']!=$branch_id){ ?>
                        <option value="<?php echo $get_branch['branch_id']; ?>"><?php echo ucfirst($get_branch['branch_name']); ?></option>
                        <?php } }?>
						<option value="" > - Select - </option>
						<?php		}else { ?>
                        <option value="" > - Select - </option>
                        <?php foreach($arr_branch as $get_branch) { ?>
                        <option value="<?php echo $get_branch['branch_id']; ?>"><?php echo ucfirst($get_branch['branch_name']); ?></option>
                        <?php } } ?>
                      </select>
					   <?php } else {?>
                    <input type="text" name="branch_name" id="branch_name" value="<?php echo $_SESSION['session_admin_user_branch_name'];?>" readonly="" class="textbox" />
                    <input type="hidden" name="payroll_branch_id" id="payroll_branch_id" value="<?php echo $_SESSION['session_admin_user_branch_id'];?>" />
                  <?php }?>				 </td>
                </tr>
                <tr>
                  <td align="center" id="t_payroll_mm_yyyy"><span class="required">*</span> Month / Year &nbsp;
                    <input type='text' name="payroll_mm_yyyy" id="payroll_mm_yyyy" class="textbox" readonly="readonly"  onchange="getLastDate()"/>    </td>
                </tr>
                <tr>
                  <td align="center" id="t_payroll_upto"><span class="required">*</span> Date Upto &nbsp;
                    <input type='text' name="payroll_upto" id="payroll_upto" class="textbox" readonly="readonly" /> </td>
                </tr>
                <tr>
                  <td><div id="sub_code"></div></td>
                </tr>
                <tr>
                  <td align="center"><input type="hidden" name="token" value="<?php echo csrfToken(); ?>">
                    <input type="submit" name="generate_payslip" id="generate_payslip" class="save-button" tabindex="6" value="Generate"/>
                    <input type="reset" name="reset"  class="reset-button" tabindex="7" value="Reset" />
                    <input type="button" name="back"  class="back-button" tabindex="8"  onclick="location.href='index'" value="Back" /></td>
                </tr>
              </table>
              </form></td>
          </tr>
          <?php } else if( (isset($_GET['page'])) && ($_GET['page']=='edit') && ($_GET['id']) ) { ?>
          <tr>
            <td align="center"><form action="index.php" method="post" name="list_department" id="list_department" enctype="multipart/form-data" onSubmit="return v.exec11()"  >
                <table width="55%" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td colspan="2" class="<?php echo $msg_style; ?>" align="center"><?php  messageDisplay(); ?></td>
                  </tr>
                  <tr>
                    <td width="37%" id="t_department_name">&nbsp;&nbsp;&nbsp;Date</td>
                    <td width="68%"><input type="text" name="department_name" id="department_name" class="textbox" tabindex="1"  value="<?php echo $edit_department['department_name']; ?>"  />
                      <input  type="hidden" name="department_id"  id="department_id"  class="textbox"  value="<?php echo $edit_department['department_id']; ?>"  />
                      <input  type="hidden" name="department_uniq_id"  id="department_uniq_id"  class="textbox"  value="<?php echo $edit_department['department_uniq_id']; ?>"  />
                    </td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td valign="top"><input type="hidden" name="token" value="<?php echo csrfToken(); ?>">
                      <input type="submit" name="generate_payslip" id="generate_payslip" class="save-button" tabindex="6" value="Generate Payslip"/>
                      <input name="reset" type="reset" class="reset-button" tabindex="7" value="Reset" />
                      <input name="back" type="button" class="back-button" tabindex="8"  onclick="location.href='index'" value="Back" /></td>
                  </tr>
                </table>
              </form></td>
          </tr>
          <?php } else if( (isset($_GET['mm'])) && ($_GET['page']=='view') && (isset($_GET['yyyy'])) ) { ?>

          <tr>
            <td align="center"><form action="index.php" method="post" name="department_form" id="department_form" >
                <table width="100%" border="0" cellspacing="0" cellpadding="5" >
				  
					<?php if(isset($_SESSION['session_msg'])) { ?>
					  <tr>
						<td colspan="2" class="<?php echo $msg_style; ?>" align="center"><?php  messageDisplay(); ?></td>
					  </tr>
					<?php }
					 ?>
					<tr ><td colspan="2" align="center">
		  				<span class="required"></span>Date
						<?php if(strlen($_GET['mm'])==1) { $date= '0'.$_GET['mm'].'/'.$_GET['yyyy']; } else { $date= $_GET['mm'].'/'.$_GET['yyyy']; }?>
						<input type='text' name="mm_yyyy" id="mm_yyyy" class="textbox" readonly="readonly" value="<?php echo $date; ?>" />  
					</td></tr>					 
                  <?php if($_SESSION['session_admin_user_level'] != "user") { ?>
                  <tr>
                    <td colspan="2">
					<table width="100%%" id="mytable" class="scroll_top sortable">
					<thead>
                      <tr>
                        <th width="3%">S.No</th>
                        <th width="13%">Employee No </th>
                        <th width="80%">Name</th>
                        <th width="4%" class="sorttable_nosort">Payslip</th>
                        </tr>
					</thead>
                      <?php 
					  if($list_employee > 0){					  
							$sno = 1; 
							foreach($list_employee as $record_employees) { 
					  ?>
					  <tr>
                        <td><?php echo $sno++; ?></td>
                        <td><?php echo $record_employees['employee_code']; ?></td>
                        <td><?php echo ucwords($record_employees['employee_name']); ?></td>
                        <td><a href="payroll-pdf.php?month=<?php echo $_GET['mm'];?>&year=<?php echo $_GET['yyyy'];?>&employee_id=<?php echo $record_employees['employee_id'];?>" target="_blank"><img src="../images/view-icon.png" width="15" border="0" alt="Payslip" title="Payslip"></a></td>
					    </tr>
					  <?php 
					  	} 
					  } else { ?>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        </tr>
					  <?php } ?>
                    
                    </table></td>
                  </tr>
                  <?php }?>
                  <tr>
                    <td width="37%">&nbsp;</td>
                    <td width="68%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td valign="top"><input name="back" type="button" class="back-button" tabindex="11"  onclick="location.href='index'" value="Back" /></td>
                  </tr>
                </table>
              </form></td>
          </tr>
          <?php } else  { ?>
          <tr>
            <td align="center"><form action="index.php" name="department_form"  id="department_form"  method="post"  >
                <table width="50%" border="0">
                  <?php 
			   if(isset($_POST['search_department_name'])) 
	            {
		          $search_name = $_POST['search_department_name']; 
	        } else {
	              $search_name = ""; 
	         } ?>
                  <tr>
                    <td>Name</td>
                    <td><input type="text" name="search_department_name" id="search_department_name" class="textbox" tabindex="1" value="<?php echo $search_name; ?>">
                    </td>
                    <td >Status</td>
                    <td><select name="search_department_publish_status" id="search_department_publish_status" class="selectbox" tabindex="2" />
                      
                      <?php 
						if(isset($_REQUEST['search_department_publish_status'])) {
							echo "<option value='".$_REQUEST['search_department_publish_status']."'>".ucwords($_REQUEST['search_department_publish_status'])."</option>";
						}
						foreach($arr_publish_status as $publish_status_value => $publish_status_list) {
						    if($_REQUEST['search_department_publish_status']!=$publish_status_value) {
								echo "<option value='".$publish_status_value."'>".$publish_status_list."</option>";
							}
						}
						?>
                      </select></td>
                  </tr>
                  <tr>
                    <td colspan="4" align="center"><input type="submit" name="search_button" id="search_button" class="search-button" tabindex="3" value="Search"/>
                      <input type="button"  name="view_all" id="view_all"  class="display-all-button" tabindex="4"  onclick="location.href='index'" value="Display All"/></td>
                  </tr>
                </table>
              </form></td>
          </tr>
          <tr>
            <td align="right"><input type="submit" name="department-add"  class="add-button"  onclick="location.href='index?page=add'" value="Generate Payslip" /></td>
          </tr>
		  <?php if(($_SESSION['session_admin_user_level'] == "admin") ){?>	 
          <tr>
            <td><div class="div-bg"></div>
              <form  name="list_department" id="list_department" action="index" method="post" >
                <table id="mytable" width="100%">
                  <thead>
                    <?php if(isset($_SESSION['session_msg'])) { ?>
                    <tr>
                      <td colspan="5" class="<?php echo $msg_style; ?>" align="center"><?php  messageDisplay(); ?></td>
                    </tr>
                    <?php }?>
                    <tr>
                      <th width="8%">#</th>
                      <th width="32%">Month</th>
                      <th width="11%">Year</th>
                      <th width="11%">View</th>
                      <th width="25%">&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
             $sno = 1; 
			 if($list_payroll){ 
				 foreach($list_payroll as $payroll_value) { ?>
                    <tr class="<?php echo rowStyle($sno); ?>">
                      <td><?php echo $sno++; ?></td>
                      <td><?php echo monthName($payroll_value['payroll_month']);  ?></td>
                      <td><?php echo $payroll_value['payroll_year']; ?></td>
                      <td><a href="<?php echo PROJECT_PATH;?>/payroll/index.php?page=view&mm=<?php echo $payroll_value['payroll_month']; ?>&yyyy=<?php echo $payroll_value['payroll_year']; ?>"><img src="../images/view-icon.png" width="15" border="0" alt="View" title="View"></a></td>
                      <td>&nbsp;</td>
                    </tr>
                    <?php } } else {?>
                    <tr >
                      <td colspan="5" align="center" class="text_orange"><?php echo "No Record(s) Found" ; ?></td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
              </form></td>
          </tr>
          <?php } } ?>
        </table>
      </div>
    </div>
  </div>
</div>
<div id="footer">
  <?php require_once('../includes/footer.php'); ?>
</div>
</body>
<script>
$("#accordion > li > div").click(function(){

	if(false == $(this).next().is(':visible')) {
		$('#accordion ul').slideUp(300);
	}
	$(this).next().slideToggle(300);
});

$('#accordion ul:eq(4)').show();

$(document).ready(function () {
            $(".scroll_top").freezeHeader();
        })

</script>
</html>
<?php 
} else { 
	header("Location:".PROJECT_PATH."/404"); 
	exit();
} ?>
