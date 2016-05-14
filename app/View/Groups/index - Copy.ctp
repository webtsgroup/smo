<?php
	echo $this->Html->css(array(
		'/js/SlickGrid/slick.grid',
	));
?>  
<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <h3><i class="fa fa-angle-right"></i> <?php echo __('Groups Control',true);?></h3>
    <div id="dataviewContainer" style="width:100%;height:500px;">></div>
</section>
</section><br clear="all"  /><br clear="all"  /><!-- /MAIN CONTENT -->

<?php
	echo $this->Html->script(array(
		'SlickGrid/lib/jquery-1.7.min.js',
		'SlickGrid/lib/jquery-ui-1.8.16.custom.min',
		'SlickGrid/lib/jquery.event.drag-2.2',
		'SlickGrid/slick.core',
		'SlickGrid/plugins/slick.cellrangedecorator',
		'SlickGrid/plugins/slick.cellrangeselector',
		'SlickGrid/plugins/slick.cellselectionmodel',
		'SlickGrid/slick.dataview',
		'SlickGrid/slick.formatters',
		'SlickGrid/slick.editors',
		'SlickGrid/slick.grid'
	));
	$data = array();
	foreach($groups as $i => $group)
	{
		$i++;
		$group = $group['Group'];
		$_data['id'] = $group['id'];
		$_data['no.'] = $i;
		$_data['name'] = $group['name'];
		$_data['control'] = $this->Html->link(__('View Member', true), array('controller' => 'members','action' => 'index', $i), array('class' => ''));
		//$_data['control'] = 'Link ' . $i;
		$editRow = $this->Html->link(__('Edit', true), array('javascript:;'), array('class' => 'editRow'));
		//$_data['action'] = $editRow.' | '.$this->Html->link(__('Delete', true), array('controller' => 'members','action' => 'index', $i), array('class' => ''),sprintf(__('Are you sure you want to delete "%1$s"?', true), $group['name']));
		//$_data['action'] = __('Edit', true).','.__('Delete', true);
		$_data['action'] = __('Delete', true);
		$data[] = $_data;
	}
	$columns = array(
		array(
			'id' => "no.", 
			'name' => __("Order",true), 
			'field' => "no.", 
			'width' => 50,
			'noFilter' => true,
			'sortable' => true
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
			'id' => "control", 
			'name' => __("Control",true), 
			'field' => "control", 
			'width' => 240, 
			'noFilter' => true,
			'sortable' => true,
			'formatter' => 'Slick.Formatters.HTMLData'
		),
		array(
			'id' => "action", 
			'name' => __("Action",true), 
			'field' => "action", 
			'width' => 240, 
			'noFilter' => true,
			'sortable' => true,
			'formatter' => 'Slick.Formatters.BtnControl'
		)
	);
	function jsonParseOptions($options, $safeKeys = array()) {
		$output = array();
		$safeKeys = array_flip($safeKeys);
		foreach ($options as $option) {
			$out = array();
			foreach ($option as $key => $value) {
				if (!is_int($value) && !isset($safeKeys[$key])) {
					$value = json_encode($value);
				}
				$out[] = $key . ':' . $value;
			}
			$output[] = implode(', ', $out);
		}
		return '[{' . implode('},{ ', $output) . '}]';
	}
?>
<style>
input{
	outline:none;
	border:none;
}
.slick-headerrow-column input{
	width:100%;
	border:1px solid #CCC;
	padding: 2px 5px;
}
.slick-cell input{
	width:100%;
}
</style>
<script type="text/javascript">
	var dataView,grid,
	data = [],
	columns = [],
	options = {
		//enableCellNavigation: false,
		//enableColumnReorder: false,
		enableCellNavigation: true,
		showHeaderRow: true,
		headerRowHeight: 30,
		explicitInitialization: true,
		editable: true,
		enableAddRow: true,
		enableCellNavigation: true,
		asyncEditorLoading: false,
		autoEdit: false,
		//editCommandHandler: queueAndExecuteCommand
	},
	columnFilters = {},
	numberOfItems = 250, items = [], indices, isAsc = true, currentSortCol = { }, i;
	columns =  <?php echo jsonParseOptions($columns, array('formatter','editor')); ?>;
	data = <?php echo json_encode($data); ?>;
	function filter(item) {
		for (var columnId in columnFilters) {
		  if (columnId !== undefined && columnFilters[columnId] !== "") {
			var c = grid.getColumns()[grid.getColumnIndex(columnId)];
			if (item[c.field] == null || item[c.field].toLowerCase().indexOf(columnFilters[columnId].toLowerCase()) == -1) {
				return false;
			}
			/*if (item[c.field] != columnFilters[columnId]) {
			  return false;
			}*/
		  }
		}
		return true;
  	}
	
	$(function () {
		dataView = new Slick.Data.DataView();
		grid = new Slick.Grid("#dataviewContainer", dataView, columns, options);
		
		//SORT COL
		grid.onSort.subscribe(function (e, args) {
			sortcol = args.sortCol.field;
			var cols = args.sortCols;
			dataView.sort(comparer, args.sortAsc);
			grid.invalidateAllRows();
			grid.render();
		});
		function comparer(a,b) {
			var x = a[sortcol], y = b[sortcol];
			return (x == y ? 0 : (x > y ? 1 : -1));
		}
		//END
		grid.url = '<?php echo $this->Html->url(array('action' => '')); ?>';
		grid.basicUrl = '<?php echo $this->Html->url(array('action' => '')); ?>';
		grid.feilds = {
			id : {defaulValue : 0},
			name : {defaulValue : 0},
			link : {defaulValue : 0}
		};
		//ON CHANGED
		grid.onCellChange.subscribe(function (e, args) {
			slickAction('update', args);
		});
		grid.onClick.subscribe( function (e, args) {
			if ($(e.target).hasClass("slickControl")) {
				deleteItem(e, args);
			}
		});
		//END
		var deleteItem = function(e, args)
		{
			var r = confirm("<?php echo __('Are you sure!', true); ?>");
			if (r == true) {
				var data = grid.getData().getItem(args.row);                   
				slickAction('delete', data);
			} else {
				//return false
			}	
		}
		var deleteItemAfterAjaxProcess = function(item){
			dataView.deleteItem(item);
			dataView.refresh();
			grid.init();
			grid.render();
		}
		var slickAction = function( act , data ){
			if(act != 'delete')
			{
				args = data;
				data = data.item;
				rowItem = data.row;
			}
			$.ajax({
				url : grid.basicUrl + '/' + act,
				cache : false,
				type : 'POST',
				dataType : 'json',
				data : data,
				beforeSend : function(){
					//setCss('disabled');
					//$cell.addClass('loading');
				},
				success : function(results){
					//parseResult(data);
					if(act == 'delete' && results.success == true)
					{
						deleteItemAfterAjaxProcess(results.data.id);
					}
				},
				error : function(){
					/*parseResult({
						result : false,
						message : $this.defaultMessage,
						data : { }
					});*/
				}
			});
		}
		grid.onHeaderRowCellRendered.subscribe(function(e, args) {
			$(args.node).empty();
			$("<input type='text'>")
			   .data("columnId", args.column.id)
			   .val(columnFilters[args.column.id])
			   .appendTo(args.node);
		});
		
		dataView.onRowCountChanged.subscribe(function (e, args) {
		  grid.updateRowCount();
		  grid.render();
		});
		
		dataView.onRowsChanged.subscribe(function (e, args) {
		  grid.invalidateRows(args.rows);
		  grid.render();
		});
	
	
		$(grid.getHeaderRow()).delegate(":input", "change keyup", function (e) {
			var columnId = $(this).data("columnId");
			if (columnId != null) {
				columnFilters[columnId] = $.trim($(this).val());
				dataView.refresh();
			}
		});
	
		grid.onHeaderRowCellRendered.subscribe(function(e, args) {
			$(args.node).empty();
			$("<input type='text'>")
			   .data("columnId", args.column.id)
			   .val(columnFilters[args.column.id])
			   .appendTo(args.node);
		});
		
		grid.setSelectionModel(new Slick.CellSelectionModel());
		grid.onAddNewRow.subscribe(function (e, args) {
			var item = args.item;
			item.id = 0;
			item.action = '<?php echo __('Delete', true); ?>';
			grid.invalidateRow(dataView.getItems().length);
			dataView.addItem(item);
			grid.updateRowCount();
			grid.render();
			args.grid._args =  args;
			args.grid.eval('trigger(self.onCellChange, {row: activeRow,cell: activeCell,item: self._args.item});');
		});
		
		grid.init();
		dataView.beginUpdate();
		dataView.setItems(data);
		dataView.setFilter(filter);
		dataView.endUpdate();
	});
</script>   