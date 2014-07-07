<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Prueba de Desarrollo || Clemente Estrada</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/generic.css" />
    <script src="js/vendor/modernizr.js"></script>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/register.js"></script>
  </head>
  <body>
    <div id="main" class="row">
      <?php 
      session_start();
      if (isset($_SESSION['user']))
      {?>
        <!-- title -->
        <div class="large-12 columns">
          <h1 class="text-center">Registro de veh&iacute;culos</h1>
        </div>
        <!-- end title -->
        <!-- Register Vehicle Form -->
        <div id="registerVehicleForm">
          <form id="registerForm" data-abide="ajax">
            <!-- Plates -->
            <div class="row">
              <div class="large-offset-4 large-4 columns">
                <label>Placas:</label>
                <input id="plates" type="text" placeholder="Placas" required pattern="[A-Z]{3}-\d{2}-\d{2}" />
                <small class="error">El formato de las placas debera ser: AAA-99-99</small>
              </div>
            </div>
            <!-- Color -->
            <div class="row">
              <div class="large-offset-4 large-4 columns">
                <label>Color
                <select id="color">
                  <option value="Azul">Azul</option>
                  <option value="Blanco">Blanco</option>
                  <option value="Negro">Negro</option>
                  <option value="Gris">Gris</option>
                  <option value="Rojo">Rojo</option>
                  <option value="Verde">Verde</option>
                </select>
                </label>
              </div>
            </div>
            <!-- Year -->
            <div class="row">
              <div class="large-offset-4 large-4 columns">
                <label>A&ntilde;o:</label>
                <input id="year" type="text" placeholder="Año" required />
                <small id="yearError" class="error">Debe ser un valor entre 1950 y 2014</small>
              </div>
            </div>
            <!-- Make -->
            <div class="row">
              <div class="large-offset-4 large-4 columns">
                <label>Marca:
                <select id="make">
                  <option value="Audi">Audi</option>
                  <option value="Cadillac">Cadillac</option>
                  <option value="Ferrari">Ferrari</option>
                  <option value="Ford">Ford</option>
                  <option value="Nissan">Nissan</option>                  
                </select>
                </label>
              </div>
            </div>
            <!-- Model -->
            <div class="row">
              <div id="modelDiv" class="large-offset-4 large-4 columns">
                <label>Modelo:</label>
                <input id="model" type="text" placeholder="Modelo" required />
                <small class="error">Este es un campo requerido</small>
              </div>
            </div>
            <!-- File -->
            <div class="row">
              <div class="large-offset-4 large-4 columns">
                <label>Fotograf&iacute;a del Veh&iacute;culo:</label>
                <input id="picture" type="file" placeholder="Fotografía" required />
                <small id="pictureError" class="error">El archivo debe de ser png y tener un tama&ntilde;o mayor a 400 x 400</small>
              </div>
            </div>
            <div class="row">
              <div class="large-offset-4 large-4 columns">
                <button id="submit" class="expand button" type="submit">Registrar</button>
              </div>
            </div>
          </form>
        </div>
        <!-- End Register Vehicle Form -->
        <!-- modal login error -->
        <div id="jpgError" class="reveal-modal text-center small" data-reveal>
          <h2>Error</h2>
          <p>Los archivos JPG no estan permitidos</p>
          <p>Intenta de nuevo.</p>
          <a class="close-reveal-modal">&#215;</a>
        </div>
        <!-- end modal login error -->
        <div id="vehicleSaved">C</div>
      <?php
      }
      else
      {?>
        <!-- Not logged error -->
        <div class="panel large-12 columns">
          <h1 class="text-center">Necesitas estar loggeado para ingresar a esta secci&oacute;n</h1>
        </div>
        <!-- end Not logged error -->
      <?php
      }?>
    </div>
  </body>
</html>
