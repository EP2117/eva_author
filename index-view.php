<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>EVA Group Co,LT</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Server Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<!-- css files -->
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" /> <!-- Style-CSS --> 
<link rel="stylesheet" href="css/font-awesome.css"> <!-- Font-Awesome-Icons-CSS -->
<link href="//fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">

<!-- //css files -->
</head>
<body>
<!-- main -->
<div class="w3ls-header">
	<h1>EVA STEEL</h1>
	<div class="header-main">
		<h2>SIGN <span>IN</span></a></h2>
			<div class="header-bottom">
				<div class="header-right w3agile">
					<div class="header-left-bottom agileinfo">
						<form action="index.php" method="post">
							<div class="icon1">
								<input type="text" name="user_name" id="user_password" placeholder="Username" tabindex="1" />
							</div>
							<div class="icon1">
								<input type="password" name="user_password" id="user_password" placeholder="Password"  tabindex="2" />
							</div>
							<div class="icon1 styled-select">
								<select name="user_financial_year" id="user_financial_year"  tabindex="3" style="color:#000000">
              						<?php	
										foreach($list_financial_year as $record_financial_years) {  ?>
              								<option value="<?php echo $record_financial_years['financial_year_id']; ?>"> - <?php echo $record_financial_years['financial_year_from'].' - '.$record_financial_years['financial_year_to']; ?> - </option>
              						<?php } ?>
								</select>
							</div>

							
							<div class="bottom">
								<input type="submit" name="sign_in" value="Log in"  tabindex="4" />
							</div>
							<p></p>
					</form>	
					</div>
				</div>
			</div>
	</div>
</div>
<!--header end here-->
<!-- copyright start here -->
<div class="copyright">
<!--	<p>© 2017 Server Login Form. All rights reserved | Design by  <a href="http://w3layouts.com/" target="_blank">  W3layouts </a></p>-->
</div>
<!--copyright end here-->
</body>
</html>