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
    <script src="js/index.js"></script>
  </head>
  <body>
    <div id="main" class="row">
      <!-- title -->
      <div class="large-12 columns">
        <h1 class="text-center">Prueba de Desarrollo</h1>
      </div>
      <!-- end title -->
      <!-- login form -->
      <div id="loginForm">
        <form>
          <div class="row">
            <div class="large-offset-4 large-4 columns">
              <label>Usuario:</label>
              <input id="user" type="text" placeholder="Usuario" />
            </div>
          </div>
          <div class="row">
            <div class="large-offset-4 large-4 columns">
              <label>Password:</label>
              <input id="password" type="password" placeholder="Password" />
            </div>
          </div>
          <div class="row">
            <div class="large-offset-4 large-4 columns">
              <button id="submit" class="expand button">Entrar</button>
            </div>
          </div>
        </form>
      </div>
      <!-- end login form -->
    </div>
    <!-- modal login error -->
    <div id="loginError" class="reveal-modal text-center small" data-reveal>
      <h2>Error</h2>
      <p>La combinaci&oacute;n usuario/password es incorrecta.</p>
      <p>Intenta de nuevo.</p>
      <a class="close-reveal-modal">&#215;</a>
    </div>
    <!-- end modal login error -->
  </body>
</html>
