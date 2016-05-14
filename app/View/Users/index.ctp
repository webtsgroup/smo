 
<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
  <section class="wrapper">
  	<div class="col-md-12 no-padding">
    <div class="box">
    <div class="box-primary">
    <div class="box-header">
        <h3 class="box-title"><i class="glyphicon glyphicon-list"></i> <?php echo __('User Lists',true);?>
        <div class="pull pull-right">
            <a class="btn btn-sm btn-success" href="<?php echo $this->Html->url(array('action' => 'add')); ?>" ><i class="fa fa-user-plus"></i> 
            <?php echo __('Add new',true);?></a>
        </div>
        </h3>
    </div>
    </div>
    </div>
    </div>
    <div id="dataviewContainer" style="width:100%;"></div>
</section>
</section><br clear="all"  /><br clear="all"  /><!-- /MAIN CONTENT -->

<?php
	echo $this->element('includeSlickGrid');
	$data = array();
	foreach($results as $i => $item)
	{
		$i++;
		$item = $item['User'];
		$_data['id'] = $item['id'];
		$_data['no.'] = $i;
		$_data['name'] = $item['name'];
		$_data['email'] = $item['email'];
		$str = '<i class="fa fa-check-square-o"></i>';
		$_data['active'] = $item['active'] == 1 ? $str : '';
		$_data['role'] = $item['role'] == 1 ? __('Admin',true) : __('Sub-Admin',true);
		$_data['action'] = '';
		$data[] = $_data;
	}
	$columns = array(
		array(
			'id' => "no.", 
			'name' => __("Order",true), 
			'field' => "no.", 
			'width' => 70,
			'noFilter' => true,
			'cssClass' => 'divCenter',
			'sortable' => true
		),
		array(
			'id' => "name", 
			'name' => __("Name",true), 
			'field' => "name", 
			'width' => 320, 
			'sortable' => true,
			//'editor' => 'Slick.Editors.Text'
		),
		array(
			'id' => "email", 
			'name' => __("Email",true), 
			'field' => "email", 
			'width' => 240, 
			//'noFilter' => true,
			'sortable' => true,
			'formatter' => 'Slick.Formatters.HTMLData'
		),
		array(
			'id' => "active", 
			'name' => __("Active",true), 
			'field' => "active", 
			'width' => 80, 
			'noFilter' => true,
			'sortable' => true,
			'cssClass' => 'divCenter check',
			'formatter' => 'Slick.Formatters.HTMLData'
		),
		array(
			'id' => "role", 
			'name' => __("Role",true), 
			'field' => "role", 
			'width' => 80, 
			'noFilter' => true,
			'sortable' => true,
			'cssClass' => 'divCenter',
			'formatter' => 'Slick.Formatters.HTMLData'
		),
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
	$i18n = array();
?>
<div id="action-template" style="display: none;">
    <a class="btn btn-default btn-xs view" title="Edit" href="<?php echo $this->Html->url(array('action' => 'edit/%s')); ?>">
    <i class="glyphicon glyphicon-edit"></i></a>
    <a class="btn btn-default btn-xs" title="Edit" href="<?php echo $this->Html->url(array('action' => 'edit/%s')); ?>">
    <i class="glyphicon glyphicon-remove"></i></a>
</div>
<script type="text/javascript">
	(function($){   
        $(function(){
            var $this = SlickGridCustom;
			$this.i18n = <?php echo json_encode($i18n); ?>;
            var actionTemplate =  $('#action-template').html();
			$this.canModified =  true;
            $.extend(Slick.Formatters,{
                Action : function(row, cell, value, columnDef, dataContext){
                    return Slick.Formatters.HTMLData(row, cell,$this.t(actionTemplate,dataContext.id,
                    dataContext.name,dataContext.name), columnDef, dataContext);
                }
            });
            var  data = <?php echo json_encode($data); ?>;
            var  columns = <?php echo jsonParseOptions($columns, array('editor', 'formatter', 'validator')); ?>;
            
            $this.onCellChange = function(args){
                if(args.item && args.item.validated == ''){
                    args.item.validated = 'no'
                }
                return true;
            };
            $this.fields = {
                id : {defaulValue : 0},
				name : {defaulValue : ''}
            };
			
			$this.selectMaps = <?php echo json_encode($selectMaps); ?>;
            $this.url =  '<?php echo $this->Html->url(array('action' => 'update')); ?>';
            $this.init($('#dataviewContainer'),data,columns,{enableAddRow : false});
        });
    })(jQuery);
</script>   