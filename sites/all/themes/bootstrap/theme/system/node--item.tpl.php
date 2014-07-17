<div class="row">
  <div class="container">

<?php

$add_item_form = drupal_get_form('ips_orders_node_view_form', $node);
echo drupal_render($add_item_form);

if ($node->field_item_needs_repair['und'][0]['value'] == "no") {
  $repair_item_form = drupal_get_form('ips_repairs_node_view_form', $node);
  echo drupal_render($repair_item_form);
} else {
?>

  <div class="repair row col-xs-12">
  This item is in need of repair. See details here: <?php echo ips_repairs_item_repair_link($node->nid); ?>
  </div>

<?php } ?>

  </div>
</div>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print $user_picture; ?>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="submitted">
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

</div>
