<?php

class MGMasterDesktopAR extends ActiveRecord\Model {

  static $table_name = "mgaptbeli";
  var $table_name_custom = "mgaptbeli";
  
  var $field_pk = "IdTBeli";
  var $field_hapus = "Hapus";  // soft delete
  var $active_field = "";
  
  var $table_fields = array(
    array(
      'Label' => 'IdTBeli',
      'Column' => 'idtbeli',  // harus huruf kecil
      'Type' => 'Browse',
      'BrowseModule' => 'Customer',
      'Required' => true,
      'Name' => 'IdTBeli',
      'Position' => 'left',
      'Group' => 'Id',
      'Class' => '',
      'Attributes' => '',
      'Placeholder' => '',
      'ShowInList' => true
    ),
    array(
      'Label' => 'BuktiTBeli',
      'Column' => 'buktitbeli',
      'Type' => 'text',
      'Required' => true,
      'Name' => 'BuktiTBeli',
      'Position' => 'left',
      'Group' => 'Id',
      'Class' => '',
      'Attributes' => '',
      'Placeholder' => '',
      'ShowInList' => true,
      'DefaultValue' => 123
    ),
    array(
      'Label' => 'BuktiAsli',
      'Column' => 'buktiasli',
      'Type' => 'text',
      'Required' => true,
      'Name' => 'BuktiAsli',
      'Position' => 'left',
      'Group' => 'Id',
      'Class' => '',
      'Attributes' => '',
      'Placeholder' => '',
      'ShowInList' => true,
      'DefaultValue' => 678
    ),
    array(
      'Label' => 'TglTBeli',
      'Column' => 'tgltbeli',
      'Type' => 'Date',
      'Required' => true,
      'Name' => 'TglTBeli',
      'Position' => 'left',
      'Group' => 'Detail',
      'Class' => '',
      'Attributes' => '',
      'Placeholder' => '',
      'ShowInList' => true
    )
  );
  var $table_relations = array(
      //array('Table' => 'user_data', 'On' => 'user_data.ID=shipper_data.ID', 'Type' => 'LEFT')
  );

  function getPk() {
    return $this->table_name_custom . "." . $this->field_pk;
  }

  function getID() {
    $sql = "SELECT MAX(" . $this->field_pk . ") as idrow FROM " . $this->table_name_custom . "";
    $find = self::find_by_sql($sql); 
    return $find[0]->idrow + 1;
  }

  function getColumns() {
    $arr = array();
    foreach ($this->table_fields as $row) {
      if ($row['Type'] == 'Hidden') {
        continue;
      }
      if (!$row['ShowInList']) {
        continue;
      }
      $arr[] = $row;
    }
    return $arr;
  }

  function getFields() {
    $arr = array(self::getPk());
    foreach ($this->table_fields as $row) {
      if ($row['Type'] == 'Hidden') {
        continue;
      }
      if (!$row['ShowInList']) {
        continue;
      }
      if ($row['Type'] == 'Date') {
        $row['Name'] = "DATE(" . $row['Name'] . ")";
      }
      $arr[] = $row['Name'];
    }
    return implode(", ", $arr);
  }

  function getRelations() {
    $str = '';
    foreach ($this->table_relations as $row) {
      $str .= $row['Type'] . " JOIN " . $row['Table'] . " ON " . $row['On'] . " ";
    }
    return $str;
  }

  function search($params) {
    $filter_field1 = isset($params['FilterField1']) && $params['FilterField1'] ? $params['FilterField1'] : "";
    $filter_by1 = isset($params['FilterBy1']) && $params['FilterBy1'] ? $params['FilterBy1'] : "";
    $filter_value1 = isset($params['FilterValue1']) && $params['FilterValue1'] ? $params['FilterValue1'] : "";

    if ($filter_field1 && $filter_by1 && $filter_by1 == 'LIKE') {
      $filter_value1 = "'%$filter_value1%'";
    }

    $filter_link = isset($params['FilterLink']) && $params['FilterLink'] ? $params['FilterLink'] : "";

    $filter_field2 = isset($params['FilterField2']) && $params['FilterField2'] ? $params['FilterField2'] : "";
    $filter_by2 = isset($params['FilterBy2']) && $params['FilterBy2'] ? $params['FilterBy2'] : "";
    $filter_value2 = isset($params['FilterValue2']) && $params['FilterValue2'] ? $params['FilterValue2'] : "";
    if ($filter_field2 && $filter_by2 && $filter_by2 == 'LIKE') {
      $filter_value2 = "'%$filter_value2%'";
    }

    $filter_active = isset($params['Active']) && $this->active_field ? "AND " . $this->table_name_custom . "." . $this->active_field . "=1" : "";
    $filter_hapus = " (".$this->field_hapus."=0 OR ".$this->field_hapus." IS NULL) ";

    $filter_str = "$filter_field1 $filter_by1 $filter_value1 $filter_link $filter_field2 $filter_by2 $filter_value2 $filter_active";

    $filter = str_replace(" ", "", $filter_str) ? "WHERE $filter_str AND $filter_hapus" : "WHERE $filter_hapus";
    //$filter = " WHERE $filter_hapus $filter_str ";

    $filter .= isset($params['OrderField']) && $params['OrderField'] ? " ORDER BY " . $params['OrderField'] : "";
    $filter .= isset($params['OrderType']) && " " . $params['OrderType'] ? " " . $params['OrderType'] : "";
    $limit = isset($params['Limit']) && $params['Limit'] ? $params['Limit'] : 50;
    $page = isset($params['Page']) && $params['Page'] ? $params['Page'] : 1;
    $offset = $page ? ($page - 1) * $limit : 0;
    $fields = self::getFields();
    $joins = self::getRelations();
    $table = $this->table_name_custom;
    $sql = "SELECT $fields FROM $table $joins $filter LIMIT $limit OFFSET $offset";
//    echo $sql;die();
    $sql_count = "SELECT $fields FROM $table $joins $filter";
    $count = count(self::find_by_sql($sql_count));
    $last = $count % $limit > 0 ? (int) ($count / $limit) + 1 : (int) ($count / $limit);
    $navigation = array(
      'Next' => $last > 1 && $last != $page ? $page + 1 : $page,
      'Prev' => $page && $page > 1 ? $page - 1 : 1,
      'First' => 1,
      'Last' => $last
    );
    $list_data = self::find_by_sql($sql);
    return array('list_data' => $list_data, 'navigation' => $navigation, 'count' => $count);
  }

  function getOneData($id) {
    $arr = array();
    foreach ($this->table_fields as $row) {
      if ($row['Name'] == $this->field_pk) {
        $arr[] = self::getPk();
      } else {
        if ($row['Type'] == 'Date') {
          $row['Name'] = "DATE(" . $row['Name'] . ") as " . $row['Name'];
        }
        $arr[] = $row['Name'];
      }
    }
    $fields = implode(", ", $arr);
    $sql = "SELECT $fields from " . $this->table_name_custom . " " . self::getRelations() . " WHERE " . self::getPk() . "=$id";
    $find = self::find_by_sql($sql);
    // convert array
    if(sizeof($find)){
      $arr = $find[0]->attributes();
      foreach($arr as $idx => $row){
        if ($row instanceof \DateTime) {
          //echo $idx.' '.$row;
          $row = $row->format('Y-m-d H:i:s');
        }
        $arr[$idx] = $row;
      }
      return $arr;
    }
    return array();
    //return sizeof($find) ? $find[0]->attributes() : array();
  }

  function getListForm() {
    $id = new ArrayList();
    $left = new ArrayList();
    $right = new ArrayList();
    $hidden = new ArrayList();
    foreach ($this->table_fields as $row) {
      $field = '';
      $row['Column'] = $row['Column'] ? $row['Column'] : strtolower($row['Name']);
      $required = $row['Required'] ? "required" : "";
      $required_flag = $row['Required'] ? "<sup style='color: red;'>*</sup>" : "";
      $default_val = '';
      if(isset($row['DefaultValue'])){
        $default_val = $row['DefaultValue'];
      }
      if ($row['Type'] == 'Hidden') {
        $field = '<input value="0" id="' . $row['Column'] . '" id="' . $row['Name'] . '" type="' . $row['Type'] . '" name="' . $row['Name'] . '" class="' . $row['Class'] . '" value="'.$default_val.'">';
      } elseif ($row['Type'] == 'select') {
        $field = '<td style="width:40%;" class="td-label-form">' . $row['Label'] . $required_flag . '</td>';
        $field .= '<td>: <select ' . $required . ' name="' . $row['Name'] . '" class="' . $row['Class'] . '">';
        $field .= '<option>Pilih ' . $row['Label'] . '</option>';
        foreach ($row['Options'] as $key => $val) {
          $field .= '<option value="' . $key . '">' . $val . '</option>';
        }
        $field .= '</select></td>';
      } elseif ($row['Type'] == 'Browse') {
        $module = $row['BrowseModule'];
        $field = '<td style="width:40%;" class="td-label-form">' . $row['Label'] . $required_flag . '</td>'
            . '<td>: <input ' . $required . ' id="' . $row['Column'] . '" ' . $row['Attributes'] . ' type="' . $row['Type'] . '" class="' . $row['Class'] . ' input-browse" placeholder="' . $row['Placeholder'] . '" data-module="'.$module.'" value="'.$default_val.'"></td>';
      } elseif ($row['Type'] == 'Date') {
        $field = '<td style="width:40%;" class="td-label-form">' . $row['Label'] . $required_flag . '</td>'
            . '<td>: <input ' . $required . ' id="' . $row['Column'] . '" ' . $row['Attributes'] . ' type="text" name="' . $row['Name'] . '" class="' . $row['Class'] . ' datepicker" placeholder="' . $row['Placeholder'] . '" value="'.$default_val.'"></td>';
      } elseif ($row['Type'] == 'Number') {
        $field = '<td style="width:40%;" class="td-label-form">' . $row['Label'] . $required_flag . '</td>'
            . '<td>: <input type="hidden" class="clear" name="' . $row['Name'] . '">'
            . '<input ' . $required . ' id="' . $row['Column'] . '" ' . $row['Attributes'] . ' type="text" class="' . $row['Class'] . ' numeric" placeholder="' . $row['Placeholder'] . '" value="'.$default_val.'"></td>';
      } elseif ($row['Type'] == 'Text') {
        $field = '<td style="width:40%;" class="td-label-form">' . $row['Label'] . $required_flag . '</td>'
            . '<td>: <textarea ' . $required . ' name="' . $row['Name'] . '" id="' . $row['Column'] . '" ' . $row['Attributes'] . ' class="' . $row['Class'] . '" placeholder="' . $row['Placeholder'] . '">'.$default_val.'</textarea></td>';
      } else {
        $field = '<td style="width:40%;" class="td-label-form">' . $row['Label'] . $required_flag . '</td>'
            . '<td>: <input ' . $required . ' id="' . $row['Column'] . '" ' . $row['Attributes'] . ' type="' . $row['Type'] . '" name="' . $row['Name'] . '" class="' . $row['Class'] . '" placeholder="' . $row['Placeholder'] . '" value="'.$default_val.'"></td>';
      }
      $row['Field'] = $field;
      if ($row['Group'] == 'Id' && $row['Type'] == 'Hidden') {
        $hidden->push($row);
      } elseif ($row['Group'] == 'Id') {
        $id->push($row);
      } elseif ($row['Group'] == 'Detail' && $row['Position'] == 'left') {
        $left->push($row);
      } elseif ($row['Group'] == 'Detail' && $row['Position'] == 'right') {
        $right->push($row);
      }
    }
    return array(
      'Id' => $id,
      'Hidden' => $hidden,
      'Left' => $left,
      'Right' => $right
    );
  }
  
  function convertRow($arr) {
    foreach ($arr as $idx => $row) {
      //echo $idx.' '.$row.'<br>';
      foreach ($this->table_fields as $idx_col => $col) {
        if (strtolower($col['Column']) == $idx) {
          $arr[$col['Column']] = $row;
          // date time          
          if ($row instanceof \DateTime) {
            //echo 'yeah';die();
            $arr[$col['Column']] = $row->format('Y-m-d H:i:s');
          }
//          if ($col['Type'] == 'File') {
//            $arr[$col['Column'] . '_Preview'] = $row;
//          }
          continue;
        }
      }
    }
    return $arr;
  }

}
