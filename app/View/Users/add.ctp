      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="glyphicon glyphicon-user"></i> <?php echo __('Add new User',true);?>
            <div class="pull pull-right">
                <a class="btn btn-sm btn-default" href="<?php echo $this->Html->url(array('action' => '/')); ?>" >
                <i class="glyphicon glyphicon-th-list"></i> 
                <?php echo __('Account Lists',true);?></a>
            </div>
        </h3>
          	<div class="box">
            <div class="box-content">
                <div class="tab-content border paddingTop20 clearfix">
                	<div class="col-md-12 clearfix">
                        <form id="addAccount" class="form-horizontal">
                          <div class="form-group has-feedback">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('First Name',true); ?></label>
                            <div class="col-sm-4">
                              <?php
								echo $this->Form->input(
									'first_name',
									array(
										'name' => 'first_name',
										'div' => false,
										'required' => 'required',
										'title' => __('Enter the First Name'),
										'label' => false,
										'class' => 'form-control input-sm input-error',
										'default' => &$result['first_name'],
										'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
									)
								);
								?>  
                                 <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>                          
                              </div>
                          </div>
                          <div class="form-group has-feedback">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Last Name',true); ?></label>
                            <div class="col-sm-4">
                              <?php
								echo $this->Form->input(
									'last_name',
									array(
										'name' => 'last_name',
										'required' => 'required',
										'title' => __('Enter the Last Name'),
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm input-error',
										'default' => &$result['last_name'],
										'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
									)
								);
								?>  
                                 <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>                          
                              </div>
                          </div>
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
                            <label for="inputEmail3" class="col-sm-2 control-label"><?php echo __('Role',true); ?></label>
                            <div class="col-sm-4">
                          		<?php
							  	$option = array(
									'1' => 'Admin', '2' => 'Sub-Admin'
								);
								echo $this->Form->input('role',array(
										'options' => $option,
										'name' => 'role',
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm',
										'default' => &$result['role'],
										'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
									)
								);
								?> 
                                </div>
                          </div>
                          <?php $clsHide = $action == 'add' ? '' : 'elm-hide' ; ?>
                          <?php if($action == 'edit') { ?>
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-4">
                            <button type="button" onclick="showBoxChangePass();" class="btn btn-success btn-xs"><?php echo __('Change Password',true); ?></button>
                            </div>
                          </div>
                          <div class="form-group  has-feedback <?php echo $clsHide;?>">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Old Password',true); ?></label>
                            <div class="col-sm-4">
                              
                              <?php
								echo $this->Form->input(
									'old_pass',
									array(
										'type' => 'password',
										'name' => 'old_pass',
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm',
										//'default' => &$result['pass'],
										//'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
									)
								);
								?> 
                                <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
                            </div>
                          </div>
                          <?php } ?>
                          
                          <div class="form-group  has-feedback <?php echo $clsHide;?>">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Password',true); ?></label>
                            <div class="col-sm-4">
                              
                              <?php
								echo $this->Form->input(
									'pass',
									array(
										'type' => 'password',
										'name' => 'pass',
										'required' => 'required',
										'title' => __('Enter the Password'),
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm',
										//'default' => &$result['pass'],
										//'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
									)
								);
								?> 
                                <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
                            </div>
                          </div>
                          
                          <div class="form-group  has-feedback <?php echo $clsHide;?>">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Re Password',true); ?></label>
                            <div class="col-sm-4">
                              
                              <?php
								echo $this->Form->input(
									're_pass',
									array(
										'type' => 'password',
										'name' => 're_pass',
										'required' => 'required',
										'title' => __('Password does not match'),
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm',
										//'default' => &$result['re_pass'],
										//'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
									)
								);
								?> 
                                <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
                            </div>
                          </div>
                        <?php
						  if($action == 'add')
						  { ?>
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-4">
                              
                            <button type="button" onclick="addNewUser('/users/add');" class="btn btn-primary">
							<i class="fa fa-save"></i><?php echo __('Submit',true); ?></button>
                            </div>
                          </div>
                          <?php } 
						  else { ?>
                          <div class="form-group <?php echo $clsHide;?>">
                            <label for="inputPassword3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-4">
                            <button type="button" onclick="changePass('/users/changePass/<?php echo $id;?>');" class="btn btn-primary">
							<i class="fa fa-save"></i><?php echo __('Sumit',true); ?></button>
                            </div>
                          </div>
                          <?php } ?>
                        </form>
                    </div>
                </div>
             </div>
             </div>
		</section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->