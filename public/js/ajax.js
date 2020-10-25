//---------------------------- Reset Button ---------------------------------

"use strict",
function PageReset(){
	window.location.reload();
}
//---------------------------- contact section ------------------------------
function ckhformcontact(){
	
	if(document.getElementById("fname").value==''){
		alert("Please Enter Your First Name"); 
		document.getElementById("fname").value='';
		document.getElementById("fname").focus();
		return false;
	}
	if(document.getElementById("lname").value==''){
		alert("Please Enter Your Last Name"); 
		document.getElementById("lname").value='';
		document.getElementById("lname").focus();
		return false;
	}
	if(document.getElementById("phone").value==''){
		alert("Please Enter Your Phone"); 
		document.getElementById("phone").value='';
		document.getElementById("phone").focus();
		return false;
	}
	if(document.getElementById("email").value==''){
		alert("Please Enter Your Email"); 
		document.getElementById("email").value='';
		document.getElementById("email").focus();
		return false;
	}
	if(!validateEmail("Email Address",document.getElementById("email").value))	
	{
		document.getElementById("email").click();
		document.getElementById("email").focus();
		return false;
	}
	if(document.getElementById("country").value==''){
		alert("Please Select Your Country"); 
		document.getElementById("country").value='';
		document.getElementById("country").focus();
		return false;
	}
	if(document.getElementById("message").value==''){
		alert("Please Enter Your Message"); 
		document.getElementById("message").value='';
		document.getElementById("message").focus();
		return false;
	}
    return true;
}

function ajaxmailcontact(){
	
	if(ckhformcontact() == true){
			
	var form_data = $('#contactForm').serialize();
	
		$.ajax({
		url:"php/mailcontroller.php?mode=contact",
		data:form_data,
		cache:false,
		async:false,
		success: function(data) {
			//alert(data);
			if(data==1){
			$('#model2').click();
			$('#contactForm')[0].reset();
			}
		}
		});
		
	}
}
//---------------------------- subscriber section ------------------------------
function ckhformsubscribe(){
	if(document.getElementById("subsemail").value==''){
		alert("Please Enter Your Email Address"); 
		document.getElementById("subsemail").value='';
		document.getElementById("subsemail").focus();
		return false;
	}
	if(!validateEmail("Email Address",document.getElementById("subsemail").value))	
	{
		document.getElementById("subsemail").click();
		document.getElementById("subsemail").focus();
		return false;
	}
    return true;
}

function ajaxmailsubscribe(){
	
if(ckhformsubscribe() == true){
	//alert(2);
	var form_data=$('#subsForm').serialize();
	//alert(form_data);
		 $.ajax({
		url:"php/mailcontroller.php?mode=subscriber",
		data:form_data,
		cache:false,
		async:false,
		success: function(data) {
			//alert(data);
			if(data==1){
			$('#model2').click();
			$('#subsForm')[0].reset();
			}
		}
		});
}
}
