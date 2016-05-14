function validatorFormData(form)
{
	var formData = {};
	var error = false;
	var arr = $("form#"+form).serializeArray();
	$.each(arr,function(index,val){
		var id = val.name ;
		var required = $('#'+id).attr('required');
		var msg = $('#'+id).attr('title');
		msg = typeof msg == 'undefined' ? 'Data invalid' : msg ;
		if(val.value == '' && required == 'required')
		{
			error = true;
			showNotify(msg);
			return false
		}
		formData[val.name] = val.value;
	});	
	$("form#"+form+" input:checkbox").each(function(){
        formData[this.name] = this.checked === true ? 1 : 0;
    });
	return {data : formData, error : error} ;
}
function makeNewsletter(form,url)
{
	var formData = validatorFormData(form);
	if(!formData.error) { $ajax(url, formData.data);  }
}
function addNewTemplate(form,url)
{
	var formData = validatorFormData(form);
	if(!formData.error) { $ajax(url, formData.data);  }
}
function addNewAccount(url)
{
	var formData = validatorFormData('addAccount');
	if(!formData.error) {
		if(!validateEmail(formData.data['email']))
		{
			showNotify('Email invalid');
			return;
		}
		$ajax(url, formData.data); 
	}
}
function addNewUser(url)
{	
	var formData = validatorFormData('addAccount');
	if(!formData.error) {
		if(!validateEmail(formData.data['email']))
		{
			showNotify('Email invalid');
			return;
		}
		$ajax(url, formData.data); 
	}
}
function updateField(model,id,field,value)
{	
	var elm = $('#'+field);
	if(elm.attr('rel') == 'date')
	{
		var arr = value.split("-");
		var date = arr[1]+"/"+arr[0]+"/"+arr[2];
		console.log(date);
		date = new Date(date);
		console.log(date);
		value = date.getTime();
		console.log(value);
		var c = new Date();
		c = c.getTime();
		value = c - value;
	}
	$.ajax({
		url  : '/ajaxs/updateField',
		type : 'POST',
		data : {
			data : {model : model , id : id, field : field, value : value}
		},
		dataType : 'json',
		success: function(data)
		{
			showNotify(data.message,true);
		}
	});
}
function changePass(url)
{
	var error = 0;
	var arr = ['old_pass', 'pass','re_pass'];
	var formData = {};
	$.each(arr,function(index,elm){
		var val = $('#'+elm).val();
		if( val == '')
		{
			showNotify('Insert '+elm);
			error++;
		}
		formData[elm] = val;
	});	
	if(error == 0)	{		
		if($ajax(url, formData, false)) 
		{
			$.each(arr,function(index,elm){
				$('#'+elm).val('');
			});	
			showBoxChangePass();
		}
	}
}
function setModalAttr(title,html,btn)
{
	if(title != '')
	{
		$('.modal-title').text(title);
	}
	if(html != '')
	{
		$("#myModal #showResult").html(html);
	}
	if(btn != '')
	{
		$(btn).insertAfter('#btnCancelModal');
	}
}
function showBoxChangePass()
{
	$('.elm-hide').toggle();
}
function showNotify(text,hide)
{
	$("#showResult").show();
	$("#showResult").html(text);
	$("#myModal").modal();
	if(hide == true)
	{
		setTimeout(function(){$('#myModal').modal('hide')},1000);
	}
}
function alertMsg(text,cls)
{
	$("#showResult").attr('class','');
	$("#showResult").addClass(cls);
	$("#showResult").html(text);
	$("#showResult").fadeIn();
}
<!---login------------>
function login(url)
{
	var email = jQuery('#email').val();
	if(email=='')
	{
		alertMsg('Enter the email','text-danger');
		jQuery('#email').focus();
		return false;
	}
	if(!validateEmail(email))
	{
		alertMsg('Enter invalid','text-danger');
		jQuery('#email').focus();
		return false;
	}
	var pass = jQuery('#pass').val();
	if(pass=='')
	{
		alertMsg('Enter the password','text-danger');
		jQuery('#pass').focus();
		return false;
	}
	$.ajax({
		url : url,
		type : "POST",
		data: {
			data : {email : email, pass : pass}
		},
		//data : '',		
		dataType : 'json',
		beforeSend : function(){
			alertMsg('Loging...','text-info');
		},
		success : function (data) {
			var cls = 'text-danger';
			if(data.success) cls = 'text-success';
			alertMsg(data.message,cls);
			if(data.reload == true)
			{
				setTimeout(function(){ location.reload(true); },1000);
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
            alertMsg('Error','text-danger');
        }	
	});
 }

 function logout()
{
    var data="logout=1";
        $.ajax({
     			type: "POST",
     			data: data,		
     			cache: false,
     			success: function (html) {
					showNotify(html);
					setTimeout(function() {location.reload(true);}, 5000);
     			}		
      		});
 }
 /*---------AJAX PROCESS GENERAL-------------*/
 function $ajax(url, data, sync)
 {
	 sync = typeof sync == 'undefined' ? true : sync;
	 var success = false ;
	 $.ajax({
		url : url,
		type : "POST",
		data: {
			data : data
		},
		//data : '',		
		dataType : 'json',
		async : sync,
		beforeSend : function(){
			showNotify('Sending...');
		},
		success : function (data) {
			var cls = 'text-danger';
			if(data.success) cls = 'text-success';
			success = data.success ;
			showNotify(data.message, true);
			
			if(data.reload == true)
			{
				setTimeout(function(){ location.reload(true); },1000);
			}
			
		},
		error: function (jqXHR, textStatus, errorThrown) {
			showNotify('Error');
        }	
	});
	return success;
 }
 function checkNumber(e)
 {
	if (window.event)//lấy giá trị ASCII kí tự mới nhập vào với trình duyệt IE
	{
		var value = window.event.keyCode;
	}
	else
		var value=e.which;
	if(value!=8)
	{
		if(value<48 || value>57)
		{
			showNotify('Only allow number')
			return false;
		}
	}
 }
 function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}


function checkAll(name, parent, child)
{
	var x=document.getElementsByName(name);
	var i=0;
	var count = x.length;
	if(document.getElementById(parent).checked==true)
		for (i=0;i<count;i++)
		{
			var check=child+'_'+i;
			document.getElementById(check).checked=true;
		}
	else
	{
		for (i=0;i<count;i++)
		{
			var check=child+'_'+i;
			document.getElementById(check).checked=false;
		}
	}
	return 0;
}
	
function checkOne(name, parent, child)
{
	var x=document.getElementsByName(name);
	var i=0;
	var count = x.length;			
	for (i=0;i<count;i++)
	{
		var check=child+'_'+i;
		if(document.getElementById(check).checked==false)
		{
			document.getElementById(parent).checked=false
		}
		else
		{
			var tmp = 0;
			for (i=0;i<count;i++)
			{
				var check=child+'_'+i;
				if(document.getElementById(check).checked==true) tmp++;
			}
			if(tmp == count) document.getElementById(parent).checked=true;
		}
	}
	return 0;
}