<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>Marketing Online Strategy</title>
	<?php
	echo $this->Html->css(array(
		'bootstrap', //Bootstrap core CSS
		'font-awesome/css/font-awesome', //external css
		'style', //Custom styles for this template
		'style-responsive', //Custom styles for this template
	));
	?>  
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" id="loginForm" >
		        <h2 class="form-login-heading"><i class="glyphicon glyphicon-lock"></i> sign in now</h2>
		        <div class="login-wrap">
                	<div class="form-group input-group">
                    <div id="showResult">Content</div>
                    </div>
                	<div class="form-group input-group">
                	<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		            <input type="text" name="email" id="email" class="form-control" placeholder="<?php echo __('Email',true);?>" autofocus>
		            </div>
                    <div class="form-group input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
		            <input type="password" name="pass" id="pass" class="form-control" placeholder="<?php echo __('Password',true);?>">
                    </div>
                    <div class="form-group">
                    <span class="pull-left">
                    <label class="checkbox-inline">
                    <input type="checkbox"> <?php echo __('Remember me',true);?>
                    </label>
                    </span>
		            
                    <span class="pull-right">
                    <label class="checkbox-inline">
                        <a data-toggle="modal" href="login.html#myModal"> <?php echo __('Forgot Password?',true);?></a>
                    </label>
                    </span>
                    <br clear="all"  />
                    </div>
                    <div class="form-group">
		            <button class="btn btn-theme btn-block" onclick="login('/users/login');" type="button"><i class="fa fa-lock"></i> <?php echo __('Sign in',true);?></button>
                    </div>
		            <hr>
		            
		            <div class="registration">
		                Don't have an account yet?<br/>
		                <a class="" href="#">
		                    Create an account
		                </a>
		            </div>
		
		        </div>
		
		          <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title"><?php echo __('Forgot Password?',true);?></h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your e-mail address below to reset your password.</p>
                                  <div class="form-group input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
								</div>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" type="button">Submit</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		
		      </form>	  	
	  	
	  	</div>
	  </div>
	<?php
	echo $this->Html->script(array(
			'jquery', //common script for all pages
			'jquery-1.8.3.min',
			'bootstrap.min', //common script for all pages
			'jquery.backstretch.min', //common script for all pages
			'init'
		));
	?>
    <script>
        $.backstretch("<?php echo $this->Html->url('/img/login-bg.jpg'); ?>", {speed: 500});
    </script>
  </body>
</html>
