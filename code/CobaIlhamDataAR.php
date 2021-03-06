<?php

class CobaIlhamDataAR extends MGMasterDesktopAR{
  static $table_name = "mgartjual";
  var $table_name_custom = "mgartjual";
  var $field_pk = "IdTJual";
  var $field_hapus = "Hapus";
  
  var $table_fields = array(
    array(
      'Label' => 'IdTJual',
      'Column' => 'idtjual',  // harus huruf kecil
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
      'Label' => 'BuktiTJual',
      'Column' => 'buktitjual',
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
      'Label' => 'NamaKirim',
      'Column' => 'namakirim',
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
      'Label' => 'TglTJual',
      'Column' => 'tgltjual',
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

