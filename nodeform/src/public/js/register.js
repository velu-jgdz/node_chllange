function validateInput(name, email, password)
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

	if(name.length > 2)
	{
		$("#name").removeClass("is-invalid");
		$("#namespan").hide();
	}
	else
	{
		$("#name").addClass("is-invalid");
		$("#namespan").show();
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

	if(!email.match(EMAIL_VALID) || name.length <= 2 || password.length <= 5)
	{
		return true;
	}
	return false;

}

function handleClickRegister()
{
	$('#registerBtn').on('click', function()
	{
		event.preventDefault();
		let name = $('#name').val();
		let email = $('#email').val();
		let password = $('#password').val();
		let phone = $('#phone').val();

		let check = validateInput(name, email, password)
		if(!check)
		{
			$.ajax({
				url : `${window.location.origin}/register-user`,
				method : "POST",
				data : {
					name : name,
					email : email,
					phone : phone,
					password : password
				},
				success : function(data)
				{
					alert("User Created Successfully");
					console.log(data);
					window.location.href = "/login";
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
	handleClickRegister();
});