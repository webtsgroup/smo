<?php echo $html->css('jquery.multiSelect'); ?>
<?php echo $html->css('projects'); ?>
<?php echo $html->css('slick_grid/slick.grid'); ?>
<?php echo $html->css('slick_grid/slick.pager'); ?>
<?php echo $html->css('slick_grid/slick.common'); ?>
<?php echo $html->css('slick_grid/slick.edit'); ?>
<?php echo $html->script('history_filter'); ?>
<?php echo $html->script('jquery.multiSelect'); ?>

<script type="text/javascript">
    HistoryFilter.here =  '<?php echo $this->params['url']['url'] ?>';
    HistoryFilter.url =  '<?php echo $this->Html->url(array('controller' => 'employees', 'action' => 'history_filter')); ?>';
</script>
<style>
    .slick-cell .multiSelect {width: auto; display: block;overflow: hidden; text-overflow: ellipsis;}
</style>
<!-- export excel  -->
<fieldset style="display: none;">
    <?php
    echo $this->Form->create('Export', array(
        'type' => 'POST',
        'url' => array('controller' => 'project_milestones', 'action' => 'export', $projectName['Project']['id'])));
    echo $this->Form->input('list', array('type' => 'text', 'value' => '', 'id' => 'export-item-list'));
    echo $this->Form->end();
    ?>
</fieldset>
<!-- /export excel  -->
<div id="wd-container-main" class="wd-project-admin">
    <?php echo $this->element("project_top_menu") ?>
    <div class="wd-layout">
        <div class="wd-main-content">
            <div class="wd-list-project">
                <div class="wd-title">
                    <h2 class="wd-t1"><?php echo sprintf(__("%s", true), $projectName['Project']['project_name']); ?></h2>	
                    <a href="javascript:void(0);" class="export-excel-icon-all" id="export-submit" style="margin-right:5px; " title="<?php __('Export Excel')?>"><span><?php __('Export Excel') ?></span></a>	             
                    <a href="<?php echo $html->url("/project_phase_plans/phase_vision/" . $projectName['Project']['id']) ?>" class="wd-add-project" style="margin-right:5px; "><span><?php __('Gantt+') ?></span></a>
                </div>
                <div id="message-place">
                    <?php
                    App::import("vendor", "str_utility");
                    $str_utility = new str_utility();
                    echo $this->Session->flash();
                    ?>
                </div>
                <div class="wd-table" id="project_container" style="width:100%;height:400px;">

                </div>
                <div id="pager" style="width:100%;height:36px; overflow: hidden;">

                </div>
            </div>
            <?php echo $this->element('grid_status'); ?>
        </div>
    </div>
</div>
<?php echo $this->element('dialog_projects') ?>
<?php echo $html->script('slick_grid/lib/jquery-ui-1.8.16.custom.min'); ?>
<?php echo $html->script('slick_grid/lib/jquery.event.drag-2.0.min'); ?>
<?php echo $html->script('slick_grid/slick.core'); ?>
<?php echo $html->script('slick_grid/slick.dataview'); ?>
<?php echo $html->script('slick_grid/controls/slick.pager'); ?>
<?php echo $html->script('slick_grid/slick.formatters'); ?>
<?php echo $html->script('slick_grid/plugins/slick.cellrangedecorator'); ?>
<?php echo $html->script('slick_grid/plugins/slick.cellrangeselector'); ?>
<?php echo $html->script('slick_grid/plugins/slick.cellselectionmodel'); ?>
<?php echo $html->script('slick_grid/slick.editors'); ?>
<?php echo $html->script('slick_grid/slick.grid'); ?>
<?php echo $html->script(array('slick_grid_custom')); ?>
<?php

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

$columns = array(
    array(
        'id' => 'no.',
        'field' => 'no.',
        'name' => '#',
        'width' => 40,
        'sortable' => true,
        'resizable' => false,
        'noFilter' => 1,
        //'formatter' => 'Slick.Formatters.ColorMile'
    ),
    array(
        'id' => 'project_milestone',
        'field' => 'project_milestone',
        'name' => __('Milestone', true),
        'width' => 250,
        'sortable' => true,
        'resizable' => true,
        'editor' => 'Slick.Editors.textBox',
        //'formatter' => 'Slick.Formatters.ColorMile'
    ),
    array(
        'id' => 'milestone_date',
        'field' => 'milestone_date',
        'name' => __('Date', true),
        'width' => 150,
        'sortable' => true,
        'resizable' => true,
        'editor' => 'Slick.Editors.datePicker',
        //'validator' => 'DateValidate.startDate',
        //'formatter' => 'Slick.Formatters.ColorMile'
    ),
    array(
        'id' => 'validated',
        'field' => 'validated',
        'name' => __('Validated', true),
        'width' => 150,
        'sortable' => true,
        'resizable' => true,
        'editor' => 'Slick.Editors.selectBox',
        //'formatter' => 'Slick.Formatters.ColorMile'
    ),
    array(
        'id' => 'action.',
        'field' => 'action.',
        'name' => __('Action', true),
        'width' => 70,
        'sortable' => false,
        'resizable' => true,
        'noFilter' => 1,
        'formatter' => 'Slick.Formatters.Action'
        ));
$i = 1;
$dataView = array();
$selectMaps = array(
    'validated' => array("no" => __('No', true), "yes"=>__('Yes', true))
);
foreach ($projectMilestones as $projectMilestone) {
    $data = array(
        'id' => $projectMilestone['ProjectMilestone']['id'],
        'project_id' => $projectName['Project']['id'],
        'no.' => $i++
    );
    $data['project_milestone'] = $projectMilestone['ProjectMilestone']['project_milestone'];
    $data['milestone_date'] = $str_utility->convertToVNDate($projectMilestone['ProjectMilestone']['milestone_date']);
    $data['validated'] = $projectMilestone['ProjectMilestone']['validated'] ? 'yes' : 'no';
    $data['action.'] = '';

    $dataView[] = $data;
}

$projectName['Project']['start_date'] = $str_utility->convertToVNDate($projectName['Project']['start_date']);
$projectName['Project']['end_date'] = $str_utility->convertToVNDate($projectName['Project']['end_date']);
if ($projectName['Project']['end_date'] == "" || $projectName['Project']['end_date'] == '0000-00-00') {
    $projectName['Project']['end_date'] = $str_utility->convertToVNDate($projectName['Project']['planed_end_date']);
}

$i18n = array(
    '-- Any --' => __('-- Any --', true),
    'This information is not blank!' => __('This information is not blank!', true),
    'Clear' => __('Clear', true),
    'Milestone date must between %s and %s' => __('Milestone date must between %s and %s', true)
);
?>
<div id="action-template" style="display: none;">
    <div style="margin: 0 auto !important; width: 54px;">
        <div class="wd-bt-big">
            <a onclick="return confirm('<?php echo h(sprintf(__('Are you sure you want to delete "%s"?', true), '%3$s')); ?>');" class="wd-hover-advance-tooltip" href="<?php echo $this->Html->url(array('action' => 'delete', '%1$s', '%2$s')); ?>">Delete</a>
        </div>
    </div>
</div>
<script type="text/javascript">
    var DateValidate = {};
    (function($){
        
        $(function(){
            var $this = SlickGridCustom;
            $this.i18n = <?php echo json_encode($i18n); ?>;
            $this.canModified =  <?php echo json_encode(!empty($canModified)); ?>;
            // For validate date
            var projectName = <?php echo json_encode($projectName['Project']); ?>;
            var getTime = function(value){
                value = value.split("-");
                return (new Date(parseInt(value[2] ,10), parseInt(value[1], 10), parseInt(value[0], 10))).getTime();
            }
        
            DateValidate.startDate = function(value){
                value = getTime(value);
                if(projectName['start_date'] == ''){
                    _valid = true;
                    _message = '';
                    //_message = $this.t('Start-Date or End-Date of Project are missing. Please input these data before full-field this date-time field.');
                } else {
                    //_valid = value >= getTime(projectName['start_date']) && value <= getTime(projectName['end_date']);
                    //_message = $this.t('Date closing must between %1$s and %2$s' ,projectName['start_date'], projectName['end_date']);
                    _valid = value >= getTime(projectName['start_date']);
                    _message = $this.t('Milestone date must larger %1$s' ,projectName['start_date']);
                }
                return {
                    valid : _valid,
                    message : _message
                };
            }
            var actionTemplate =  $('#action-template').html();
            $.extend(Slick.Formatters,{
                Action : function(row, cell, value, columnDef, dataContext){
                    return Slick.Formatters.HTMLData(row, cell,$this.t(actionTemplate,dataContext.id,
                    dataContext.project_id,dataContext.project_milestone), columnDef, dataContext);
                },
                ColorMile : function(row, cell, value, columnDef, dataContext){
                    var rightnow = new Date();
                    var dateConvert = dataContext.milestone_date.split("-");
                    var dateCheck = new Date(dateConvert[2]+'-'+dateConvert[1]+'-'+dateConvert[0]);
                    if((dateCheck<rightnow)&&(dataContext.validated=='no')){
                        if(columnDef.id == 'validated'){
                            return '<span style="color: blue;">' + $this.selectMaps.validated[value] + '</span>';
                        }
                        return '<span style="color: blue;">' + value + '</span>';
                    }
                    if((dateCheck>=rightnow)&&(dataContext.validated=='no')){
                        if(columnDef.id == 'validated'){
                            return '<span style="color: red;">' + $this.selectMaps.validated[value] + '</span>';
                        }
                        return '<span style="color: red;">' + value + '</span>';
                    }
                    if(dataContext.validated=='yes'){
                        if(columnDef.id == 'validated'){
                            return '<span style="color: green;">' + $this.selectMaps.validated[value] + '</span>';
                        }
                        return '<span style="color: green;">' + value + '</span>';
                    }
                }
            });
            var  data = <?php echo json_encode($dataView); ?>;
            var  columns = <?php echo jsonParseOptions($columns, array('editor', 'formatter', 'validator')); ?>;
            $this.selectMaps = <?php echo json_encode($selectMaps); ?>;
            $this.onCellChange = function(args){
                if(args.item && args.item.validated == ''){
                    args.item.validated = 'no'
                }
                return true;
            };
            $this.fields = {
                id : {defaulValue : 0},
                project_id : {defaulValue : projectName['id'], allowEmpty : false},
                project_milestone : {defaulValue : '' , allowEmpty : false},
                milestone_date : {defaulValue : '', allowEmpty : false},
                validated : {defaulValue : ''}
            };
            $this.url =  '<?php echo $html->url(array('action' => 'update')); ?>';
            $this.init($('#project_container'),data,columns);
        });

    })(jQuery);
</script>