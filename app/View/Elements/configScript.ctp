<script>
var loading = "<span id='loadingElm'><img src='<?php echo $this->Html->webroot('img/ajax-loader.gif'); ?>' alt='Loading' /></span>";
function showPass(elm)
{
	var $input = $('#'+elm);
	var change = $input.attr("type")=='password' ? "text" : "password";
	var id = $input.attr("id");
	var name = $input.attr("name");
	var classElm = $input.attr('class');
	var onchange = $input.attr('onchange');
	var value = $input.val();
	var rep = $("<input type='" + change + "' id='" + id + "' name='" + name + "' class='" + classElm + "' value='" + value + "' onchange=\"onchange\" />").insertBefore($input);
	$input.remove();
	$input = rep;
	$input.attr('onchange',onchange);
}
function editMe(field,value)
{
	//$(loading).insertAfter('#'+field);
	var data = field+'/'+value;
	$ajax('/configs/editMe/', { value : value, field : field });
}
function showMe(section)
{
	$('.section_cf').hide();
	$('#'+section).fadeIn();
	$('.head-title').removeClass('wd-current');
	$('#title_'+section).addClass('wd-current');
}
</script>