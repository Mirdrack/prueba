$(document).ready(function()
{
	$(document).foundation();
	loadVehicles();
	$("#vehicle").change(vehicleChangeHandler);
});

//Set info vehicle functions
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
			fillVehicleData(response.vehicle);
		}
	};
	xhr.send(formData);
}

function fillVehicleData(data)
{
	var img = $('<img>');
	img.attr('src', 'files/' + data.picture);
	$('#vehicleImage').html(img);
	if(data.expenses != null)
		fillVehicleExpenses(data.expenses);
	if(data.expenses == null)
	{
		$('#expenseCat-1').html('');
		$('#expenseCat-2').html('');
		$('#expenseCat-3').html('');
	}
}

function fillVehicleExpenses(data)
{
	var totalToll = 0;
	var totalGas = 0;
	var totalRandom = 0;

	for(var cont = 0; cont < data.length; cont++)
	{
		printExpense(data[cont]);
		switch(data[cont].type)
		{
			case 1:
				totalToll += parseFloat(data[cont].amount);
				break;
			case 2:
				totalGas += parseFloat(data[cont].amount);
				break;
			case 3:
				totalRandom += parseFloat(data[cont].amount);
				break;	
		}
	};
	$('#totalToll').html('<strong>Casetas: </strong>' + totalToll);
	$('#totalGas').html('<strong>Gasolina: </strong>' + totalGas);
	$('#totalRandom').html('<strong>Varios: </strong>' + totalRandom);
	console.log('T: ' + totalToll + ' G: ' + totalGas + ' R: ' + totalRandom);
}
//End info vehicle functions

function printExpense(data)
{

	data.type = parseInt(data.type);
	var expenseTitle = $('<p/>');
	var content = $('<p/>');
	expense = $('<div/>');

	switch(data.type)
	{
		case 1:
			expenseTitle.append('<strong>Gasto por concepto de caseta</strong>');
			content.append('<strong>Caseta: </strong>' + data.concept);
			content.append('<br />');
			content.append('<strong>Monto: </strong>' + data.amount);
			break;
		case 2:
			expenseTitle.append('<strong>Gasto por concepto de gasolina</strong>');
			content.append('<strong>Consumo en el Km: </strong>' + data.concept);
			content.append('<br />');
			content.append('<strong>Monto: </strong>' + data.amount);
			break;
		case 3:
			expenseTitle.append('<strong>Gasto por concepto variado</strong>');
			content.append('<strong>Concepto: </strong>' + data.concept);
			content.append('<br />');
			content.append('<strong>Monto: </strong>' + data.amount);
		break;
		default:
			expenseTitle.append('<strong>Error</strong>');
			content.append('No se pudo recuperar el gasto registrado');
	}
	expense.append(expenseTitle);
	expense.append(content);
	$('expenseCat-'+data.type).html('');
	expense.appendTo('#expenseCat-'+data.type);
	$('#totalToll').html(totalToll);
}