$(document).ready(function()
{
	
	//Init foundation scripts
	$(document).foundation();

	//Setup validations for year field
	$("#year").keyup(yearChangeHandler);
	//Setup behaivors for make and models
	$("#make").change(makeChangeHandler);
	//Setup validation for picture field
	$("#picture").change(pictureChangeHandler);

	// Setup events for abide's validation
	$('#registerForm')
	.on('invalid.fndtn.abide', function()
	{
		console.log("invalid");
	})
	.on('valid.fndtn.abide', register);
});

function register(event)
{
	console.log("lets register the car");
	var url = 'catcher.php';
	var picture = $("#picture");

	var fileReader = new FileReader();
	var file = picture[0].files[0];
	console.log(file);
	/*var imageElem = document.createElement("img");
	fileReader.onload = (function(img) { return function(e) { img.src = e.target.result; }; })(imageElem);*/
	fileReader.readAsDataURL(file);
	//document.getElementById("images").appendChild(imageElem);  
	uploadFile(file);
	
}

function uploadFile(file)
{
	var xhr = new XMLHttpRequest();
	var formData = new FormData();
	formData.append('plates', $("#plates").val());
	formData.append('color', $("#color").val());
	formData.append('year', $("#make").val());
	formData.append('make', $("#model").val());
	formData.append('file', file);
	xhr.upload.addEventListener("progress", function(e)
	{
		if (e.lengthComputable)
		{
			var percentage = Math.round((e.loaded * 100) / e.total);
			/*$("#progressbar").progressbar("value",percentage);
			$("#percentage").html(percentage+"%");*/
			if(percentage == 100)
				$("#vehicleSaved").html("vehicleSaved");
		}
	}, false);
	xhr.open("POST", "catcher.php");
	//xhr.overrideMimeType('text/plain; charset=x-user-defined-binary');
	xhr.overrideMimeType('json');
	xhr.send(formData);
}

//Year field functions
function yearChangeHandler()
{
	var year = $(this).val();
	if(isValidYear(year))
		$("#yearError").hide();
	else
		$("#yearError").show();
}

function isValidYear(year)
{
	if(year >= 1950 && year <= 2014 && !isNaN(year) && isInteger(year))
		return true;
	else
		return false;
}

function isInteger(number)
{
    if(Math.round(number) != number)
		return false;
    else
		return true;
}
//End year field functions

//Make and Model field functions
function makeChangeHandler()
{
	var make = $(this).val();
	if(isFerrari(make))
		modelToSelect();
	else
		modelToText();
}

function isFerrari(make)
{
	if(make == 'Ferrari')
		return true;
	else
		return false;
}

function modelToSelect()
{
	var html = '';
	html +=	'<label>Modelo:';
    html +=	'<select id="model">';
	html +=		'<option value="California">California</option>';
	html +=		'<option value="Ford">Enzo</option>';
	html +=		'<option value="458 Italia">458 Italia</option>';
	html +=		'<option value="458 Spider">458 Spider</option>';
    html +=	'</select>';
    html +=	'</label>';
    $("#modelDiv").html(html);
}

function modelToText()
{
	var html = '';
	html +=	'<label>Modelo:</label>';
	html +=	'<input id="model" type="text" placeholder="Modelo" required />';
	html += '<small class="error">Este es un campo requerido</small>';
	$("#modelDiv").html(html);
}
//End Make and Model field functions

//Picture field functions
function pictureChangeHandler()
{
	var picture = $(this).val();

	var _URL = window.URL;
	file = this.files[0];
	img = new Image();
	img.onload = function ()
	{
        var width = this.width;
        var height = this.height;
		var isValid = isValidFile(picture);
		console.log("Width:" + this.width + "   Height: " + this.height);
		if(isValid == 'jpg')
		{
			$('#jpgError').foundation('reveal', 'open');
			$('#jpginError').foundation('reveal', 'close');
			$("#picture").val('');
		}
		if(isValid === true && width >= 400 && height >= 400)
		{
			$("#pictureError").hide();
		}
		else
		{
			$("#pictureError").show();
			$("#picture").val('');
		}
	};
	img.src = _URL.createObjectURL(file);

}

function isValidFile(filename)
{
	// Use a regular expression to trim everything before final dot
    var extension = filename.replace(/^.*\./, '');

	// If there is no dot anywhere in filename, we would have extension == filename,
    // so we account for this possibility now
    if (extension == filename)
        extension = '';
    else
    {
        // if there is an extension, we convert to lower case
        // (BTW this conversion will not effect the value of the extension
        // on the file upload.)
        extension = extension.toLowerCase();
    }
    var response;
    switch (extension)
    {
        case 'jpg':
        case 'jpeg':
			response = 'jpg';
			break;
		case 'png':
            // check the mime-type in server-side!
            response = true;
			break;

        default:
            response = false;
    }
    return response;
}
//End Picture field functions