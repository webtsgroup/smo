    <?php
    echo $this->Html->script(array(
		'calendar/jquery-ui',
	));
	 echo $this->Html->css(array(
		'/js/calendar/jquery-ui',
	));
	?>
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="glyphicon glyphicon-user"></i> <?php echo __('Add new Account',true);?>
            <div class="pull pull-right">
                <a class="btn btn-sm btn-default" href="<?php echo $this->Html->url(array('action' => '/')); ?>" >
                <i class="glyphicon glyphicon-th-list"></i> 
                <?php echo __('Account Lists',true);?></a>
            </div>
        </h3>
          	<div class="box">
            <div class="box-content">
                <div class="tab-content border paddingTop20">
                	<div class="col-md-12">
                        <form id="addAccount" class="form-horizontal">
                          <div class="form-group has-feedback">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Company Name',true); ?></label>
                            <div class="col-sm-8">
                              <?php
								echo $this->Form->input(
									'name',
									array(
										'name' => 'name',
										'required' => 'required',
										'title' => __('Enter the Name'),
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm input-error',
										'default' => &$result['name'],
										'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
									)
								);
								?>  
                                 <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>                          
                              </div>
                          </div>
                          <?php /*
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-1 control-label"><?php echo __('Avatar',true); ?></label>
                            <div class="col-sm-8">
                            	<form id="form-upload" method="post" action="uploadFile.php" enctype="multipart/form-data">
                                    <input type="file" class="epopup" name="file" id="select-file"/>
                                    <input type="hidden" class="epopup" name="user_name_id" value="{'user_name_id'}"/>
                                </form>
                                <div class="progress">
                                  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                    <span class="sr-only">45% Complete</span>
                                  </div>
                                </div>                          
                            </div>
                          </div>
						  */
						  ?>
                          <div class="form-group has-feedback">
                            <label for="inputEmail3" class="col-sm-2 control-label"><?php echo __('Email',true); ?></label>
                            <div class="col-sm-4">
                              <?php
								echo $this->Form->input(
									'email',
									array(
										'name' => 'email',
										'required' => 'required',
										'title' => __('Enter the Email'),
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm',
										'default' => &$result['email'],
										'readonly' => isset($onchange) && $onchange != '' ? true : '',
										//'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
									)
								);
								?> 
                                <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span> 
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Phone',true); ?></label>
                            <div class="col-sm-4">
                              
                              <?php
								echo $this->Form->input(
									'phone',
									array(
										'type' => 'text',
										'name' => 'phone',
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm',
										'default' => &$result['phone'],
										'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
									)
								);
								?> 
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Address',true); ?></label>
                            <div class="col-sm-8">
                              
                              <?php
								echo $this->Form->input(
									'address',
									array(
										'type' => 'text',
										'name' => 'address',
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm',
										'default' => &$result['address'],
										'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
									)
								);
								?> 
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Product Package',true); ?></label>
                            <div class="col-sm-4">                            
                              <?php
							  	$option = array(
									'1' => 'Bronze', '2' => 'Silver', '3' => 'Gold', '4' => 'Diamond'
								);
								echo $this->Form->input('package_id',array(
										'options' => $option,
										'name' => 'package_id',
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm',
										'default' => &$result['package'],
										'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
									)
								);
								?> 
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Contract Duration',true); ?></label>
                            <div class="col-sm-4">                            
                              <?php
							  	$option = array(
									'1' => '1 Month', '3' => '3 Month', '6' => '6 Month', '12' => '1 Year'
								);
								echo $this->Form->input('contract_duration',array(
										'options' => $option,
										'name' => 'contract_duration',
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm',
										'default' => &$result['contract_duration'],
										'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
									)
								);
								?> 
                            </div>
                          </div>
                          <div class="form-group  has-feedback">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Date Initialize',true); ?></label>
                            <div class="col-sm-4">                            
                              <?php
								echo $this->Form->input(
									'date_init',
									array(
										'type' => 'text',
										'name' => 'date_init',
										'rel' => 'date',
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm datepicker',
										'default' => &$result['date_init'],
										'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
									)
								);
								?> 
                                <span class="glyphicon glyphicon-calendar form-control-feedback" aria-hidden="true"></span> 
                            </div>
                          </div>
                          <?php 
						  if($action == 'add')
						  { ?>
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-4">
                              
                            <button type="button" onclick="addNewAccount('/accounts/add');" class="btn btn-primary"><?php echo __('Submit',true); ?></button>
                            </div>
                          </div>
                          <?php } ?>
                        </form>
                    </div>
                    <br clear="all"  />
                </div>
             </div>
             </div>
		</section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->
      <script>
	  	$(window).load(function (){
			$(".datepicker").datepicker(
			{
				changeMonth:true,
				changeYear:true,
				minDate: +0,
				dateFormat:'dd-mm-yy'
			});
		});
		 /* var bar = $('#bar');
		  var percent = $('#percent');
		  var result = $('#result');
		  var percentValue = "0%";
		  $('#form-upload').ajaxForm({
			  // Do something before uploading
			  beforeUpload: function() {
				result.empty();
				percentValue = "0%";
				bar.width = percentValue;
				percent.html(percentValue);
			  },		 
			  // Do somthing while uploading
			  uploadProgress: function(event, position, total, percentComplete) {
				var percentValue = percentComplete + '%';
				bar.width(percentValue)
				percent.html(percentValue);
			  },		 
			  // Do something while uploading file finish
			  success: function() {
				var percentValue = '100%';
				bar.width(percentValue)
				percent.html(percentValue);
			  },
			  // Add response text to div #result when uploading complete
			  complete: function(xhr) {      
				//$('#result').append(xhr.responseText);
				$('#result').attr('src',xhr.responseText);
				$('#uploadAvatar').fadeOut();
				$('#uploadAvatar').removeClass('active');
				$('#bar').width(0);
				$('#percent').html('0 %');
				$('#select-file').val('');
			  }
		  }); */
		</script>