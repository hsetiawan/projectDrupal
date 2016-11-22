<?php
namespace Drupal\rest_api;

use Drupal\Component\Uuid\UuidInterface;

class RestApiModel
{


  static function getAll() {
   $result = db_query ( 'SELECT * FROM {file_store}' )->fetchAll ();
   return $result;
  }

  static function getDetail($id) {
   $result = db_query ( 'SELECT * FROM {file_store} WHERE flid = :id', array (':id' => $id )  )->fetchAllAssoc ( 'flid' );
   return $result;
  }

// 'row_count' => db_select($table_name)->countQuery()->execute()->fetchField(),

  static function add($UUID,$uri,$filename,$filemime,$filesize,$description) {
    db_insert ('file_store' )->fields ( array (
      'UUID' => $UUID,
      'uri' => $uri,
      'filename' => $filename,
      'filemime' => $filemime,
      'filesize' => $filesize,
      'description' => $description,
    ) )->execute ();
   }

   static function delete($id) {
    db_delete ( 'file_store' )->condition ( 'flid', $id )->execute ();
   }

   static function exists($id) {
    $result = db_query ( 'SELECT 1 FROM {file_store} WHERE flid = :id', array (':id' => $id ) )->fetchField ();
    return ( bool ) $result;
   }

   static function update($id,$data) {
    db_update('file_store' )->fields ($data)->condition('flid',$id)->execute();
   }


}


 ?>
