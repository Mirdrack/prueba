$(document).ready(function()
{
	loadVehicles();
	$("#vehicle").change(vehicleChangeHandler);

	$('#tollsForm')
  .on('invalid.fndtn.abide', function () {
    var invalid_fields = $(this).find('[data-invalid]');
    console.log(invalid_fields);
  })
  .on('valid.fndtn.abide', function () {
    console.log('valid!');
  });
});

function loadVehicles()
{
	var url = 'expenses/loadVehicles.php';
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.overrideMimeType('json');
	
	xhr.onreadystatechange = function()
	{
		if (this.readyState == 4 && this.status == 200)
		{
			response = JSON.parse(this.responseText);
			var select = $("#vehicle");
			for (var cont = 0; cont < response.vehicles.length; cont++)
			{
				vehicleName  = response.vehicles[cont].make + ' ' + response.vehicles[cont].model;
				$('<option />')
				.val(response.vehicles[cont].id)
				.text(vehicleName)
				.appendTo(select);
			}
		}
	};
	xhr.send(null);
}

function vehicleChangeHandler()
{
	var url = 'expenses/setVehicleData.php';
	var xhr = new XMLHttpRequest();
	var formData = new FormData();
	formData.append('vehicleId', $("#vehicle").val());
	
	xhr.open("POST", url, true);
	xhr.overrideMimeType('json');
	
	xhr.onreadystatechange = function()
	{
		if (this.readyState == 4 && xhr.status == 200)
		{
			response = JSON.parse(this.responseText);
			console.log(response.vehicle);
			fillVehicleData(response.vehicle);
		}
	};
	xhr.send(formData);
}

function fillVehicleData(data)
{
	var img = $('<img>');
	img.attr('src', 'files/' + data.picture);
	img.appendTo('#vehicleImage');
}

