function validateInput(email, password)
{
	const EMAIL_VALID = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
	if(email.match(EMAIL_VALID))
	{
		$("#email").removeClass("is-invalid");
		$("#emailspan").hide();
	}
	else
	{
		$("#email").addClass("is-invalid");
		$("#emailspan").show();
	}

	if(password.length > 5)
	{
		$("#password").removeClass("is-invalid");
		$("#passspan").hide();
	}
	else
	{
		$("#password").addClass("is-invalid");
		$("#passspan").show();
	}

	if(!email.match(EMAIL_VALID) || password.length <= 5)
	{
		return true;
	}
	return false;

}

function handleClickLogin()
{
	$('#loginBtn').on('click', function()
	{
		event.preventDefault();
		let email = $('#email').val();
		let password = $('#password').val();

		let check = validateInput(email, password)
		if(!check)
		{
			$.ajax({
				url : `${window.location.origin}/login`,
				method : "POST",
				data : {
					email : email,
					password : password
				},
				success : function(data)
				{
					alert("User Login Successfully");
					console.log(data);
					window.location.href = "/";
				},
				error : function(err)
				{
					alert(err.responseText);
					console.log(err);
				}
			});
		}
	});
}

$(document).ready(function(){
	handleClickLogin();
});