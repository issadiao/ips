<?php

class orderSession {

  private static $_sessionStarted = FALSE;

  public static function start() {
    if (self::$_sessionStarted == FALSE) {
      session_start();
      self::$_sessionStarted == TRUE;
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