<section id="main-content">
  <section class="wrapper">
  	<h3 class="box-title"><i class="glyphicon glyphicon-list"></i> <?php echo __('Access control Lists',true);?></h3>    
    <div class="box">
            <div class="box-content">
                <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                  <li role="presentation" class="active"><a href="#tab-1" data-toggle="tab"><i class="fa fa-user"></i> &nbsp; <?php echo __('SAS',true); ?></a></li>
                  <li role="presentation"><a href="#tab-2" data-toggle="tab"><i class="fa fa-users"></i> &nbsp; <?php echo __('Admin',true); ?></a></li>
                  <li role="presentation"><a href="#tab-3" data-toggle="tab"><i class="fa fa-users"></i> &nbsp; <?php echo __('Sub-Admin',true); ?></a></li>
                </ul>
                <div id="my-tab-content" class="tab-content border border-1">
                <? for($role=0;$role<3;$role++)
				{
					$active = $role ==  0 ?  'active' : ''; ?>
                	<!---SMTP config------------------------->
                    <div id="tab-<?php echo $role+1; ?>" class="tab-pane <?php echo $active; ?>" >
                    <div class="col-md-12">
                        <?php
						
						foreach($arr as $controller=>$actions)
						{ 
							$i = 0 ;
							$ID =  $controller . $role ;
							$NAME = $controller . $role . 'Check[]' ;
							?>
                            <div class="checkbox paddingBottom10"> 
                            <?php 
							$strAcction = '';
							$countChecked = 0 ;
							foreach($actions as $act)
							{
								$child = $ID . '_' . $i ;
								$role_str = $role . '_' . $controller . '_' . $act;
								$i++;
								$checked = ''; 
								if(isset($acls[$role_str]))
								{
									$checked = 'checked';
									$countChecked ++ ;
								}
								$strAcction .= '<label class="checkbox-inline fixed">';
								$strAcction .= $this->Form->input( $NAME , array(
										'type' => 'checkbox',
										'div' => false, 
										'label' => false,
										'id' => $child,
										'name' => $NAME, 
										'checked' => $checked,
										'onClick' => "checkOne('$NAME','$ID','$ID'); setPermission('/acls/setPermission', '$child', $role,'$controller','$act');",
										'hiddenField'=>false
									));
									
									$strAcction .=  $act .'</label>';
							}
							?>
                            <?php 
								
								$strController = '<label class="checkbox-inline fixed">';
                            	$strController .= $this->Form->input( $NAME , array(
									'type' => 'checkbox',
									'div' => false, 
									'label' => false,
									'id' => $ID,
									'checked' => $countChecked == count($actions) ? 'checked' : '',
									'default' => &$s_email_template,
									'onClick' => "checkAll('$NAME','$ID','$ID'); setAll('/acls/setAll','$ID', $role, '$controller');",
									'hiddenField'=>false
								));
							  	$strController .= "<strong class='ctrl'>$controller</strong></label>";
								echo $strController;
								echo $strAcction;
                            ?>
                            </div>
                        <?php
						}
						?>
                    </div>
                    </div>
                    <!----END SMTP--------------------------------->
                    <?php } ?>
                    <br clear="all"  />
                </div>
             </div>
             </div>
             
</section>
</section>
<style>
.fixed{
	min-width:120px;
}
.paddingBottom10{
	padding-bottom:10px;
}
</style>
<script>
function setPermission(url, id, role, controller, action)
{
	var pass = $('#'+id).is(':checked') ? 1 : 0 ;
	var data = {role : role, controller : controller, action : action, pass : pass} ;
	$ajax(url, data);
}
function setAll(url, id, role, controller)
{
	var pass = $('#'+id).is(':checked') ? 1 : 0 ;
	var data = {role : role, controller : controller, pass : pass} ;
	$ajax(url, data);
}

</script>