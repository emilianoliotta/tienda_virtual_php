<!DOCTYPE html>
<html>
<?php include_once("head.php"); ?>
  <!-- CUERPO -->
  <body>
    <?php
      include_once("messages.php");
      include_once("header.php");
    ?>
    <div id="cuerpo">
      <div class="fluid-container">
        <div class="row">
          <div class="col-xs-12 col-md-4 col-md-offset-4 well">
            <div class="centrar">
              <h4 class="negrita"><span class="destacado">Acerca </span>de</h4>
              <hr>
            </div>
            <div class="centrar">
              <h5 class="destacado">Carrera</h5>
              <div class="negrita">Ingeniería en Computación</div>
              <br>
              <h5 class="destacado">Cátedra</h5>
              <div class="negrita">Seminario de Lenguajes - Opción PHP</div>
              <br>
              <h5 class="destacado">Alumnos</h5>
              <div class="fluid-container">
                <div class="row">
                  <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <table class="table table-bordered">
                      <thead>
                        <tr class="info">
                          <th>Apellido y nombre</th>
                          <th>Legajo</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Liotta, Emiliano</td>
                          <td>501/3</td>
                        </tr>
                        <tr>
                          <td>Hourquebie, Lucas</td>
                          <td>509/2</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <hr>
              <a href="products.php" class="button">VOLVER A NAVEGACIÓN</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--FIN del CUERPO -->

		<?php include_once("footer.php"); ?>

  </body>
</html>
