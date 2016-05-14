
<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <h3><i class="fa fa-users"></i> <?php echo __('Member Lists',true);?>
    <div class="pull pull-right">
    	<a class="btn btn-sm btn-success" href="javascript:;" onclick="addNew();" >
        <i class="fa fa-user-plus"></i> <?php echo __('Add new',true);?></a>
    	<a class="btn btn-sm btn-success" href="<?php echo $this->Html->url(array('action' => 'add')); ?>" >
        <i class="glyphicon glyphicon-import"></i> <?php echo __('Import',true);?></a>
    </div></h3>
    <div id="dataviewContainer" style="width:100%;"></div>
</section>
</section>
<!-- /MAIN CONTENT -->

<?php
	echo $this->element('includeSlickGrid');	
	$data = array();
	foreach($results as $i => $_data)
	{
		$i++;
		$_data = $_data['Member'];
		$_data['id'] = $_data['id'];
		$_data['no.'] = $i;
		$_data['email'] = $_data['email'];
		$_data['first_name'] = $_data['first_name'];
		$_data['last_name'] = $_data['last_name'];
		$_data['location'] = $_data['location'];
		$_data['group'] = $_data['group'];
		//$_data['control'] = 'Link ' . $i;
		$editRow = $this->Html->link(__('Edit', true), array('javascript:;'), array('class' => 'editRow'));
		$_data['action'] = $editRow.' | '.$this->Html->link(__('Delete', true), array('controller' => 'members','action' => 'index', $i), array('class' => ''),sprintf(__('Are you sure you want to delete "%1$s"?', true), $_data['first_name']));
		$data[] = $_data;
	}
	$columns = array(
		array(
			'id' => "no.", 
			'name' => __("Order",true), 
			'field' => "no.", 
			'width' => 50,
			'noFilter' => true,
			'sortable' => true,
			'cssClass' => 'divCenter',
			'formatter' => 'Slick.Editors.Order'
		),
		array(
			'id' => "email", 
			'name' => __("Email",true), 
			'field' => "email", 
			'width' => 240, 
			'sortable' => true,
			'editor' => 'Slick.Editors.Text',
			'validator' => 'DataValidator.email'
		),
		array(
			'id' => "first_name", 
			'name' => __("First Name",true), 
			'field' => "first_name", 
			'width' => 160, 
			'sortable' => true,
			'editor' => 'Slick.Editors.Text'
		),
		array(
			'id' => "last_name", 
			'name' => __("Last Name",true), 
			'field' => "last_name", 
			'width' => 160, 
			'sortable' => true,
			'editor' => 'Slick.Editors.Text',
		),
		/*array(
			'id' => "location", 
			'name' => __("Location",true), 
			'field' => "location", 
			'width' => 240, 
			'sortable' => true,
			'formatter' => 'Slick.Editors.Text'
		),*/
		array(
			'id' => "action", 
			'name' => __("Action",true), 
			'field' => "action", 
			'width' => 80, 
			'noFilter' => true,
			'sortable' => false,
			'cssClass' => 'divCenter',
			'formatter' => 'Slick.Formatters.Action'
		)
	);
	$selectMaps = array(
		'validated' => array("no" => __('No', true), "yes"=>__('Yes', true))
	);
	$i18n = array(
		'The Activity has already been exist.' => __('The Activity has already been exist.', true),
		'The date must be smaller than or equal to %s' => __('The date must be smaller than or equal to %s', true),
		'The date must be greater than or equal to %s' => __('The date must be greater than or equal to %s', true),
		'-- Any --' => __('-- Any --', true),
		'This information is not blank!' => __('This information is not blank!', true),
		'Clear' => __('Clear', true)
	);
?>
<div id="action-template" style="display: none;">
<!--
    <a class="btn btn-default btn-xs" title="Edit" href="<?php echo $this->Html->url(array('action' => 'edit/%s')); ?>">
    <i class="glyphicon glyphicon-edit"></i></a>
    -->
    <a class="btn btn-default btn-xs" role="deleteItem" title="Delete" href="javascript:;">
    <i class="glyphicon glyphicon-remove" role="deleteItem"></i></a>
</div>
<script type="text/javascript">
	var DataValidator = {};
	(function($){   
        $(function(){			
            var $this = SlickGridCustom;	
			$this.i18n = <?php echo json_encode($i18n); ?>;
            var actionTemplate =  $('#action-template').html();
			$this.canModified =  true;
			$this.onApplyValue = function(item){
                $.extend(item, {backupPM : []})
            };
            $.extend(Slick.Formatters,{
                Action : function(row, cell, value, columnDef, dataContext){
                    return Slick.Formatters.HTMLData(row, cell,$this.t(actionTemplate,dataContext.id,
                    dataContext.name,dataContext.name), columnDef, dataContext);
                },
				Order : function(row, cell, value, columnDef, dataContext){
                    return Slick.Formatters.HTMLData(row, cell,value, columnDef, dataContext);
                }
            });
			DataValidator.email = function(value,args){
				if(!validateEmail(value))
				{
					return false;
				}
                var result = true;		
				return {
					valid : result,
					message : $this.t('The contract type has already been exist.')
				};
            }
            var  data = <?php echo json_encode($data); ?>;
            var  columns = <?php echo jsonParseOptions($columns, array('editor', 'formatter', 'validator')); ?>;

            $this.onCellChange = function(args){
				//console.log(args);
				//console.log(args.grid.getSelectedRows());
				//console.log(args.column.validator(args.item.email,args));
				//args.grid.invalidateRow(args.row);
				//return false;
                if(args.item && args.item.validated == ''){
                    args.item.validated = 'no';
                }
                return true;
            };
            $this.fields = {
                id : {defaulValue : 0},
				email : {defaulValue : '', allowEmpty : false},
				first_name : {defaulValue : '', allowEmpty : false},
				last_name : {defaulValue : ''}
            };
			
			$this.selectMaps = <?php echo json_encode($selectMaps); ?>;
            $this.url =  '<?php echo $this->Html->url(array('action' => 'update',$group)); ?>';
			var gridControl = $this.init($('#dataviewContainer'),data,columns);
            addNew = function(){
                gridControl.gotoCell(data.length, 1, true);
            }
        });
    })(jQuery);
</script> 