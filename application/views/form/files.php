<link href="public/css/certifications/form.css" rel="stylesheet" />
<script type='text/javascript'>
    var formCode = '<?php echo $_GET["formCode"]; ?>';
    var docId = '<?php echo $_GET["docId"]; ?>';
    var code = '<?php
if (isset($_GET["code"])) {
    echo $_GET["code"];
} else {
    echo "0";
}
?>';
    var get_csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var get_csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';

</script>
<section class="main-content">
    <div class="container">
        <div id='controls'>
          <br/>

          <div id='formulario' class='form-group' >
              <legend>Detalle de certificaciones laborales, comerciales y de vecindad.</legend>
              <br/>
              <label for='txtIdentificador'>Identificador de formulario:</label>
              <br/>
              <label class='label label-info' id='txtIdentificador'></label>
          </div>
          <br/>

          <div id='results' class='form-group'>
            <table id='tableResults' class='table table-striped'>
              <thead>
                <tbody>
                  <tr>
                    <td></td>
                  </tr>
                </tbody>
              </thead>
            </table>
          </div>
          
          <div id='docuIdentifica' class='form-group' style='display: none'>
              <label for='txtCedula'>Número de Identificación:</label>
              <br/>
              <label class='label label-info' id='txtCedula'></label>
          </div>

          <div id='tutelas' clas='form-group'>
            <br/>
            <legend>Tutelas:</legend>
            <table id='tableTutelasResults' class='table table-striped'>
              <thead>
                <tbody>
                  <tr>
                    <td></td>
                  </tr>
                </tbody>
              </thead>
            </table>
          </div>

        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Información:</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" style='text-align: center;' role="alert">
                    <img src='public/img/ajax-loader.gif' alt='loading...'/>
                    Cargando por favor espere...
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>