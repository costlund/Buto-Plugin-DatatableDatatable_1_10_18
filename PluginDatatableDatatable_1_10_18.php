<?php
class PluginDatatableDatatable_1_10_18{
  /**
   * Downloading options.
   * Step 1: Bootstrap 4
   * Step 2: DataTables
   * Extensions: Buttons, HTML5 Export (JSZip, pdfmaker)
   * Step 3: Download (Minify) 
   */
  public function widget_include($data){
    $element = array();
    $web_dir = '/plugin/datatable/datatable_1_10_18';
    $link = array(
        'DataTables-1.10.18/css/dataTables.bootstrap4.min.css',
        'Buttons-1.5.6/css/buttons.bootstrap4.min.css'
        );
    foreach ($link as $key => $value) {
      $element[] = wfDocument::createHtmlElement('link', null, array('href' => $web_dir.'/'.$value, 'rel' => 'stylesheet'));
    }
    $script = array(
        'JSZip-2.5.0/jszip.min.js',
        'pdfmake-0.1.36/pdfmake.min.js',
        'pdfmake-0.1.36/vfs_fonts.js',
        'DataTables-1.10.18/js/jquery.dataTables.min.js',
        'DataTables-1.10.18/js/dataTables.bootstrap4.min.js',
        'Buttons-1.5.6/js/dataTables.buttons.min.js',
        'Buttons-1.5.6/js/buttons.bootstrap4.min.js',
        'Buttons-1.5.6/js/buttons.html5.min.js'
        );
    foreach ($script as $key => $value) {
      $element[] = wfDocument::createHtmlElement('script', null, array('src' => $web_dir.'/'.$value, 'type' => 'text/javascript'));
    }
    wfDocument::renderElement($element);
  }
  public static function widget_run($data){
    $id = wfArray::get($data, 'data/id');
    $json = wfArray::get($data, 'data/json');
    if($json){
      $json = json_encode($json);
    }else{
      $json = array();
    }
    $element = array();
    $element[] = wfDocument::createHtmlElement('script', "var datatable_$id; $(document).ready(function(){ datatable_$id = $('#$id').DataTable($json); });");
    wfDocument::renderElement($element);
  }
  /**
   * 
   * @param array $rs Ajax data.
   * @param array $field Restrict fields.
   * @return json
   */
  public function set_table_data($rs, $field = array()){
    /**
     * 
     */
    $data = array();
    /**
     * 
     */
    foreach ($rs as $value) {
      $row_data = new PluginWfArray($value);
      $temp = array();
      if(!sizeof($field)){
        /**
         * All data used because no $field is empty.
         */
        foreach ($row_data->get() as $v2) {
          $temp[] = $v2;
        }
      }else{
        /**
         * Restrict to param $field.
         */
        foreach ($field as $v2) {
          $temp[] = $row_data->get($v2);
        }
      }
      $data[] = $temp;
    }
    /**
     * 
     */
    return json_encode(array('data' => $data));
  }
}
