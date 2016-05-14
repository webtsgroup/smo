<script type="text/javascript" >
var hHead = $('.header').height();
var hWindow = $(window).height();
var hContainer = hWindow - hHead - 150;
$('#dataviewContainer').height(hContainer);
</script>
<?php
	echo $this->Html->css(array(
		'/js/SlickGrid/slick.grid',
	));
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
		'SlickGrid/slick.grid.custom',
	));
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