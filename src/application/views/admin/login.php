<html>
	<head>
	 	<link href="<?php echo base_url(). "assets/css/layout.css"?>" rel="stylesheet" type="text/css">	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/assets/jquery/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="<?php echo base_url();?>assets/assets/jquery/jquery-ui.min.css"/>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<title>Login Page | xPOS, Point of Sale</title>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-md-12 text-center">
					<h1>xPOS, an extended Point of Sale Software</h1>
					<hr/>
				</div>
			</div>
		</div>
					
				<?php echo form_open('login/authenticate');?>
				<div class="container">
					<div class="row">
						<div class="col-sm-12 col-lg-6 col-md-6" style="border-right:1px solid silver; ">
							<div class="row">
								<div class="col-lg-8 col-sm-8 col-md-8">
									<h2><img alt="Anywhere" style="max-width: 600px;" src="<?php echo base_url("assets")?>/images/login_icon.jpg">Login here</h2>
								</div>
							</div>
							<div class="row align-items-center">
								<div class="col-lg-8 col-sm-8 col-md-8 offset-md-4">
									<p>
										<label>Username</label>
										<br/>
										<input type="text" class="form-control"  placeholder="Username" required="required" id="username" name="username"/>
									</p>
									<p>
										<label>Password</label>
										<br/>
										<input type="password" class="form-control"  placeholder="Password" required="required" id="password" name="password"/>
									</p>
									<p>
										<button class="btn btn-primary" type="submit" name="submit"> Login </button>
										<button class="btn btn-default" onclick="this.form.reset();" type="button" name="reset"> Reset </button>
									</p>
								</div>
							</div>
							
						</div>
						<div class="col-sm-12 col-lg-6 col-md-6">
							<img alt="Anywhere" style="max-width: 600px;" src="<?php echo base_url("assets")?>/images/mobile.png">
						</div>
						
					</div>
				</div>
				
			<?php echo form_close();?>
			
			<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-md-12 text-center">
					<hr/>
					&copy;2017, NetSoft Limited.
					
				</div>
			</div>
		</div>
	</body>
</html>