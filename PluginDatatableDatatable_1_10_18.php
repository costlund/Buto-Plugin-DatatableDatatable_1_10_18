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
    /**
     * Make export buttons smaller.
     */
    $element[] = wfDocument::createHtmlElement('style', ".dt-buttons button{font-size:10px}");
    /**
     * 
     */
    wfDocument::renderElement($element);
  }
  public static function widget_run($data){
    $id = wfArray::get($data, 'data/id');
    $data_json = new PluginWfArray(wfArray::get($data, 'data/json'));
    /**
     * 
     */
    if(!$data_json->get('language/url') && wfI18n::getLanguage()){
      $data_json->set('language/url', '/plugin/datatable/datatable_1_10_18/i18n/'.wfI18n::getLanguage().'.json');
    }
    /**
     * 
     */
    if($data_json->get()){
      $json = json_encode($data_json->get());
    }else{
      $json = json_encode(array());
    }
    $element = array();
    /**
     * Focus on search field.
     */
    $json = substr($json, 0, strlen($json)-1);
    $init_script = "if(document.getElementById('".$id."_filter') && document.getElementById('".$id."_filter').getElementsByTagName('input')){  document.getElementById('".$id."_filter').getElementsByTagName('input')[0].focus();   };";
    $json .= ',"initComplete": function(settings, json) {'.$init_script.'} }';
    /**
     * 
     */
    $element[] = wfDocument::createHtmlElement('script', "var datatable_$id; $(document).ready(function(){ datatable_$id = $('#$id').DataTable($json); });");
    /**
     * Position processing card just below the table.
     */
    $element[] = wfDocument::createHtmlElement('script', "$('.dataTables_processing').addClass('bg-info');");
    /*
     *
     */
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
    if(!$rs){
      $rs = array();
    }
    /**
     * 
     */
    if(!sizeof($field)){
      return json_encode(array('data' => $rs, 'client' => wfUser::hasRole('client')));
    }
    /**
     * 
     */
    $data = array();
    foreach ($rs as $value) {
      $row_data = new PluginWfArray($value);
      $temp = array();
      foreach ($field as $v2) {
        $temp[$v2] = $row_data->get($v2);
      }
      $data[] = $temp;
    }
    /**
     * 
     */
    return json_encode(array('data' => $data, 'client' => wfUser::hasRole('client')));
  }
}
