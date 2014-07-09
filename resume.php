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
    <script src="js/resume.js"></script>
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
            <div id="vehicleInfo" class="large-3 columns">
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
              <br>
              <div id="totalToll"></div>
              <br>
              <div id="totalGas"></div>
              <br>
              <div id="totalRandom"></div>
            </div>
            <div id="expenses" >
              <div class="large-3 columns">
                <h5>Casetas</h5>
                <div id="expenseCat-1"></div>
              </div>
              <div class="large-3 columns">
                <h5>Gasolina</h5>
                <div id="expenseCat-2"></div>
              </div>
              <div class="large-3 columns">
                <h5>Varios</h5>
                <div id="expenseCat-3">
                </div>
              </div>
              
            </div>
          </div>
          <!-- End Register expenses -->
        </div>
        <!-- End content of the page -->
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