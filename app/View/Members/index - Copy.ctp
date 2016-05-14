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
    <h3><i class="fa fa-angle-right"></i> <?php echo __('Member Lists',true);?></h3>
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
		'SlickGrid/slick.grid',
		'SlickGrid/slick.grid.custome'
	));
	$data = array();
	foreach($results as $i => $_data)
	{
		$i++;
		$_data = $_data['Member'];
		$_data['id'] = $_data['id'];
		$_data['no.'] = $i;
		$_data['fisrt_name'] = $_data['fisrt_name'];
		$_data['last_name'] = $_data['last_name'];
		$_data['location'] = $_data['location'];
		$_data['group'] = $_data['group'];
		//$_data['control'] = 'Link ' . $i;
		$editRow = $this->Html->link(__('Edit', true), array('javascript:;'), array('class' => 'editRow'));
		$_data['action'] = $editRow.' | '.$this->Html->link(__('Delete', true), array('controller' => 'members','action' => 'index', $i), array('class' => ''),sprintf(__('Are you sure you want to delete "%1$s"?', true), $_data['name']));
		$data[] = $_data;
	}
	$columns = array(
		array(
			'id' => "no.", 
			'name' => __("Order",true), 
			'field' => "no.", 
			'width' => 50,
			'sortable' => true
		),
		array(
			'id' => "email", 
			'name' => __("Email",true), 
			'field' => "email", 
			'width' => 240, 
			'sortable' => true,
			'editor' => 'Slick.Editors.Text'
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
			'editor' => 'Slick.Editors.Text'
		),
		array(
			'id' => "location", 
			'name' => __("Location",true), 
			'field' => "location", 
			'width' => 240, 
			'sortable' => true,
			'formatter' => 'Slick.Editors.Text'
		),
		array(
			'id' => "action", 
			'name' => __("Action",true), 
			'field' => "action", 
			'width' => 240, 
			'sortable' => true,
			'formatter' => 'Slick.Formatters.HTMLData'
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
		grid.url = '<?php echo $this->Html->url(array('action' => 'update')); ?>';
		grid.feilds = {
			id : {defaulValue : 0},
			name : {defaulValue : 0},
			link : {defaulValue : 0}
		};
		//ON CHANGED
		grid.onCellChange.subscribe(function (e, args) {
			$.post(grid.url, args.item);
		});
		grid.onClick.subscribe( function (e, args) {
			if ($(e.target).hasClass("editRow")) {
			}
		});
		//END
		
			
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