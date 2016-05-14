      <?php
	  foreach($systemConfigs as $key => $value)
		{
			$$key = $value;
		}
	  ?>
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="glyphicon glyphicon-cog"></i> <?php echo __('Configuration',true);?></h3>
          	<div class="box">
            <div class="box-content">
                <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                  <li role="presentation" class="active"><a href="#tab-1" data-toggle="tab"><?php echo __('SMTP',true); ?> &nbsp; <i class="fa fa-envelope"></i></a></li>
                  <li role="presentation"><a href="#tab-2" data-toggle="tab">Profile</a></li>
                  <li role="presentation"><a href="#tab-3" data-toggle="tab">Messages</a></li>
                </ul>
                <div id="my-tab-content" class="tab-content border border-1 paddingTop20">
                	<!---SMTP config------------------------->
                    <div id="tab-1" class="tab-pane active" >
                    <div class="col-md-12">
                        <form class="form-horizontal">
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('SMTP',true); ?></label>
                            <div class="col-sm-2">
                            <?php
								$option = array('0' => 'No', '1' => 'Yes');
								echo $this->Form->input('s_use_smtp', array(
									'div' => false, 
									'label' => false,
									"default" => &$s_use_smtp,
									'onchange' => "editMe(this.id,this.value);",
									"class" => "form-control input-sm",
									"options" => $option
									));
							?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"><?php echo __('SMTP Host',true); ?></label>
                            <div class="col-sm-4">
                            	<?php
								echo $this->Form->input(
									's_smtp_host',
									array(
										'name' => 's_smtp_host',
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm',
										"default" => &$s_smtp_host,
										'onchange' => "editMe(this.id,this.value);",
									)
								);
								?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('SMTP Port',true); ?></label>
                            <div class="col-sm-4">
                              <?php
								echo $this->Form->input(
									's_smtp_port',
									array(
										'name' => 's_smtp_port',
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm',
										"default" => &$s_smtp_port,
										'onchange' => "editMe(this.id,this.value);",
									)
								);
								?>                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('SMTP Authentication',true); ?></label>
                            <div class="col-sm-2">
                            <?php
								$option = array('0' => 'No', '1' => 'Yes');
								echo $this->Form->input('s_smtp_authentication', array(
									'div' => false, 
									'label' => false,
									"default" => &$s_smtp_authentication,
									'onchange' => "editMe(this.id,this.value);",
									"class" => "form-control input-sm",
									"options" => $option
									));
							?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"><?php echo __('SMTP Email',true); ?></label>
                            <div class="col-sm-4">
                              <?php
								echo $this->Form->input(
									's_smtp_email',
									array(
										'name' => 's_smtp_email',
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm',
										"default" => &$s_smtp_email,
										'onchange' => "editMe(this.id,this.value);",
									)
								);
								?> 
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('SMTP Password',true); ?></label>
                            <div class="col-sm-4">
                              
                              <?php
								echo $this->Form->input(
									's_smtp_pass',
									array(
										'type' => 'password',
										'name' => 's_smtp_pass',
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm',
										"default" => &$s_smtp_pass,
										'onchange' => "editMe(this.id,this.value);",
									)
								);
								?> 
                            </div>
                            <label for="inputPassword3" class="col-sm-2 control-label">
                            <input type="checkbox" class="checkbox-inline" onclick="showPass('s_smtp_pass')"  />
                            <?php echo __('Show Password',true); ?>
                            </label>
                          </div>
                        </form>
                    </div>
                    </div>
                    <!----END SMTP--------------------------------->
                    
                    <!----EMAIL FORMAT CONFIG---------------------->
                    <div id="tab-2" class="tab-pane" >
                    <div class="col-md-12">
                        <form class="form-horizontal">
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Email Format',true); ?></label>
                            <div class="col-sm-2">
                            <?php
								$option = array('0' => 'Text', '1' => 'HTML');
								echo $this->Form->input('s_email_format', array(
									'div' => false, 
									'label' => false,
									"default" => &$s_email_format,
									'onchange' => "editMe(this.id,this.value);",
									"class" => "form-control input-sm",
									"options" => $option
									));
							?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Template',true); ?></label>
                            <div class="col-sm-4">
                            <?php
								$option = array();
								echo $this->Form->input('s_email_template', array(
									'div' => false, 
									'label' => false,
									"default" => &$s_email_template,
									'onchange' => "editMe(this.id,this.value);",
									"class" => "form-control input-sm",
									"options" => $option
									));
							?>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"><?php echo __('Charset',true); ?></label>
                            <div class="col-sm-4">
                              <?php
								echo $this->Form->input(
									's_email_charset',
									array(
										'name' => 's_email_charset',
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm',
										"default" => &$s_email_charset,
										'onchange' => "editMe(this.id,this.value);",
									)
								);
								?> 
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Replyto',true); ?></label>
                            <div class="col-sm-4">
                              
                              <?php
								echo $this->Form->input(
									's_email_replyto',
									array(
										'name' => 's_email_replyto',
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm',
										"default" => &$s_email_replyto,
										'onchange' => "editMe(this.id,this.value);",
									)
								);
								?> 
                            </div>
                          </div>
                        </form>
                    </div>
                    </div>
                    <!----END EMAIL FORMAT------------------------->
                    <br clear="all"  />
                </div>
             </div>
             </div>
		</section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->   
      <script type="text/javascript">
			jQuery(document).ready(function ($) {
				$('#tabs').tab();
			});
		</script>
      <?php echo $this->element('configScript'); ?>