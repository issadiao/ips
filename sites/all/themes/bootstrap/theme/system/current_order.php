<?php if (isset($_SESSION['order'])) { ?>
  <div class="col-sm-12">
    <?php
    print_r(orderSession::displayItems());
    ?>
  </div>
<?php } ?>