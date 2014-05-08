    <section class="main-content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3>Cierre del <strong>formulario</strong></h3>
            <div class="well-container">
<?php if (!empty($arrRForm["a07Imagen"]) && file_exists("public/uploads/".$arrRForm["a07Imagen"])) { ?>
<?php if (end(explode(".", $arrRForm["a07Imagen"])) == "pdf") { ?>
              <iframe src="public/uploads/<?php echo $arrRForm["a07Imagen"]; ?>"></iframe>
<?php } else { ?>
              <img alt="Formulario" src="public/uploads/<?php echo $arrRForm["a07Imagen"]; ?>" class="img-responsive" width="100%">
<?php } ?>
<?php } else { ?>
              <div class="alert alert-danger">
                <h4>Error!</h4>
                <p>NO se encuentra la imagen del formulario</p>
              </div>
<?php } ?>
            </div>
          </div>
        </div>
      </div>
    </section>