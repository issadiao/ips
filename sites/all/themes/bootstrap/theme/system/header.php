<?php
/**
 * Created by PhpStorm.
 * User: issa.diao
 * Date: 5/4/14
 * Time: 9:22 AM
 */
?>

<header id="navbar" role="banner" class="<?php print $navbar_classes; ?>">
  <div class="container">
    <div class="navbar-header">

      <?php

      // placeholder for logo

      // if ($logo):
      if (1 == 2):
        ?>
        <a class="logo navbar-btn pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        </a>
      <?php endif; ?>

<a class="name navbar-brand visible-xs visible-sm logo-small" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">RPL</a>
<a class="name navbar-brand visible-md visible-lg" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">Raptor Precision Logistics</a>

<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
  <span class="sr-only">Toggle navigation</span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
</button>
</div>

  <div class="navbar-collapse collapse navbar-right">
    <nav role="navigation">
        <?php print render($page['navigation']); ?>
    </nav>
  </div>

</div>
</header>