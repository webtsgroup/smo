    <?php
    echo $this->Html->script(array(
		'calendar/jquery-ui',
		'jquery.form'
	));
	 echo $this->Html->css(array(
		'/js/calendar/jquery-ui',
	));
	?>
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-list-alt"></i> <?php echo __('Add new Template',true);?>
            <div class="pull pull-right">
                <a class="btn btn-sm btn-default" href="<?php echo $this->Html->url(array('action' => '/')); ?>" >
                <i class="glyphicon glyphicon-th-list"></i> 
                <?php echo __('Account Lists',true);?></a>
            </div>
        </h3>
          	<div class="box">
            <div class="box-content">
                <div class="tab-content border paddingTop20">
                	<div class="col-md-12 form-horizontal">
                    
                        <form id="addTemplate" class="">
                          <div class="form-group has-feedback">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Template Name',true); ?></label>
                            <div class="col-sm-8">
                              <?php
								echo $this->Form->input(
									'name',
									array(
										'name' => 'name',
										'required' => 'required',
										'title' => __('Enter the Name'),
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm input-error',
										'default' => &$result['name'],
										'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
									)
								);
								echo $this->Form->input(
									'thumbnail',
									array(
										'type' => 'hidden',
										'name' => 'thumbnail',
										'required' => 'required',
										'title' => __('Select thumbnail'),
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm',
										'default' => &$result['thumbnail'],
										'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
									)
								);
								echo $this->Form->input(
									'file',
									array(
										'type' => 'hidden',
										'name' => 'file',
										'required' => 'required',
										'title' => __('Select file'),
										'div' => false,
										'label' => false,
										'class' => 'form-control input-sm',
										'default' => &$result['file'],
										'onchange' => isset($onchange) && $onchange != '' ? $onchange : '',
									)
								);
								?>  
                                 <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>                          
                              </div>
                          </div>
                          </form>
                          <div class="form-group">
                          	<label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Template File',true); ?></label>
                            <div class="col-sm-8">
                            	<p id="result-file"></p>

                                <div id="upload-file" class="progress">
                                  <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%">
                                  0%</div>
                                </div>
                                
                                <form id="form-upload-file" class="form-horizontal" method="post" action="/ajaxs/upload" enctype="multipart/form-data">
                                    <input type="file" id="select-file" onchange="return submitTheForm('form-upload-file');" class="input-file" name="file_tmp" />
                                    <input type="hidden" name="data[root]" value="template"/>
                                    <input type="hidden" name="data[model]" value="Template"/>
                                    <input type="hidden" name="data[field]" value="file"/>
                                    <input type="hidden" name="data[allow]" value="html"/>
                                    <input type="hidden"  name="id" value="<?php echo isset($id) && $id != '' ? $id : 0; ?>"/>
                                </form>
                                <div class="clearfix"></div>
                            </div>
                         </div>
                          <div class="form-group">
                          	<label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Template Image',true); ?></label>
                            <div class="col-sm-2">
                            	<?php $src = isset($template['img']) ? $template['img'] : $this->Html->url('/img/not-found.png'); ?>
                                <img id="result-thumb" class="img-ajax-upload" alt="<?php echo __('Template Image',true); ?>" src="<?php echo $src; ?>"  />
                            </div>
                            <div class="col-sm-6">
                            <div id="upload-thumb" class="progress">
                              <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%">
                              0%</div>
                            </div>
                            
                            <form id="form-upload-thumb" class="form-horizontal" method="post" action="/ajaxs/upload" enctype="multipart/form-data">
                                <input type="file" id="select-thumb" onchange="return submitTheForm('form-upload-thumb');" class="input-file" name="file_tmp" />
                                <input type="hidden" name="data[root]" value="template/thumbnail"/>
                                <input type="hidden" name="data[model]" value="Template"/>
                                <input type="hidden" name="data[field]" value="thumbnail"/>
                                <input type="hidden" name="data[allow]" value="jpg,jpeg,gif"/>
                               	<input type="hidden" name="data[id]" value="<?php echo isset($id) && $id != '' ? $id : ''; ?>"/>
                            </form>
                            <div class="clearfix"></div>
                            </div>
                            
                         </div>
    					
                         <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-4">
                              
                            <button type="submit" onclick="addNewTemplate('addTemplate','/templates/add');" class="btn btn-primary">
							<?php echo __('Save',true); ?></button>
                            </div>
                          </div>
                        
                        
                    </div>
                    <br clear="all"  />
                </div>
             </div>
             </div>
             
             
             <!---------POPUP AJAX UPLOAD--------------->
                
             <!---------END----------------------------->
		</section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->
      <script type="text/javascript">
	  		var upload_dir = '<?php echo $this->webroot.'uploads'; ?>';
		 var bar = $('#upload-thumb .progress-bar');
		  var percent = $('#upload-thumb .progress-bar');
		  var result = $('#result-thumb');
		  var percentValue = "0%";
		  function submitTheForm(form)
		  {
			  $('#'+form).submit();
		  }
		  $('#form-upload-thumb').ajaxForm({
			  // Do something before uploading
			  beforeUpload: function() {
				result.empty();
				percentValue = "0%";
				bar.width(percentValue);
				percent.html(percentValue);
			  },		 
			  // Do somthing while uploading
			  uploadProgress: function(event, position, total, percentComplete) {
				var percentValue = percentComplete + '%';
				bar.width(percentValue)
				percent.html(percentValue);
			  },		 
			  // Do something while uploading file finish
			  success: function() {
				var percentValue = '100%';
				bar.width(percentValue)
				percent.html(percentValue);
			  },
			  // Add response text to div #result when uploading complete
			  complete: function(xhr) {   
			  	var data = JSON.parse(xhr.responseText);  
				if(data.success)
				{   
					result.attr('src',upload_dir+'/'+data.folder+data.src);
					$('#thumbnail').val(data.src);
				}
				else
				{
					
				}
				percentValue = "0%";
				bar.width(percentValue);
				percent.html(percentValue);
				$('#select-thumb').val('');
			  }
		  }); 
		  
		  var bar1 = $('#upload-file .progress-bar');
		  var percent1 = $('#upload-file .progress-bar');
		  var result1 = $('#result-file');
		  var percentValue1 = "0%";
		  $('#form-upload-file').ajaxForm({
			  // Do something before uploading
			  beforeUpload: function() {
				result1.empty();
				percentValue1 = "0%";
				bar1.width(percentValue1);
				percent1.html(percentValue1);
			  },		 
			  // Do somthing while uploading
			  uploadProgress: function(event, position, total, percentComplete) {
				var percentValue = percentComplete + '%';
				bar1.width(percentValue)
				percent1.html(percentValue);
			  },		 
			  // Do something while uploading file finish
			  success: function() {
				var percentValue = '100%';
				bar1.width(percentValue)
				percent1.html(percentValue);
			  },
			  // Add response text to div #result when uploading complete
			  complete: function(xhr) { 
			  	var data = JSON.parse(xhr.responseText);  
				if(data.success)
				{
					$('#file').val(data.src);
					result1.html(upload_dir+'/'+data.folder+data.src);	
				}
				else
				{
					result1.html(data.msg);
				}
				percentValue1 = "0%";
				bar1.width(percentValue1);
				percent1.html(percentValue1);
				$('#select-file').val('');
			  }
		  }); 
		</script>