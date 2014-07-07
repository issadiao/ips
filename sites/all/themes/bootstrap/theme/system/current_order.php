<?php if (isset($_SESSION['order'])) { ?>
  <div class="col-sm-12">
    <table>
      <tr><th>Item</th><th>Quantity</th></tr>
    <?php
    foreach (orderSession::displayItems() as $item) {
      echo "<tr><td>" . $item['title'] . "</td><td>" . $item['quantity'] . "</td></tr>";
    }
    ?>
    </table>
  </div>
<?php } ?>