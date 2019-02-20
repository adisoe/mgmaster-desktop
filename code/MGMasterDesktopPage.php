<?php

//include '../ilham-crud/code/IlhamSetting.php';

class MGMasterDesktopPage extends Page {

  var $page_class = 'MGMasterDesktopPage';

  function requireDefaultRecords() {
    $class = $this->page_class;
//    if($class == 'CobaIlhamPage'){
//      var_dump($class).' ';die();
//    }
    if (!DataObject::get_one($class)) {
      $page = new $classs();
      $page->Title = $class;
      $page->URLSegment = strtolower($class);
      $page->Status = 'Published';
      $page->write();
      $page->publish('Stage', 'Live');
      $page->flushCache();
      DB::alteration_message($class . ' created on page tree', 'created');
    }
    parent::requireDefaultRecords();
  }
  
}

class MGMasterDesktopPage_Controller extends Page_Controller {

  var $table_class = 'MGMasterDesktopAR';
  private static $allowed_actions = array(
      'getonedatajson',
      'savedata',
      'deletedata',
      'search_ajax',
      'test'
  );


  public function index() {
    $table_class = $this->table_class;
    //var_dump($setting_page_class);
    //$data = IlhamDataAR::search($_REQUEST);
    //$data = call_user_func(array($this->table_class, 'search'), $_REQUEST);
    $table = new $table_class();
    $data = $table->search($_REQUEST);
    $arrList = new ArrayList();
    foreach ($data['list_data'] as $row) {
      $arrList->push($row->attributes());
    }
    $arrField = new ArrayList($table->getColumns());
    //echo '<pre>';var_dump($arrField);
    return $this->customise(array(
                'listData' => $arrList,
                'listField' => $arrField,
                'Filter' => $_REQUEST,
                'Navigation' => $data['navigation'],
                'Count' => $data['count'],
                //'Form' => IlhamDataAR::getListForm(),
                //'Form' => call_user_func(array($this->table_class, 'getListForm')),
                'Form' => $table->getListForm(),
                'ActiveField' => $table->active_field
            ))->renderWith(array('CrudPage', 'IlhamPage'));
  }

  public function test() {
    return $this->renderWith(array('CrudPage', 'IlhamPage'));
  }

  public function search_ajax() {
    //$data = IlhamDataAR::search($_REQUEST);
    //echo $this->table_class;
    //$data = call_user_func(array($this->table_class, 'search'), $_REQUEST);
    $table_class = $this->table_class;
    $table = new $table_class();
    $data = $table->search($_REQUEST);
    $arr = array();
    foreach ($data['list_data'] as $row) {
      $arr[] = array_values($row->attributes());
    }
    $data['list_data'] = $arr;
    echo json_encode($data);
  }

  public function getonedatajson() {
    $id = isset($_POST['id']) && $_POST['id'] ? $_POST['id'] : 1;
    //$data = IlhamDataAR::getOneData($id);
    $table_class = $this->table_class;
    $table = new $table_class();
    //$data = call_user_func(array($this->table_class, 'getOneData'), $id);
    $data = $table->getOneData($id);
    echo json_encode($data);
  }

  public function savedata() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $table_class = $this->table_class;
      $table = new $table_class();
      $data = $_REQUEST;
      unset($data['url']);
      $table_class = $this->table_class;
      $id = isset($data[$table->field_pk]) && $data[$table->field_pk] ? $data[$table->field_pk] : 0;
      if ($id) {
        // Untuk update data
        // Bisa ditambahkan input data lain 
        //$obj = IlhamDataAR::find(array(IlhamDataAR::$field_pk => $id));
        $obj = call_user_func(array($this->table_class, 'find'), array($table->field_pk => $id));
        //$obj = $table->find(array($table->field_pk => $id));
        $obj->update_attributes($data);
      } else {
        // Untuk simpan data baru 
        // Bisa ditambahkan input data lain 
        $data['IdMCabang'] = 0;
        //$data[$table->field_pk] = IlhamDataAR::getID();
        $data[$table->field_pk] = $table->getID();
        $obj = new $table_class($data);
      }
      $obj->save();
    }
  }

  public function deletedata() {
    $id = isset($_POST['id']) && $_POST['id'] ? $_POST['id'] : 0;
    //$data = IlhamDataAR::find(array(IlhamDataAR::$field_pk => $id));
    $table_class = $this->table_class;
    $table = new $table_class();
    $obj = call_user_func(array($this->table_class, 'find'), array($table->field_pk => $id));
    $obj->hapus = 1;
    $obj->save();
    //$data->delete();
  }

}
