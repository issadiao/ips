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
   data VARCHAR(255) NOT NULL,
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

  $columns = array("nid", "uid", "status", "data");
  foreach ($columns as $column) {
    if ($message[$column] == FALSE) {
      drupal_set_message("logging failed. missing property $column");
      return FALSE;
    }
  }
  $nid = $message['nid'];
  $uid = $message['uid'];
  $cid = $user->field_company['und'][0]['target_id'];
  $status = $message['status'];
  $timestamp = time();
  $data = $message['data'];

  $query = db_query("INSERT INTO item_history (`nid`, `uid`, `company`, `status`, `data`, `timestamp`)
  VALUES ($nid, $uid, $cid, :status, :data, FROM_UNIXTIME($timestamp))
  ", array (":status" => $status,":data" => $data,));

  drupal_set_message("Log Message Recorded");
  return TRUE;

}