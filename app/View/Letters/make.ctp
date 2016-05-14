<?php
    echo $this->Html->script(array(
		'calendar/jquery-ui',
		'/ckeditor/ckeditor',
		'/ckeditor/adapter.ckeditor'
		//'jQuery.slider/elastislide/js/jquery.elastislide', //js template
		//'jQuery.slider/elastislide/js/gallery' //js template
	));
	 echo $this->Html->css(array(
		'/js/calendar/jquery-ui',
		'/js/jQuery.slider/elastislide/css/elastislide', //style template
		'/js/jQuery.slider/elastislide/css/custom'
	));
?>
<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <h3><i class="fa fa-pencil-square"></i> <?php echo __('Make Newsletters',true);?>
    <div class="pull pull-right">
    	<a class="btn btn-sm btn-default" href="<?php echo $this->Html->url(array('action' => 'index')); ?>" >
        <i class="fa fa-envelope"></i><?php echo __('Newletters',true);?></a>
    </div></h3>
    <div class="box">
    	<div class="box-content">
        	<div class="border paddingTop20 clearfix">
            	<div class="col-md-12 clearfix">
                <form id="makeNewsletter" class="form-horizontal">
                    <div class="form-group has-feedback clearfix">
                    	<label for="inputEmail3" class="col-sm-2 control-label"><?php echo __('Group',true); ?></label>
                        <div class="col-sm-4">
                            <?php
                            echo $this->Form->input('group_id',array(
                                    'options' => $groups,
                                    'name' => 'group_id',
                                    'div' => false,
                                    'label' => false,
                                    'class' => 'form-control input-sm',
                                    //'default' => &$result['group_id'],
                                    //'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
                                )
                            );
                            ?> 
                        </div> 
                    </div>
                    <div class="form-group has-feedback">
                        <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Subject',true); ?></label>
                        <div class="col-sm-10">
                          <?php
                            echo $this->Form->input(
                                'subject',
                                array(
                                    'name' => 'subject',
									'required' => 'required',
									'title' => __('Enter the Subject',true),  
                                    'div' => false,
                                    'label' => false,
                                    'class' => 'form-control input-sm input-error',
                                    //'default' => &$result['subject'],
                                    //'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
                                )
                            );
                            ?>  
                             <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>                          
                          </div>
                      </div>
                      <div class="form-group has-feedback">
                        <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Content',true); ?></label>
                        <div class="col-sm-10">
                          <?php
                            echo $this->Form->input(
                                'newsletter',
                                array(
									'type' => 'textarea',
                                    'name' => 'newsletter',
									'required' => 'required',
									'title' => __('Enter the Content',true),
                                    'div' => false,
                                    'label' => false,
                                    'class' => 'form-control input-sm input-error',
                                    //'default' => &$result['subject'],
                                    //'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
                                )
                            );
                            ?>  
                             <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>                          
                          </div>
                      </div>
                      <div class="form-group has-feedback clearfix">
                    	<label for="inputEmail3" class="col-sm-2 control-label"><?php echo __('Template',true); ?></label>
                        <div class="col-sm-10">
                        <div class="fixed-bar">
					<!-- Elastislide Carousel -->
                    <?php
					if(!empty($templates))
					{
						?>
                        <ul id="carousel" class="elastislide-list">
                        <?php
						foreach($templates as $_item)
						{ ?>
                        	<li><a href="javascript:;" onclick="selectTemplate('<?php echo $this->Html->url(array('controller' => 'templates','action' => 'preview' . '/' . $_item['id']));?>');">
                            <img src="/uploads/<?php echo $_item['thumbnail'];?>" alt="<?php echo $_item['name'];?>" /></a></li>
						<?php } ?>
                        </ul>
                        <?php
					}?>
					<!-- End Elastislide Carousel -->
				</div>
                            <?php
							/*
                            $option = array(
                                '1' => 'Template 1', '2' => 'Template 2'
                            );
                            echo $this->Form->input('template_id',array(
                                    'options' => $option,
                                    'name' => 'template_id',
                                    'div' => false,
                                    'label' => false,
                                    'class' => 'form-control input-sm',
                                    //'default' => &$result['group_id'],
                                    //'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
                                )
                            );
							*/
                            ?> 
                        </div> 
                    </div>
                    <div class="form-group  has-feedback">
                        <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Date Send',true); ?></label>
                        <div class="col-sm-4">                            
                          <?php
                            echo $this->Form->input(
                                'send_date',
                                array(
                                    'name' => 'send_date',
                                    'rel' => 'date',
                                    'div' => false,
                                    'label' => false,
                                    'class' => 'form-control input-sm datepicker',
                                    //'default' => &$result['date_init'],
                                    //'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
                                )
                            );
                            ?> 
                            <span class="glyphicon glyphicon-calendar form-control-feedback" aria-hidden="true"></span> 
                        </div>
                      </div>
                       <div class="form-group has-feedback">
                        <label for="inputPassword3" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                          <?php
						  	$options = array(
								'100' => __('Send Now'),
								'0' => __('Schedule Send'),
								'1' => __('Period Send')
							);
                            echo $this->Form->input(
                                'send_type',
                                array(
									'legend' => false,
									'type' => 'radio',
                                    'name' => 'send_type',
                                    'div' => false,
								    'default' => 100,
									'selected' => 100,
									'options' => $options
                                )
                            );
                            ?>                        
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label"></label>
                        <div class="col-sm-4">        
                        <button type="button" onclick="previewNewsletter();" class="btn btn-success ">
                        <i class="fa fa-arrow-circle-right"></i><?php echo __('Preview',true); ?></button>
                        <button type="button" onclick="makeNewsletter('makeNewsletter','/letters/make');" class="btn btn-primary">
						<i class="fa fa-send"></i><?php echo __('Send',true); ?></button>
                        </div>
                      </div>
                </form>
    			</div>
    		</div>
    	</div>
    </div>
</section>
</section>

<?php
 	echo $this->Html->script(array(
		'jQuery.slider/elastislide/js/modernizr.custom.17475', 
		'jQuery.slider/elastislide/js/jquerypp.custom', //js template
		'jQuery.slider/elastislide/js/jquery.elastislide', //js template
		//'jQuery.slider/elastislide/js/gallery' //js template
	));
?>
<script>
	function selectTemplate(url)
	{
		$.get(url, function( html ) {
			$('#myModal .modal-dialog').addClass('modal-lg');
		  showNotify( html );
		});
	}
	jQuery(document).ready(function ($){
		$('#newsletter').ckeditor();
		$(".datepicker").datepicker(
		{
			changeMonth:true,
			changeYear:true,
			minDate: +0,
			dateFormat:'dd-mm-yy'
		});
		$( '#carousel' ).elastislide( {
			minItems : 2
		} );
	});
</script>


