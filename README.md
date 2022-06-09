# Buto-Plugin-DatatableDatatable_1_10_18
Build for Bootstrap 4 usage.
Add sort, paging and search methods to a html table via Javascript. Also export to csv, excel, pdf.

## Include widget
Include widget in head section.
```
type: widget
data:
  plugin: datatable/datatable_1_10_18
  method: include
```

## Table and Run widget
Add widget after table. Set id param of your table. Param ajax is optional.

### Table
A simple table with one column.
```
-
  type: table
  attribute:
    class: table
    id: table_member
  innerHTML:
    -
      type: thead
      innerHTML:
        -
          type: tr
          innerHTML:
            -
              type: th
              innerHTML: Name
    -
      type: tbody
      innerHTML:
```
#### Responsive table
Put table in div element with class table-responsive.
```
type: div
attribute:
  class: table-responsive
innerHTML: ...
```

### Run widget
Transform table to a Datatable with a widget.
```
-
  type: widget
  data:
    plugin: datatable/datatable_1_10_18
    method: run
    data:
      id: table_member
      json:
        ajax: /path/ajax_test
        paging: true
        ordering: true
        info: true
        searching: true
        order:
          -
            - 0
            - desc
        _dom: Blfrtip
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>><'row'<'col-sm-12 col-md-6'B>>"
        buttons:
          -
             extend: excel
             title: My title
          -
             extend: pdf
             title: My title
          - csv
          - copy
        columnDefs:
          -
            targets: 
             - 0
            visible: false
            searchable: false
```
One could set translation file. But this is set automatic to current language.
```
    data:
        language:
          url: /plugin/datatable/datatable_1_10_18/i18n/Swedish.json
```

#### Object
An object is created named depending on id parameter. 
One could use this to reload, get/set data in rows.
```
      id: table_member
```
Object name.
```
datatable_table_member
```

#### Ajax
When using param ajax. This example show how a page should be set. Copy code and make changes.
```
public function page_ajax_test(){
  /**
   * Including Datatable
   */    
  wfPlugin::includeonce('datatable/datatable_1_10_18');
  $datatable = new PluginDatatableDatatable_1_10_18();
  /**
   * Data
   */    
  $data = array(array('id' => 1, 'name' => 'John'), array('id' => 2, 'name' => 'Jane'));
  /**
   * Render all data
   */    
  exit($datatable->set_table_data($data));
  /**
   * Render only name
   */    
  exit($datatable->set_table_data($data, array('name')));
}
```
#### Reload
Reload table.
```
var table = $('#table_member').DataTable();table.ajax.reload();
```
```
$('#table_member').DataTable().ajax.reload();
```

#### Click
Row click.
```
$('#table_member tbody').on( 'click', 'tr', function () {
    console.log( this ); //Set this to a variable to be able to remove (_this_).
    console.log( datatable_table_member.row( this ).index() );
    console.log( datatable_table_member.row( this ).data() );
} );
```

#### Update
Update row.
In this example we asume row data has parameter name.
```
var index = datatable_table_member.row(this).index();
var data = datatable_table_member.row(this).data();
data.name = 'James';
datatable_table_member.row(index).data( data ).draw();
```

#### Delete
Delete row.
```
datatable_table_member.row(_this_).remove().draw();
```

#### Custom paging
One could set custom page length options.
```
lengthMenu:
  -
    - 10
    - 25
    - 50
    - 100
    - 500
    - '-1'
  -
    - 10
    - 25
    - 50
    - 100
    - 500
    - All
```

#### Dom
Use dom param to modify element position.
```
dom: "<'row'<'col-sm-6'l><'col-sm-6'f>><'row'<'col-sm-5'i><'col-sm-7'p>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>"
```

#### Hidden columns
By using param columnDefs one could hide columns and also make them not searchable.

## Javascript example
This example first add a table and then handle Datatable with Javascript only.
It will initialise Datatable twice. 
First to only make it look like a Datatable and second to add data and declare columns.

### Table
A simple table.
```
type: widget
data:
  plugin: wf/table
  method: render_many
  data:
    id: test
    class:
      table: table-sm table-striped
    field:
      name: Name
      sys: Sys
      city: City
      number: Number
      date: Date
      amount: Amount
    datatable:
      order:
        -
          - 0
          - asc
```

### Javascript
One should use some Ajax request to pic up some data.
But in this example we hard coded the data.
```
$(document).ready(function ()
{
  /**
   * dataSet
   */
  var dataSet = [
    {"name": "Tiger Nixon", "sys": "System Architect", "city": "Edinburgh", "number": "5421", "date": "2011/04/25", "amount": "$320,800"},
    {"name": "John Max", "sys": "System Architect", "city": "Edinburgh", "number": "5421", "date": "2011/04/25", "amount": "$320,800"},
    {"name": "Lisa Nilsson", "sys": "System Architect", "city": "Edinburgh", "number": "5421", "date": "2011/04/25", "amount": "$320,800"}
  ];
  /**
   * columns
   */
  var columns = 
  [
    { data: "name" },
    { data: "sys" },
    { data: "city" },
    { data: "number" },
    { data: "date" },
    { data: "amount" }
  ]
  ;
  /**
   * First initialisation to make table have Datatable look
   */
  var dt = $('#test').DataTable();
  $('#_my_test_button_').on('click',function(){
    /**
     * Second initialisation to add data and declare columns.
     */
    dt.destroy();
    dt = $('#test').DataTable({
      data: dataSet,
      columns: columns
    });
  });
});
```

## I18N
Pic up I18N content.
```
https://datatables.net/plug-ins/i18n/
```
