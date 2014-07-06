<?php

class orderSession {

  public static function start() {
    if (!isset($_SESSION)) {
      session_start();
    }
  }

  public static function addItem($nid, $title, $quantity = 1) {
    $_SESSION['order'][$nid] = array(
      "title" => $title,
      "quantity" => $quantity,
    );
  }

  public static function displayItems() {
    if (isset($_SESSION['order'])) {
      $items = array();
      foreach ($_SESSION['order'] as $key => $item) {
        $items[$item[$key]] = $item['title'];
      }
      return $items;
    } else {
      return FALSE;
    }
  }



}