<?php

class CobaIlhamDataAR extends MGMasterDesktopAR{
  static $table_name = "mgartjual";
  var $table_name_custom = "mgartjual";
  var $field_pk = "IdTJual";
  var $field_hapus = "Hapus";
  
  var $table_fields = array(
    array(
      'Title' => 'IdTJual',
      'ID' => 'idtjual',  // harus huruf kecil
      'Type' => 'browse',
      'BrowseModule' => 'Customer',
      'Required' => true,
      'Name' => 'IdTJual',
      'Position' => 'left',
      'Group' => 'Id',
      'Class' => '',
      'Attributes' => '',
      'Placeholder' => '',
      'ShowInList' => true
    ),
    array(
      'Title' => 'BuktiTJual',
      'ID' => 'buktitjual',
      'Type' => 'text',
      'Required' => true,
      'Name' => 'BuktiTJual',
      'Position' => 'left',
      'Group' => 'Id',
      'Class' => '',
      'Attributes' => '',
      'Placeholder' => '',
      'ShowInList' => true,
      'DefaultValue' => 123
    ),
    array(
      'Title' => 'NamaKirim',
      'ID' => 'namakirim',
      'Type' => 'text',
      'Required' => true,
      'Name' => 'NamaKirim',
      'Position' => 'left',
      'Group' => 'Id',
      'Class' => '',
      'Attributes' => '',
      'Placeholder' => '',
      'ShowInList' => true,
      'DefaultValue' => 678
    ),
    array(
      'Title' => 'TglTJual',
      'ID' => 'tgltjual',
      'Type' => 'date',
      'Required' => true,
      'Name' => 'TglTJual',
      'Position' => 'left',
      'Group' => 'Detail',
      'Class' => '',
      'Attributes' => '',
      'Placeholder' => '',
      'ShowInList' => true
    )
  );
}

?>

