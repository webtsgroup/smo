   
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.html">
                  <?php 
				  echo $this->Html->image('ui-sam.jpg', array('alt' => 'logo', 'border' => '0', 'class'=>'img-circle', 'width'=>'60'));
				  ?>
                  </a></p>
              	  <h5 class="centered">Marcel Newman</h5>
              	  
                  
                    
                  <li class="mt">
                      <a  href="/index.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
				<li class="sub-menu only_sas">
                      <a class="active" href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span><?php echo __('Admin SAS'); ?></span>
                      </a>
                      <ul class="sub">
                          <li><a href="<?php echo $this->Html->url(array('controller' => 'accounts','action' => 'index')); ?>">
						  <i class="glyphicon glyphicon-globe"></i><span><?php echo __('Accounts Control',true); ?></span></a></li>
                          <li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'index')); ?>">
                          <i class="glyphicon glyphicon-user"></i><span><?php echo __('Users Control',true); ?></span></a></li>
                          <li><a  href="<?php echo $this->Html->url(array('controller' => 'configs', 'action' => 'index')); ?>">
                          <i class="fa fa-cogs"></i><span><?php echo __('Configuration',true); ?></span></a></li>
                          <li><a  href="<?php echo $this->Html->url(array('controller' => 'templates', 'action' => 'add')); ?>">
                          <i class="fa fa-unlock"></i><span><?php echo __('Template',true); ?></span></a></li>
                          <li><a  href="<?php echo $this->Html->url(array('controller' => 'templates', 'action' => 'index')); ?>">
                          <i class="fa fa-unlock"></i><span><?php echo __('Access Control List',true); ?></span></a></li>
                      </ul>
                  </li>	
                  <li class="sub-menu">
                  	<a href="javascript:;" >
                          <i class="fa fa-envelope"></i>
                          <span><?php echo __('Newsletters'); ?></span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo $this->Html->url(array('controller' => 'letters', 'action' => 'make')); ?>">
                        <i class="fa fa-pencil-square"></i><span><?php echo __('Create',true); ?></span></a></li>
                        <li><a href="<?php echo $this->Html->url(array('controller' => 'letters', 'action' => 'index')); ?>">
                        <i class="fa fa-list-alt"></i><span><?php echo __('Lists',true); ?></span></a></li>
                     </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'index')); ?>" >
                          <i class="fa fa-users"></i>
                          <span><?php echo __('Group Control',true); ?></span>
                      </a>
                  </li>
                  <li class="sub-menu">
                  	<a href="<?php echo $this->Html->url(array('controller' => 'members', 'action' => 'index')); ?>">
                  		<i class="fa fa-user"></i>
                        <span><?php echo __('Members Control',true); ?></span>
                     </a>
                  </li>
                  <li class="sub-menu">
                  	<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'index')); ?>">
                  		<i class="fa fa-unlock"></i>
                        <span><?php echo __('Users Control',true); ?></span>
                     </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->