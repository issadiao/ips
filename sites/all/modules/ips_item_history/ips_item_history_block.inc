<?php

function ips_item_history_block_info() {
  $blocks['item_history'] = array(
    'info' => t('Item History'),
    'cache' => DRUPAL_CACHE_PER_ROLE,
  );
  return $blocks;
}


function ips_item_history_block_view($delta = '') {

  switch ($delta) {
    case 'item_history':

      $block['subject'] = t('Item History');
      $block['content'] = "This is a test";
      break;

  }

  return $block;
}