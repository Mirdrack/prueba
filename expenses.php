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
    <script src="js/expenses.js"></script>
  </head>
  <body>
    <div id="main" class="row">
      <?php 
      session_start();
      if (isset($_SESSION['user']))
      {?>
        <!-- navigation bar -->
        <div id="#navigationBar">
            <nav class="top-bar" data-topbar> 
              <ul class="title-area">
                <li class="name"><h1><a href="#">Desarrollo de Prueba</a></h1> </li>
                <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li> 
              </ul> 
              <section class="top-bar-section"> 
                <ul class="left">
                  <li><a href="register.php">Registrar auto</a></li>
                  <li><a href="expenses.php">Registrar gastos</a></li>
                  <li><a href="resume.php">Resumen</a></li>
                  <li><a href="login/logout.php">Resumen</a></li>
                </ul>
              </section>
            </nav>
        </div>
        <!-- end navigation bar -->

        <!-- content of the page -->
        <div id="content">
          <!-- title -->
          <div class="large-12 columns">
            <h1 class="text-center">Registro de gastos</h1>
          </div>
          <!-- End title -->
          <!-- Register expenses -->
          <div id="expenses">
            <div id="vehicleInfo" class="large-4 columns">
              <div id="vehicleSelect">
                <div class="row">
                    <label>Veh&iacute;culo
                    <select id="vehicle">
                      <option>Selecciona un Veh&iacute;culo</option>
                    </select>
                    </label>
                </div>
              </div>
              <div id="vehicleImage"></div>
              <div id="vehicleExpensesList">&nbsp;</div>
            </div>
            <div id="expensesForms" class="large-7 columns">
              <div id="tolls">
                <h3>Casetas</h3>
                <form id="tollsForm" data-abide="ajax" >
                  <div class="toll">
                      <label>Veh&iacute;culo
                      <select id="toll">
                        <option value="Caseta 1">Caseta 1</option>
                        <option value="Caseta 2">Caseta 2</option>
                        <option value="Caseta 3">Caseta 3</option>
                        <option value="Caseta 4">Caseta 4</option>
                        <option value="Caseta 5">Caseta 5</option>
                        <option value="Caseta 6">Caseta 6</option>
                      </select>
                      </label>
                  </div>
                  <div class="toollsPrice">
                    <label>Monto:</label>
                    <input id="tollPrice" type="text" placeholder="Monto de las caseta" required pattern="^\d+(\.\d{1,2})?" />
                    <small class="error">Este es un campo requerido y solo se permiten n&uacute;meros con un m&aacute;ximo de dos decimales</small>
                  </div>
                  <div>
                    <button id="submitToll" class="expand button" type="submit">Registrar Gasto</button>
                  </div>
                </form>
              </div>
              <div id="gas">
                <h3>Gasolina</h3>
                <form id="gasForm" data-abide="ajax" >
                  <div class="km">
                    <label>Kilometrage:</label>
                    <input id="km" type="text" placeholder="Kilometrage" required patter="integer" />
                    <small class="error">Este es un campo requerido y solo se permiten n&uacute;meros enteros</small>
                  </div>
                  <div class="gasPrice">
                    <label>Monto:</label>
                    <input id="gasPrice" type="text" placeholder="Monto" required pattern="^\d+(\.\d{1,2})?" />
                    <small class="error">Este es un campo requerido y solo se permiten n&uacute;meros con un m&aacute;ximo de dos decimales</small>
                  </div>
                  <div>
                    <button id="submitGas" class="expand button" type="submit">Registrar Gasto</button>
                  </div>
                </form>
              </div>
              <div id="random">
                <h3>Varios</h3>
                <form id="randomForm" data-abide="ajax" >
                  <div class="concept">
                    <label>Concepto:</label>
                    <input id="concept" type="text" placeholder="Concepto" required patter="alpha_numeric" />
                    <small class="error">Este es un campo requerido y solo se permiten datos alfanumericos</small>
                  </div>
                  <div class="randomPrice">
                    <label>Monto:</label>
                    <input id="randomPrice" type="text" placeholder="Monto" required pattern="^\d+(\.\d{1,2})?"/>
                    <small class="error">Este es un campo requerido y solo se permiten n&uacute;meros con un m&aacute;ximo de dos decimales</small>
                  </div>
                  <div>
                    <button id="submitRandom" class="expand button" type="submit">Registrar Gasto</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- End Register expenses -->
        </div>
        <!-- End content of the page -->
        <!-- Modal select vehicle error -->
        <div id="selectVehicleError" class="reveal-modal text-center small" data-reveal>
          <h2>Error</h2>
          <p>Debes seleccionar un veh&iacute;culo al cual asignarle los gastos</p>
          <p>Intenta de nuevo.</p>
          <a class="close-reveal-modal">&#215;</a>
        </div>
        <!-- End Modal select vehicle error -->
        <!-- Invalid Km error -->
        <div id="invalidKmError" class="reveal-modal text-center small" data-reveal>
          <h2>Error</h2>
          <p>Debes ingresar un Km posterior al Km del &uacute;ltimo gasto ingresado</p>
          <p>Intenta de nuevo.</p>
          <a class="close-reveal-modal">&#215;</a>
        </div>
        <!-- Invalid Km error -->
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