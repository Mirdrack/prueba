$(document).ready(function()
{
	$(document).foundation();
	$("#submit").click(login);
});

function login(event)
{
	event.preventDefault();
	var url = 'login/login.php';
	$.post(url,
	{
		user: $("#user").val(),
		password: $("#password").val()
	},
	function(data)
	{
		if(data.passed === true)
			window.location = 'register.php';
		else
		{
			$('#loginError').foundation('reveal', 'open');
			$('#loginError').foundation('reveal', 'close');
			$("#user").val('');
			$("#password").val('');
		}
	}, 'json');
}