     <header>
      <nav class="navbar navbar-inverse navbar-menu" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#quimbo-nav">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url(); ?>">
              <img alt="Emgesa" src="public/img/logo.gif" class="img-responsive">
            </a>
          </div>
          <div class="collapse navbar-collapse" id="quimbo-nav">
            <ul class="nav navbar-nav navbar-right">
              <li<?php if ($stRPage == "home" || $stRPage == "search") { ?> class="active"<?php } ?>>
                <a href="<?php echo site_url("form/search"); ?>"><?php echo lang("TxtPageHome"); ?></a></li>
<?php if ($bolRIsLoggenIn) { ?>
              <li<?php if ($stRPage == "start") { ?> class="active"<?php } ?>>
                <a href="<?php echo site_url("form/start"); ?>"><?php echo lang("TxtPageStart"); ?></a></li>
              <li>
                <a href="<?php echo site_url("form/sync"); ?>">Sincronizar</a></li>
              <li>
                <a href="<?php echo site_url("user/do_logout"); ?>">Salir</a></li>
<?php } ?>
            </ul>
          </div>
        </div>
      </nav>
      <div class="breadcrumb-menu" style="height: 38px;">
        <div class="container">
          <ul class="breadcrumb col-md-offset-1 col-md-5">
            <li><a href="<?php echo site_url(); ?>">Inicio</a></li>
<?php if ($stRPage == "home") { ?>
            <li class="active">Iniciar Sesión</li>
<?php } if ($stRPage == "form") { ?>
            <li class="active"><?php echo lang("TxtPageForm"); ?></li>
<?php } if ($stRPage == "chapter") { ?>
            <li class="active">Capítulo <?php echo $arrRChapter["a02Letra"]; ?> - <?php echo $arrRChapter["a02Nombre"]; ?></li>
<?php } if ($stRPage == "done") { ?>
            <li class="active"><?php echo lang("TxtPageDone"); ?></li>
<?php } ?>
          </ul>

<?php if (!empty($inRFormID)) { ?>
          <div class="pull-right">
            <h3><span class="label label-info"><?php echo $inRFormID; ?></span>&nbsp;</h3>
          </div>
<?php } ?>
        </div>
      </div>
    </header>
