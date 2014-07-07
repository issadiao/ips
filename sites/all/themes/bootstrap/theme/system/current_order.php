<?php if (isset($_SESSION['order'])) { ?>
  <div class="col-sm-12">
    <table class="table table-striped table-bordered table-condensed">
      <thead><tr><th>Item</th><th>Quantity</th></tr></thead>
      <tbody>
    <?php
    foreach (orderSession::displayItems() as $item) {
      echo "<tr><td>" . $item['title'] . "</td><td>" . $item['quantity'] . "</td></tr>";
    }
    ?>
      </tbody>
    </table>
  </div>
<?php } ?>