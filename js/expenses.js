$(document).ready(function()
{
	$(document).foundation();
	loadVehicles();
	$("#vehicle").change(vehicleChangeHandler);

	$('#tollsForm')
	.on('invalid.fndtn.abide', function ()
	{
		console.log('Invalid');
	})
	.on('valid', function()
	{
		if(validateVehicle())
		{
			registerTollExpense();
		}
		return false;
	});

	$('#gasForm')
	.on('invalid.fndtn.abide', function()
	{
		console.log('Invalid Gas');
	})
	.on('valid', function(event)
	{
		if(validateVehicle())
		{
			validateKm(function(data)
			{
				console.log(data);
				if(data.error == 'No expenses' || data.error == null)
					registerGasExpense();
				else
				{
					$('#invalidKmError').foundation('reveal', 'open');
					$('#invalidKmError').foundation('reveal', 'close');
				}
			});
		}
		return false;
	});

	$('#randomForm')
	.on('invalid.fndtn.abide', function ()
	{
		console.log('Invalid Random');
	})
	.on('valid', function()
	{
		if(validateVehicle())
		{
			registerRandomExpense();
		}
	});
	return false;
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
		fillVehicleExpenses(data.expenses)
}

function fillVehicleExpenses(data)
{
	for (var cont = 0; cont < data.length; cont++)
	{
		printExpense(data[cont]);
	};
}

function validateVehicle()
{
	var vehicle = $('#vehicle').val();
	if(vehicle != 'Selecciona un Vehículo')
		return true;
	else
	{
		$('#selectVehicleError').foundation('reveal', 'open');
		$('#selectVehicleError').foundation('reveal', 'close');
		return false;
	}
}
//End info vehicle functions

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
	var url = 'expenses/registerRandomExpense.php';
	var xhr = new XMLHttpRequest();
	var formData = new FormData();
	formData.append('vehicleId', $("#vehicle").val());
	formData.append('concept', $("#concept").val());
	formData.append('amount', $("#randomPrice").val());
	
	xhr.open("POST", url, true);
	xhr.overrideMimeType('json');
	
	xhr.onreadystatechange = function()
	{
		if (this.readyState == 4 && xhr.status == 200)
		{
			response = JSON.parse(this.responseText);
			printExpense(response.expense);
			console.log(response);
		}
	};
	xhr.send(formData);
}
// End RandomExpense functions

// GasExpense functions
function registerGasExpense()
{
	var url = 'expenses/registerGasExpense.php';
	var xhr = new XMLHttpRequest();
	var formData = new FormData();
	formData.append('vehicleId', $("#vehicle").val());
	formData.append('km', $("#km").val());
	formData.append('amount', $("#gasPrice").val());
	
	xhr.open("POST", url, true);
	xhr.overrideMimeType('json');
	
	xhr.onreadystatechange = function()
	{
		if (this.readyState == 4 && xhr.status == 200)
		{
			response = JSON.parse(this.responseText);
			printExpense(response.expense);
			console.log(response);
		}
	};
	xhr.send(formData);
}

function validateKm(callback)
{
	var url = 'expenses/validateKm.php';
	var xhr = new XMLHttpRequest();
	var formData = new FormData();
	formData.append('vehicleId', $("#vehicle").val());
	formData.append('km', $("#km").val());	
	xhr.open("POST", url, true);
	xhr.overrideMimeType('json');
	
	xhr.onreadystatechange = function()
	{
		if (this.readyState == 4 && xhr.status == 200)
		{
			response = JSON.parse(this.responseText);
			callback.apply(this, [response]);
		}
	};
	xhr.send(formData);	
}
// End GasExpense functions


// UI functions
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
	clean(data.type);
	expense.append(expenseTitle);
	expense.append(content);
	expense.appendTo('#vehicleExpensesList');
}

function clean(type)
{
	switch(type)
	{
		case 1:
			$('#tollPrice').val('');
			break;
		case 2:
			$('#km').val('');
			$('#gasPrice').val('');
			break;
		case 3:
			$('#concept').val();
			$('#randomPrice').val();
			break;
	}
}
// End UI functions