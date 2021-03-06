<?php

/*
 $log_message = array(
 "nid" => "",
 "uid" => "",
 "status" => "",
 "data" => "",
 );
ips_item_history_db_insert($log_message);
 *
 * HISTORY LOG TABLE STRUCTURE:
 *
 * ID (auto increment)
 * node ID
 * user ID
 * company ID
 * status
 * timestamp
 * data (text) field
 *
 * Status Options:
 *  - Item Created
 *  - Added to order #
 *  - Removed from order #
 *  - Checked Out
 *  - Checked In
 *  - Needs repair
 *  - Repair Completed
 *  - Location Change
 *  - Department Change
 *
 *
 *  CREATE TABLE item_history(
   id INT NOT NULL AUTO_INCREMENT,
   nid INT NOT NULL,
   uid INT NOT NULL,
   company INT NOT NULL,
   status VARCHAR(100) NOT NULL,
   data TEXT NOT NULL,
   timestamp DATETIME NOT NULL,
   PRIMARY KEY ( id ),
   INDEX nid ( nid ),
   INDEX uid ( uid ),
   INDEX company ( company )
);

 */

function ips_item_history_db_insert($message) {

  global $user;
  $user = user_load($user->uid);
  if (isset($user->field_parent_company['und'][0]['target_id'])) {
    $company = $user->field_parent_company['und'][0]['target_id'];
  } else {
    // user company failed, get company from item
    $item = node_load($message['nid']);
    if (isset ($item->field_parent_company['und'][0]['target_id'])) {
      $company = $item->field_parent_company['und'][0]['target_id'];
    }
  }
  if (empty($company)) {
    $company = 0;
  }

  $columns = array("nid", "uid", "status", "data");
  foreach ($columns as $column) {
    if ($message[$column] === FALSE) {
      drupal_set_message("logging failed. missing property $column");
      return FALSE;
    }
  }
  $nid = $message['nid'];
  $uid = $message['uid'];
  $cid = $company;
  $status = $message['status'];
  $timestamp = time();
  $data = $message['data'];

  if (empty($data)) {
    return FALSE;
  } else {
    $query = db_query("INSERT INTO item_history (`nid`, `uid`, `company`, `status`, `data`, `timestamp`)
    VALUES ($nid, $uid, $cid, :status, :data, FROM_UNIXTIME($timestamp))
    ", array (":status" => $status,":data" => $data,));

    return TRUE;
  }

}


// update item_history on node save
function ips_item_history_node_update($node) {

  $fields = array();
  $originals = array();
  $diff = array();
  $message = '';

  foreach ($node as $key => $field) {
    if (substr($key, 0, 6) == "field_") {
      if (isset($field['und'][0]['value'])) {
        $fields[$key] = $field['und'][0]['value'];
      }
      if (isset($field['und'][0]['target_id'])) {
        $fields[$key] = $field['und'][0]['target_id'];
      }
    }
  }

  foreach ($node->original as $key => $original) {
    if (substr($key, 0, 6) == "field_") {
      if (isset($original['und'][0]['value'])) {
        $originals[$key] = $original['und'][0]['value'];
      }
      if (isset($original['und'][0]['target_id'])) {
        $originals[$key] = $original['und'][0]['target_id'];
      }
    }
  }

  $diff = array_diff_assoc($originals, $fields);
  foreach ($diff as $key => $value) {
    $message .= "$key was changed from " . ips_item_history_data_field_nid_to_title($key, $value) . "<br>";
  }
  $diff = array_diff_assoc($fields, $originals);
  foreach ($diff as $key => $value) {
    $message .= "$key was changed to " . ips_item_history_data_field_nid_to_title($key, $value) . "<br>";
  }

  $message = str_replace("field_item_", "", $message);

  $log_message = array(
    "nid" => $node->nid,
    "uid" => $node->uid,
    "status" => "Item Updated",
    "data" => $message,
  );
  ips_item_history_db_insert($log_message);

}

function ips_item_history_data_field_nid_to_title($key, $value) {

  if (!is_numeric($value)) {
    return $value;
  }

  $table_name = "field_data_" . $key;
  $column_name = $key . "_value";
  $title = $value;

  // make this work for "Value" or "target id"
  $table_check = db_query("SHOW COLUMNS FROM $table_name LIKE '$column_name'");
  $exists = ($table_check->rowCount()) ? TRUE : FALSE;
  if (!$exists) {
    $column_name = $key . "_target_id";
    $table_check2 = db_query("SHOW COLUMNS FROM $table_name LIKE '$column_name'");
    $exists = ($table_check2->rowCount()) ? TRUE : FALSE;
  }
  if (!$exists) {
    return $value;
  }

  $query = "SELECT n.title
  FROM node n, $table_name t
  WHERE n.nid = t.$column_name
  AND t.$column_name = $value";

  $result = db_query($query);

  foreach ($result as $record) {
    $title = $record->title;
  }

  return $title;

}