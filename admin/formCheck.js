// EVENT
function doCheckEvent() 
{      
    var pass = true;
    var errors = ''; 
	if ( $('#txtName').val() == '' ) {
        errors = errors+"Enter event name.\n\r";
        pass = false;
    }
	if ( $('#txtUrl').val() == '' ) {
        errors = errors+"Enter event URL.\n\r";
        pass = false;
    }
	if ( $('#txtEmonth').val() == '' ) {
        errors = errors+"Select date of birth: month.\n\r";
        pass = false;
    } 
    if ( $('#txtEdate').val() == '' ) {
        errors = errors+"Select date of birth: date.\n\r";
        pass = false;
    }
    if ( $('#txtEyear').val() == '' ) {
        errors = errors+"Select date of birth: year.\n\r";
        pass = false;
    }
	if ( $('#txtImage').val() == '' ) {
        errors = errors+"Upload event header image.\n\r";
        pass = false;
    }
	if ( $('#txtPharse').val() == '' ) {
        errors = errors+"Enter pharse line.\n\r";
        pass = false;
    }
	if ( $('#txtDesc').val() == '' ) {
        errors = errors+"Enter description.\n\r";
        pass = false;
    }
    if ( errors ) {                                                                      
        alert(errors);                
    }
    else {
        $('#submit');
    }
    return pass;
}

// CELEBRITIE
function doCheckCele() 
{      
    var pass = true;
    var errors = ''; 
	if ( $('#txtFname').val() == '' ) {
        errors = errors+"Enter your first name.\n\r";
        pass = false;
    }
	if ( $('#txtLname').val() == '' ) {
        errors = errors+"Enter your last name.\n\r";
        pass = false;
    }
	if ( $('#txtUrlC').val() == '' ) {
        errors = errors+"Enter event URL.\n\r";
        pass = false;
    }
	if ( $('#txtBmonth').val() == '' ) {
        errors = errors+"Select date of birth: month.\n\r";
        pass = false;
    } 
    if ( $('#txtBdate').val() == '' ) {
        errors = errors+"Select date of birth: date.\n\r";
        pass = false;
    }
    if ( $('#txtByear').val() == '' ) {
        errors = errors+"Select date of birth: year.\n\r";
        pass = false;
    }
	if ( $('#txtPmonth').val() == '' ) {
        errors = errors+"Select date passed: month.\n\r";
        pass = false;
    } 
    if ( $('#txtPdate').val() == '' ) {
        errors = errors+"Select date passed: date.\n\r";
        pass = false;
    }
    if ( $('#txtPyear').val() == '' ) {
        errors = errors+"Select date passed: year.\n\r";
        pass = false;
    }
	if (( frm.txtGender[0].checked == false ) && ( frm.txtGender[1].checked == false ))
	{
        errors = errors+"Choose gender: Male / Female.\n\r";
        pass = false;
    }
	if ( $('#txtImageC').val() == '' ) {
        errors = errors+"Upload header celebritie image.\n\r";
        pass = false;
    }
	if ( $('#txtPharseC').val() == '' ) {
        errors = errors+"Enter pharse line.\n\r";
        pass = false;
    }
	if ( $('#txtDescC').val() == '' ) {
        errors = errors+"Enter description.\n\r";
        pass = false;
    }
    if ( errors ) {                                                                      
        alert(errors);                
    }
    else {
        $('#submit');
    }
    return pass;
}

function doEvent()
{
	if(document.getElementById("event").style.display == "none")
	{
		document.getElementById("event").style.display = "block";
		document.getElementById("cele").style.display = "none";
		document.getElementById("eventButt").style.display = "block";
		document.getElementById("celeButt").style.display = "none";
	}
}

function doCel()
{
	if(document.getElementById("cele").style.display == "none")
	{
		document.getElementById("cele").style.display = "block";
		document.getElementById("event").style.display = "none";
		document.getElementById("eventButt").style.display = "none";
		document.getElementById("celeButt").style.display = "block";
	}
}

function eventName()
{
	var retail1=document.getElementById('txtName').value;
	var pageUrl = retail1;
	var pageUrlVal = pageUrl.toLowerCase(); 
	var result = pageUrlVal.replace(/[^\w\-]+/g,'-');
	var preUrl = result.replace(/\-{2#$,}/g,'-');
	var preUrl2 = preUrl.replace(/^\-+/g,'');
	var resultVal = preUrl2.replace(/--/g,'');

	document.getElementById('txtUrl').value = resultVal;
}


function firstName()
{
	var retail1=document.getElementById('txtFname').value;
	var retail2=document.getElementById('txtLname').value;

	if(document.getElementById('txtLname').value != "")
	{
		var pageUrl = retail1 +'-'+ retail2;
	}
	else
	{
		var pageUrl = retail1;
	}
	var pageUrlVal = pageUrl.toLowerCase(); 
	var result = pageUrlVal.replace(/[^\w\-]+/g,'-');
	var preUrl = result.replace(/\-{2#$,}/g,'-');
	var preUrl2 = preUrl.replace(/^\-+/g,'');
	var resultVal = preUrl2.replace(/--/g,'');

	document.getElementById('txtUrlC').value = resultVal;
}
function lastName()
{
	var retail1=document.getElementById('txtFname').value;
	var retail2=document.getElementById('txtLname').value;

	if(document.getElementById('txtFname').value != "")
	{
		var pageUrl = retail1 +'-'+ retail2;
	}
	else
	{
		var pageUrl = retail2;
	}
	var pageUrlVal = pageUrl.toLowerCase(); 
	var result = pageUrlVal.replace(/[^\w\-]+/g,'-');
	var preUrl = result.replace(/\-{2,}/g,'-');
	var preUrl2 = preUrl.replace(/^\-+/g,'');
	var resultVal = preUrl2.replace(/\-+$/g,'');

	document.getElementById('txtUrlC').value = resultVal;
}
