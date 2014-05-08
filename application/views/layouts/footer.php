    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-7 col-xs-9 footer-by">
            <strong>&copy; 2014 <?php if (date("Y") > "2014") echo " - ".date("Y"); ?></strong>| Desarrollado para:
            <a href="<?php echo site_url(); ?>" title="Emgesa">Emgesa</a>
            <span class="pull-right"><img alt="MG Group" src="public/img/vortex.png" class="img-responsive" width="90"></span>
          </div>
          <div class="col-md-1 pull-right">
            <a href="//www.mggroup.com.co" title="MG Group" class="text-muted">
              <img alt="MG Group" src="public/img/mg.png" class="img-responsive" width="90">
            </a>
          </div>
        </div>
      </div>
    </footer>
    <script src="public/js/jquery-1.11.0.min.js" type="text/javascript"></script>
    <script src="public/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/js/jquery.form.js" type="text/javascript"></script>
    <script src="public/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="public/js/quimbo.js" type="text/javascript"></script>
<?php if (file_exists("public/js/".$stRView."/".strtolower($stRPage).".js")) { ?>
    <script src="public/js/<?php echo $stRView."/".strtolower($stRPage); ?>.js" type="text/javascript"></script>
<?php } ?>
  </body>
</html>