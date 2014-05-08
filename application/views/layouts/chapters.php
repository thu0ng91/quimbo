            <div class="well-container col-md-offset-8 chapters-menu">
              <ul class="nav nav-pills nav-stacked">
<?php foreach($arrRChapters as $arrLChapter) { ?>
                <li <?php if ($arrLChapter["a02Letra"] == $arrRChapter["a02Letra"]) { ?>class="active"<?php } ?>>
                  <a href="<?php echo site_url("form/chapter/".$arrLChapter["a02Letra"]); ?>"><?php echo $arrLChapter["a02Letra"]." - ".$arrLChapter["a02Nombre"]; ?></a>
                </li>
<?php } ?>
              </ul>
            </div>
