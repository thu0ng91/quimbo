<link href="public/css/certifications/form.css" rel="stylesheet" />
<style>
    #contentCertifications tr td, table tr th{
        text-align: center;
        font-size: 1.2em;
        vertical-align: middle;
    }
</style>
<script type='text/javascript'>
    var formCode = '<?php echo $_GET["formCode"]; ?>';
</script>
<section class="main-content">
    <div class="container">
        <div  id='controls'>
            <br/>
            <legend>Listado de certificaciones digitadas para el formulario con codigo: <label class='label label-info'><?php echo $_GET["formCode"]; ?></label> <br/><br/></legend>
            <br/>
            <h4>Para digitar una nueva certificación haga click <a class='btn btn-success' href='index.php/certifications/form?formCode=<?php echo $_GET["formCode"]; ?>'>Aqui!</a></h4>
            <br/>
            <table style="width: 100%;" class="table table-bordered table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Tipo de certificación</th>
                        <th>Fecha de Creación</th>
                        <th>Última Fecha de Actualización</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id='contentCertifications'>
                    
                </tbody>
            </table>
            <legend></legend>
        </div>
    </div>
</div>