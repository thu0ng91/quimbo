<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="quimbo, emgesa, endesa">
    <title><?php echo $stRPageTitle; ?> | Quimbo - Emgesa</title>
    <base href="<?php echo base_url(); ?>">
    <link href="public/css/bootstrap.min.css" rel="stylesheet" media="screen, print">
    <style type="text/css">
        body {
            font-size: 12px;
        }
        p, li {
            font-size: 11px;
        }
        .table {
            margin-bottom: 0px;
        }
        .panel-body {
            padding: 5px;
        }
        .huella {
            border: 1px solid #ccc;
            padding: 30px 20px 0px 20px;
            margin-top: -20px;
        }
    </style>
  </head>
  <body>
    <section class="main-content">
      <div class="container">
        <div class="row">
          <div class="pull-right small"><?php echo $arrRForm["a07Codigo"]; ?></div>
          <div class="panel panel-default" style="border: none;">
            <div class="panel-body">
              <div class="pull-left">
                <img alt="Emgesa" src="public/img/logoprint.gif" class="img-responsive" width="75">
              </div>
              <h4 class="pull-right">FORMATO SOLICITUD DE REGISTRO EN EL CENSO</h4>
            </div>
            <div class="panel-body">
              <table class="table table-bordered table-condensed">
                <tr>
                  <th>Número de Formulario</th>
                  <td><?php echo $arrRForm["a07Codigo"]; ?></td>
                  <th>Folios Anexos</th>
                  <td><?php echo $arrRForm["a07Folios"]; ?></td>
                  <th>Fecha de Aplicación</th>
                  <td><?php echo date("d/m/Y", strtotime($arrRForm["a07Aplica"])); ?></td>
                  <th>Lugar</th>
                  <td><?php echo $arrRForm["a06Nombre"]; ?> ( <?php echo strtoupper($arrRForm["a05Nombre"]); ?> )</td>
                </tr>
              </table>
            </div>
            <div class="panel-body">
              <h5>Capitulo <?php echo $arrRChapter["a02Letra"]; ?> - <?php echo $arrRChapter["a02Nombre"]; ?></h5>
<?php if (count($arrRAnswers) > 0) { ?>
              <table class="table table-bordered table-condensed">
                <tr>
                  <th>Documento de Identidad</th>
                  <td colspan="3"><?php echo $arrRAnswers["a08AP08O01"]; ?></td>
                  <th>Número de documento</th>
                  <td colspan="3"><?php echo $arrRAnswers["a08AP08O02"]; ?></td>
                </tr>
                <tr>
                  <th>Nombres</th>
                  <td colspan="3"><?php echo $arrRAnswers["a08AP01"]; ?></td>
                  <th>Apellidos</th>
                  <td colspan="3"><?php echo $arrRAnswers["a08AP02"]; ?></td>
                </tr>
                <tr>
                  <th>Lugar de residencia</th>
                  <td colspan="3"><?php echo $arrRAnswers["a08AP03O02"]; ?> ( <?php echo strtoupper($arrRAnswers["a08AP03O01"]); ?> )</td>
                  <th>Dirección Actual</th>
                  <td colspan="3"><?php echo $arrRAnswers["a08AP04"]; ?></td>
                </tr>
                <tr>
                  <th>Vereda</th>
                  <td colspan="2"><?php echo $arrRAnswers["a08AP05"]; ?></td>
                  <th>Teléfonos</th>
                  <td colspan="2"><?php echo $arrRAnswers["a08AP06"]; ?> <?php if (!empty($arrRAnswers["a08AP07"])) { ?>
                    - <?php echo $arrRAnswers["a08AP07"]; ?><?php } ?></td>
                  <th>Sexo</th>
                  <td><?php echo $arrRAnswers["a08AP013"]; ?></td>
                </tr>
                <tr>
                  <th>Lugar de nacimiento</th>
                  <td colspan="3"><?php echo $arrRAnswers["a08AP09O03"]; ?> <?php if (!empty($arrRAnswers["a08AP09O02"])) { ?>
                    ( <?php echo strtoupper($arrRAnswers["a08AP09O02"]); ?> ) - <?php } ?>
                    <?php echo strtoupper($arrRAnswers["a08AP09O01"]); ?></td>
                  <th>Fecha de Nacimiento</th>
                  <td><?php echo $arrRAnswers["a08AP011O01"]; ?> / <?php echo $arrRAnswers["a08AP011O02"]; ?> / <?php echo $arrRAnswers["a08AP011O03"]; ?></td>
                  <th>Jefe del Hogar</th>
                  <td><?php echo $arrRAnswers["a08AP017"]; ?></td>
                </tr>
<?php if (!is_null($stRType)) { ?>
                <tr>
                  <th>Estado Civil</th>
                  <td><?php echo $arrRAnswers["a08AP014O01"]; ?> <?php if (!empty($arrRAnswers["a08AP014O02"])) { ?>
                    ( <?php echo $arrRAnswers["a08AP014O02"]; ?> )<?php } ?></td>
                  <th>Nombre del Conyuge</th>
                  <td colspan="3"><?php echo $arrRAnswers["a08AP015"]; ?></td>
                  <th>Personas a Cargo</th>
                  <td><?php echo $arrRAnswers["a08AP016"]; ?></td>
                </tr>
                <tr>
                  <th>Ha recibido alguna medida</th>
                  <td colspan="4"><?php echo $arrRAnswers["a08AP018O01"]; ?> <?php if (!empty($arrRAnswers["a08AP018O02"])) { ?>
                    - <?php echo $arrRAnswers["a08AP018O02"]; ?><?php } ?></td>
                  <th>Tiene una solicitud Adicional</th>
                  <td colspan="2"><?php echo $arrRAnswers["a08AP019O01"]; ?></td>
                </tr>
                <tr>
                  <th>Cual solicitud</th>
                  <td colspan="7"><?php echo $arrRAnswers["a08AP019O02"]; ?></td>
                </tr>
<?php } ?>
              </table>

              <div class="panel-body">
                <h5>Capítulo B - Información General del Año 2008</h5>
              </div>

              <table class="table table-bordered table-condensed">
                <tr>
                  <th colspan="2">Lugar de residencia en 2008 (hasta Septiembre 1)</th>
                  <th>Departamento</th>
                  <td></td>
                  <th>Municipio</th>
                  <td></td>
                  <th>Vereda</th>
                  <td></td>
                </tr>
                <tr>
                  <th>Dirección donde residia</th>
                  <td colspan="2"></td>
                  <th>Estado Civil</th>
                  <td colspan="4"></td>
                </tr>
                <tr>
                  <th>Personas a Cargo</th>
                  <td colspan="3"></td>
                  <th>Se encontraba trabajando</th>
                  <td colspan="3"></td>
                </tr>
                <tr>
                  <th>Actividad económica principal</th>
                  <td colspan="7"></td>
                </tr>
                <tr>
                  <th>Zona desarrollo de actividad</th>
                  <th>Municipio</th>
                  <td></td>
                  <th>Corregimiento</th>
                  <td colspan="2"></td>
                  <th>Vereda</th>
                  <td></td>
                </tr>
                <tr>
                  <th>Predio</th>
                  <td></td>
                  <th colspan="2">Nombre del dueño</th>
                  <td colspan="4"></td>
                </tr>
              </table>

              <div class="panel-body">
                <h5>Capítulo C - Tiene familiares a los que se les ha otorgado algún tipo de medida de manejo por el proyecto</h5>
              </div>

              <table class="table table-bordered table-condensed">
                <tr>
                  <th colspan="2">Lugar de resdidencia entre Agosto 2009/Enero 2010</th>
                  <th>Departamento</th>
                  <td></td>
                  <th>Municipio</th>
                  <td></td>
                  <th>Vereda</th>
                  <td></td>
                </tr>
                <tr>
                  <th>Dirección donde residia</th>
                  <td colspan="2"></td>
                  <th>Estado civil</th>
                  <td colspan="2"></td>
                  <th>Personas a Cargo</th>
                  <td></td>
                </tr>
                <tr>
                  <th>Se encontraba trabajando?</th>
                  <td colspan="3"></td>
                  <th>Actividad económica principal</th>
                  <td colspan="3"></td>
                </tr>
                <tr>
                  <th>Zona desarrollo de actividad</th>
                  <th>Municipio</th>
                  <td></td>
                  <th>Corregimiento</th>      
                  <td colspan="2"></td>
                  <th>Vereda</th>
                  <td></td>
                </tr>
                <tr>
                  <th>Predio</th>
                  <td colspan="3"></td>
                  <th>Nombre del dueño</th>
                  <td colspan="3"></td>
                </tr>
                <tr>
                  <th>Pagos en seguridad social</th>
                  <td></td>
                  <th>Régimen de Salud</th>
                  <td colspan="2"></td>
                  <th>SISBEN</th>
                  <td colspan="2"></td>
                </tr>
                <tr>
                  <th>¿Es usted pensionado?</th>
                  <td></td>
                  <th>Programa(s) con el cual(es) se ha beneficiado o se está(n) beneficiando usted o su grupo familiar</th>
                  <td colspan="5"></td>
                </tr>
                <tr>
                  <th>Impactos directos o indirectos a su actividad económica con el desarrollo del Proyecto Hidroeléctrico El Quimbo</th>
                  <td colspan="7"></td>
                </tr>
                <tr>
                  <th>Solicitudes anteriores</th>
                  <td></td>
                  <th colspan="3">Familiares compensados con algún tipo de medida por el proyecto</th>
                  <td colspan="3"></td>
                </tr>
              </table>

<?php } else { ?>
              <p class="text-danger">SIN Información</p>
<?php } ?>
            </div>
            <br/>
            <br/>
            <br/>
            <div class="pull-left small"><?php echo $arrRForm["a07Codigo"]; ?></div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>