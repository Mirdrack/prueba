$(document).ready(function()
{
	var requestContToll = 0;
	var requestContRand = 0;
	var requestContGas	= 0;
	$(document).foundation();
	loadVehicles();
	$("#vehicle").change(vehicleChangeHandler);

	$('#tollsForm')
	.on('invalid.fndtn.abide', function ()
	{
		console.log('Invalid');
	})
	.on('valid.fndtn.abide', function()
	{
		if(requestContToll === 0)
		{
			registerTollExpense();
			requestContToll++;
		}
	});

	$('#gasForm')
	.on('invalid.fndtn.abide', function ()
	{
		console.log('Invalid Gas');
	})
	.on('valid.fndtn.abide', function()
	{
		if(requestContGas === 0)
		{
			registerGasExpense();
			requestContGas++;
		}
	});

	$('#randomForm')
	.on('invalid.fndtn.abide', function ()
	{
		console.log('Invalid Random');
	})
	.on('valid.fndtn.abide', function()
	{
		if(requestContToll === 0)
		{
			registerRandomExpense();
			requestContRand++;
		}
	});
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
	img.appendTo('#vehicleImage');
}
//End set info vehicle functions

//Toll expense functions
function registerTollExpense()
{
	var url = 'expenses/registerTollExpense.php';
	var xhr = new XMLHttpRequest();
	var formData = new FormData();
	formData.append('vehicleId', $("#vehicle").val());
	formData.append('toll', $("#toll").val());
	formData.append('amount', $("#tollPrice").val());
	
	xhr.open("POST", url, true);
	xhr.overrideMimeType('json');
	
	xhr.onreadystatechange = function()
	{
		if (this.readyState == 4 && xhr.status == 200)
		{
			response = JSON.parse(this.responseText);
			printExpense(response.expense);
		}
	};
	xhr.send(formData);
}
// End Toll expense funcions

// RandomExpense functions
function registerRandomExpense()
{
	console.log("valid");
}
// End RandomExpense functions

// GasExpense functions
function registerGasExpense()
{
	console.log("valid");
}
// End GasExpense functions

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
	expense.appendTo('#vehicleExpensesList');
}