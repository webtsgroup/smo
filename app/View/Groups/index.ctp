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
        <h3 class="box-title"><i class="glyphicon glyphicon-list"></i> <?php echo __('Groups Control',true);?>
        <div class="pull pull-right">
        	<a class="btn btn-sm btn-success" href="javascript:;" onclick="addNew();" >
        	<i class="fa fa-user"></i> <?php echo __('Add new',true);?></a>
            <a class="btn btn-sm btn-default" href="<?php echo $this->Html->url(array('controller' => 'members','action' => 'index')); ?>" >
            <i class="fa fa-users"></i> 
            <?php echo __('Members',true);?></a>
        </div>
        </h3>
    </div>
    </div>
    </div>
    </div>
    <div id="dataviewContainer" style="width:100%;"></div>
</section>
</section><!-- /MAIN CONTENT -->

<?php
	echo $this->element('includeSlickGrid');
	$data = array();
	foreach($results as $i => $group)
	{
		$i++;
		$group = $group['Group'];
		$_data['id'] = $group['id'];
		$_data['no.'] = $i;
		$_data['name'] = $group['name'];
		$str = '<i class="fa fa-check-square-o"></i>';
		$_data['default'] = $group['default'] == 1 ? $str : '';
		$_data['action'] = '';
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
			'formatter' => 'Slick.Formatters.Order'
		),
		array(
			'id' => "name", 
			'name' => __("Name",true), 
			'field' => "name", 
			'width' => 240, 
			'sortable' => true,
			'editor' => 'Slick.Editors.Text'
		),
		array(
			'id' => "default", 
			'name' => __("Default",true), 
			'field' => "default", 
			'width' => 80, 
			'noFilter' => true,
			'sortable' => true,
			'cssClass' => 'divCenter check',
			'formatter' => 'Slick.Formatters.HTMLData'
		),
		array(
			'id' => "action", 
			'name' => __("Action",true), 
			'field' => "action", 
			'width' => 100, 
			'noFilter' => true,
			'sortable' => true,
			'cssClass' => 'divCenter',
			'formatter' => 'Slick.Formatters.Action'
		)
	);
	$selectMaps = array(
		'validated' => array("no" => __('No', true), "yes"=>__('Yes', true))
	);

?>
<div id="action-template" style="display: none;">
	<a class="btn btn-default btn-xs view" title="<?php echo __('View Members',true);?>" href="<?php echo $this->Html->url(array('controller' => 'members','action' => 'index/%s')); ?>">
    <i class="fa fa-user"></i></a>
    <a class="btn btn-default btn-xs view" role="editItem" title="<?php echo __('Edits',true);?>" href="javascript:;">
    <i class="glyphicon glyphicon-edit" role="editItem"></i></a>
    <a class="btn btn-default btn-xs" role="deleteItem" title="<?php echo __('Delete',true);?>" href="javascript:;">
    <i class="glyphicon glyphicon-remove" role="deleteItem"></i></a>
</div>
<script type="text/javascript">
	(function($){   
        $(function(){
            var $this = SlickGridCustom;
            var actionTemplate =  $('#action-template').html();
			$this.canModified =  true;
            $.extend(Slick.Formatters,{
                Action : function(row, cell, value, columnDef, dataContext){
                    return Slick.Formatters.HTMLData(row, cell,$this.t(actionTemplate,dataContext.id), columnDef, dataContext);
                },
				Order : function(row, cell, value, columnDef, dataContext){
                    return Slick.Formatters.HTMLData(row, cell,dataContext.id, columnDef, dataContext);
                }
            });
			
            var  data = <?php echo json_encode($data); ?>;
            var  columns = <?php echo jsonParseOptions($columns, array('editor', 'formatter', 'validator')); ?>;
           
            /*$this.onCellChange = function(args){
                if(args.item && args.item.validated == ''){
                    args.item.validated = 'no'
                }
                return true;
            };*/
            $this.fields = {
				no : {defaulValue : 0},
                id : {defaulValue : 0},
				name : {defaulValue : ''},
				control : {defaulValue : ''}
            };
			
			$this.selectMaps = <?php echo json_encode($selectMaps); ?>;
            $this.url =  '<?php echo $this->Html->url(array('action' => 'update')); ?>';
            var gridControl = $this.init($('#dataviewContainer'),data,columns);
			addNew = function(){
                gridControl.gotoCell(data.length, 1, true);
            }
        });
    })(jQuery);
</script>   