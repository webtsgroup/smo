<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Marketing Online Strategy</title>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php
    echo $this->Html->css(array(
  		'bootstrap', //Bootstrap core CSS
  		'font-awesome/css/font-awesome', //external css
  		'zabuto_calendar', //external css
  		'/js/gritter/css/jquery.gritter', //external css
  		'lineicons/style', //external css
  		'style', //Custom styles for this template
  		'style-responsive', //Custom styles for this template
  		//'spinner', //div loading
  	));
    ?>
  </head>

  <body>
  <!--<div class="spinner-loader">Loading…</div>-->
  <?php //echo $this->element('sql_dump'); ?>
  <section id="container" >

      <?php echo $this->element('header_start'); ?>
      <?php echo $this->element('sidebar_menu_start'); ?>
      <?php
	echo $this->Html->script(array(
		'jquery', //js placed at the end of the document so the pages load faster
		'jquery.bt', //js placed at the end of the document so the pages load faster
		'jquery-1.8.3.min', //js placed at the end of the document so the pages load faster
	));
	?>

      <!---MAIN CONTENT------------>
      <?php echo $this->fetch('content'); ?>
      <!---END MAIN CONTENT-------->

      <!-- Modal -->
      <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title"><?php echo __('Notifycation',true);?></h4>
                  </div>
                  <div class="modal-body">
                      <div id="showResult">Content</div>
                  </div>
                  <div class="modal-footer">
                      <button data-dismiss="modal" class="btn btn-default btn-sm" id="btnCancelModal" type="button">
                      <i class="glyphicon glyphicon-remove"></i>&nbsp;<?php echo __('Cancel',true);?></button>
                  </div>
              </div>
          </div>
      </div>
      <!-- modal -->

  </section>
  <?php
	echo $this->Html->script(array(
		'bootstrap.min', //js placed at the end of the document so the pages load faster
		'init', //create for my site
	));
	?>
  <?php
		echo $this->Html->script(array(
			'jquery.dcjqaccordion.2.7', //js placed at the end of the document so the pages load faster
			'jquery.scrollTo.min', //js placed at the end of the document so the pages load faster
			'jquery.nicescroll', //js placed at the end of the document so the pages load faster
			'jquery.sparkline', //js placed at the end of the document so the pages load faster
		));
		echo $this->Html->script(array(
			'common-scripts', //common script for all pages
			'gritter/js/jquery.gritter', //common script for all pages
			'gritter-conf', //common script for all pages
		));
	?>
  <script type="text/javascript">
  <?php if($ROLE != 'sas') { ?>
  jQuery(document).ready(function ($) {
  	$('.only_sas').each(function(index, element) {
        $(this).remove();
    });
  });
  <?php } ?>
  </script>
  </body>
</html>
