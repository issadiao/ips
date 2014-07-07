<?php

class orderSession {

  public static function start() {
    if (!isset($_SESSION)) {
      session_start();
    }
  }

  public static function addItem($nid, $title, $quantity = 1) {
    if (isset($_SESSION['order'][$nid])) {
      $_SESSION['order'][$nid]['quantity'] = $_SESSION['order'][$nid]['quantity'] + $quantity;
    } else {
      $_SESSION['order'][$nid] = array(
        "title" => $title,
        "quantity" => $quantity,
      );
    }
  }

  public static function displayItems() {
    if (isset($_SESSION['order'])) {
      $items = array();
      foreach ($_SESSION['order'] as $key => $item) {
        $items[$key] = array(
          "title" => $item['title'],
          "quantity" => $item['quantity'],
        );
      }
      return $items;
    } else {
      return FALSE;
    }
  }



}