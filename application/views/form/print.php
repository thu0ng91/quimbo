<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alvaro Arturo Montenegro Silva">
    <meta name="author" content="arthvrian@yahoo.com">
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
                <img alt="Emgesa" src="public/img/logo.gif" class="img-responsive" width="75">
              </div>
              <h4 class="pull-right">FORMATO SOLICITUD DE REGISTRO EN EL CENSO</h4>
            </div>
            <div class="panel-body">
              <table class="table table-condensed">
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
<?php } else { ?>
              <p class="text-danger">SIN Información</p>
<?php } ?>
            </div>
<?php if (is_null($stRType)) { ?>
            <div class="panel-body">
<!--               <p class="hide"><strong>Emgesa</strong> reitera a los accionantes que:</p>
              <p class="hide">Usted tiene derecho a conocer, actualizar rectificar y suprimir sus datos personales
                que no deriven de un deber legal o contractual; tener acceso a sus datos, a la prueba
                y al uso que se les ha dado; y a presentar quejas por violación a los derechos que
                le asisten, en los términos de la Ley 1581 de 2012.</p>
              <p class="hide">Y que con su firma en esta acta, manifiesta que:</p>
              <p class="hide">Declaro y garantizo que he sido informado de mis derechos como titular de Mis Datos
                Personales, dentro de los que se encuentran los siguientes:</p>
              <ol type="i" class="hide">
                <li>Conocer, actualizar y rectificar Mis Datos Personales frente a las Compañías
                  Tratantes;</li>
                <li>Solicitar prueba de esta o las demás autorizaciones que haya dado para Mis
                  Datos Personales;</li>
                <li>Previa solicitud, ser informado sobre el uso que se ha dado a Mis Datos
                  Personales;</li>
                <li>Presentar ante la autoridad competente quejas por violaciones al régimen
                  de protección de datos personales;</li>
                <li>Solicitar la supresión de Mis Datos Personales o la revocación de mi autorización
                  cuando la autoridad competente haya sancionado a la Compañía por conductas ilegales
                  en relación con Mis Datos Personales.</li>
              </ol>
              <p class="hide">De igual forma, declaro y garantizo que conozco el carácter facultativo de las
                respuestas a las preguntas sobre Mis Datos Personales Sensibles o sobre niños,
                niñas y adolescentes; Que Conozco las identificaciones, direcciones físicas y
                electrónicas y los teléfonos de la Compañía que actúa como Responsable en relación
                con Mis Datos Personales, las cuales se incluyen en el encabezado de este documento;
                Que conozco y acepto que la no entrega o autorización de Mis Datos Personales puede
                imposibilitar la prestación de servicios por la Compañía</p>
              <p class="hide">En consecuencia, otorgo mi autorización expresa, explícita e informada a la Compañía
                para que realice cualquier operación de tratamiento sobre Mis Datos Personales
                (incluyendo los recolectados o tratados con anterioridad a este documento). En
                complemento de lo anterior, otorgo mi autorización expresa e informada a la Compañía
                para que Mis Datos Personales sean transferidos, transmitidos y Tratados por Terceras
                Compañías. La Compañía podrán estar ubicadas en Colombia o en el extranjero, incluso
                en países que no proporcionen niveles adecuados de protección de datos.</p>
              <p class="hide">Duración del Tratamiento de Mis Datos Personales: La Compañía podrá tratar y conservar
                Mis Datos Personales mientras sea necesario para el cumplimiento de cualquier obligación
                y/o la atención de cualquier queja o reclamo judicial o extrajudicial.</p> -->
              <p>Declaro expresamente que la información consignada en el presente documento y los
                medios de prueba que aporto, guardan fielmente el deber de veracidad en todas sus
                partes.</p>
              <p>En constancia de lo anterior,</p>
              <div class="col-sm-9 pull-left">
                <p>Firma</p>
                <p>CC _____________________________ de _____________________________</p>
              </div>
              <div class="col-sm-3 pull-right">
                <p class="text-center huella">&nbsp;<br>&nbsp;<br>
                Huella</p>
              </div>
            </div>
<?php } ?>
            <div class="pull-left small"><?php echo $arrRForm["a07Codigo"]; ?></div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>