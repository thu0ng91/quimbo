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
                <img alt="Emgesa" src="public/img/logoprint.gif" class="img-responsive" width="150">
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
                  <td colspan="2"><?php echo $arrRAnswers["a08AP018O01"]; ?></td>
                  <th>Cual</th>
                  <td class='itemRespuesta'><?php echo $arrRAnswers["a08AP018O02"]; ?></td>
                  <th>Tiene una solicitud Adicional</th>
                  <td colspan="2"><?php echo $arrRAnswers["a08AP019O01"]; ?></td>
                </tr>
                <tr>
                  <th>Cual solicitud</th>
                  <td colspan="7"><?php echo $arrRAnswers["a08AP019O02"]; ?></td>
                </tr>

              </table>

              <div class="panel-body">
                <h5>Capítulo B - Información General del Año 2008</h5>
              </div>

              <table class="table table-bordered table-condensed">
                <tr>
                  <th colspan="2">Lugar de residencia en 2008 (hasta Septiembre 1)</th>
                  <th>Departamento</th>
                  <td><?php echo $arrRChapterB[0]->departamento; ?></td>
                  <th>Municipio</th>
                  <td><?php echo $arrRChapterB[0]->municipio; ?></td>
                  <th>Vereda</th>
                  <td><?php echo $arrRChapterB[0]->vereda; ?></td>
                </tr>
                <tr>
                  <th>Dirección donde residia</th>
                  <td colspan="2" class='itemRespuesta'><?php echo $arrRChapterB[0]->direccion; ?></td>
                  <th>Estado Civil</th>
                  <td colspan="2" class='itemRespuesta'><?php echo $arrRChapterB[0]->estadociv; ?></td>
                  <th>Cual</th>
                  <td class='itemRespuesta'><?php echo $arrRChapterB[0]->estadociv_cual; ?></td>
                </tr>
                <tr>
                  <th>Personas a Cargo</th>
                  <td colspan="3"><?php echo $arrRChapterB[0]->perscargo; ?></td>
                  <th>Se encontraba trabajando</th>
                  <td colspan="3" class='itemRespuesta'><?php echo $arrRChapterB[0]->trabajando; ?></td>
                </tr>
                <tr>
                  <th>Actividad económica principal</th>
                  <td colspan="3" class='itemRespuesta'><?php echo $arrRChapterB[0]->actprinc; ?></td>
                  <th>Cual</th>
                  <td colspan="3"><?php echo $arrRChapterB[0]->actprinc_cual; ?></td>
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
                  <th colspan="2">Lugar de residencia entre Agosto 2009/Enero 2010</th>
                  <th>Departamento</th>
                  <td><?php echo $arrRChapterC[0]->departamento; ?></td>
                  <th>Municipio</th>
                  <td><?php echo $arrRChapterC[0]->municipio; ?></td>
                  <th>Vereda</th>
                  <td><?php echo $arrRChapterC[0]->vereda; ?></td>
                </tr>
                <tr>
                  <th>Dirección donde residia</th>
                  <td class='itemRespuesta'><?php echo $arrRChapterC[0]->direccion; ?></td>
                  <th>Estado civil</th>
                  <td class='itemRespuesta'><?php echo $arrRChapterC[0]->estadociv; ?></td>
                  <th>Cual</th>
                  <td class='itemRespuesta'><?php echo $arrRChapterC[0]->estadociv_cual; ?></td>
                  <th>Personas a Cargo</th>
                  <td><?php echo $arrRChapterC[0]->personas; ?></td>
                </tr>
                <tr>
                  <th>Se encontraba trabajando?</th>
                  <td class='itemRespuesta'><?php echo $arrRChapterC[0]->trabajando; ?></td>
                  <th>Actividad económica principal</th>
                  <td colspan="2" class='itemRespuesta'><?php echo $arrRChapterC[0]->actividadprin; ?></td>
                  <th>Cual</th>
                  <td colspan="2"><?php echo $arrRChapterC[0]->actividadprin_cual; ?></td>
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
                  <td colspan="2" class='itemRespuesta'><?php echo $arrRChapterC[0]->pagos_ss; ?></td>
                  <th>Cual</th>
                  <td colspan="4" class='itemRespuesta'><?php echo $arrRChapterC[0]->entidad_ss; ?></td>
                </tr>
                <tr>
                  <th>Régimen de Salud</th>
                  <td colspan="2" class='itemRespuesta'><?php echo $arrRChapterC[0]->regimen; ?></td>
                  <th>Cual</th>
                  <td colspan="4" class='itemRespuesta'><?php echo $arrRChapterC[0]->otro_regimen; ?></td>
                </tr>
                <tr>
                  <th>Nombre EPS</th>
                  <td class='itemRespuesta'><?php echo $arrRChapterC[0]->nom_eps; ?></td>
                  <th>SISBEN</th>
                  <td colspan="2" class='itemRespuesta'><?php echo $arrRChapterC[0]->sisben; ?></td>
                  <th>Nivel</th>
                  <td colspan="2"><?php echo $arrRChapterC[0]->nivel_sisben; ?></td>
                </tr>
                <tr>
                  <th>¿Es usted pensionado?</th>
                  <td class='itemRespuesta'><?php echo $arrRChapterC[0]->pensionado; ?></td>
                  <th>Entidad que paga su pensión</th>
                  <td colspan="5"><?php echo $arrRChapterC[0]->entidad_pension; ?></td>
                </tr>
                <tr>
                  <th>Programa(s) con el cual(es) se ha beneficiado o se está(n) beneficiando usted o su grupo familiar</th>
                  <td colspan="7"></td>
                </tr>
                <tr>
                  <th>Impactos directos o indirectos a su actividad económica con el desarrollo del Proyecto Hidroeléctrico El Quimbo</th>
                  <td colspan="7" class='itemRespuesta'><?php echo $arrRChapterC[0]->impactos; ?></td>
                </tr>
                <tr>
                  <th>Solicitudes anteriores</th>
                  <td class='itemRespuesta'><?php echo $arrRChapterC[0]->solicitudes; ?></td>
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

  <script>
    var matrizRespuestas = {1:"Cedula de Ciudadania",2:"Tarjeta de Identidad",3:"Pasaporte",4:"Cedula de Extranjeria",5:"Hombre",6:"Mujer",7:"Soltero",8:"Casado",9:"Union Libre",10:"Separado",11:"Viudo",12:"Otro",13:"SI",14:"NO",15:"SI",16:"NO",17:"Reasentamiento",18:"Reubicación",19:"Reactivación de la actividad económica",20:"Empleo temporal",21:"No sabe",22:"SI",23:"NO",24:"Soltero",25:"Casado",26:"Union Libre",27:"Separado",28:"Viudo",29:"Otro",30:"Si",31:"No",32:"Jornalero",33:"Pescador Artesanal",34:"Minero",35:"Palero - Arenero",36:"Transportador pasajeros",37:"Transportador Insumos",38:"Transportador de Arena",39:"Ganadero",40:"Mayordomo",41:"Otro",42:"Soltero",43:"Casado",44:"Union Libre",45:"Separado",46:"Viudo",47:"Otro",48:"Si",49:"No",50:"Jornalero",51:"Pescador Artesanal",52:"Minero",53:"Palero - Arenero",54:"Transportador pasajeros",55:"Transportador Insumos",56:"Transportador de Arena",57:"Ganadero",58:"Mayordomo",59:"Otro",60:"Si",61:"No",62:"Pension",63:"Salud",64:"ARL",65:"Contributivo",66:"Subsidiado",67:"Otro",68:"Ninguno",69:"Si",70:"No",71:"Si",72:"No",73:"Red Unidos (Juntos)",74:"Familias en Acción",75:"Familas Guardabosques",76:"Colombia Mayor",77:"De Cero a Siempre",78:"Jovénes en Acción ",79:"Mujer Rural ",80:"Porgramas del ICBF",81:"Otro",82:"Ninguno de los anteriores",83:"Si",84:"No",85:"Si",86:"No",87:"Reasentamiento",88:"Reubicación",89:"Reactivación de la actividad económica",90:"Empleo temporal",91:"No sabe",92:"Compra directa",94:"Compensación en dinero",95:"Compra directa",96:"Compensación en dinero",97:"No Sabe"};
    var matrizDOM = document.getElementsByClassName("itemRespuesta");
    for(var item in matrizDOM) { if(!isNaN(parseInt(matrizDOM[item].innerHTML))){ matrizDOM[item].innerHTML = matrizRespuestas[parseInt(matrizDOM[item].innerHTML)] }; } 

  </script>
</html>