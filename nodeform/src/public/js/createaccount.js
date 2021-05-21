function validateInput(account, deposit)
{
	if(deposit.length > 2)
	{
		$("#deposit").removeClass("is-invalid");
		$("#depositspan").hide();
	}
	else
	{
		$("#deposit").addClass("is-invalid");
		$("#depositspan").show();
	}	

	if(account.length > 5)
	{
		$("#account").removeClass("is-invalid");
		$("#accountspan").hide();
	}
	else
	{
		$("#account").addClass("is-invalid");
		$("#accountspan").show();
	}

	if(deposit.length <= 2 || account.length <= 5)
	{
		return true;
	}
	return false;

}

function handleClickAccount()
{
	$('#accountBtn').on('click', function()
	{
		event.preventDefault();
		let account = $('#account').val();
		let deposit = $('#deposit').val();

		let check = validateInput(account, deposit)
		if(!check)
		{
			$.ajax({
				url : `${window.location.origin}/accountsubmit`,
				method : "POST",
				data : {
					account : account,
					deposit : deposit,
				},
				success : function(data)
				{
					alert("Account Created Successfully");
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
	handleClickAccount();
});