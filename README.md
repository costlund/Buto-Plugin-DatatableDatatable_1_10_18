# Buto-Plugin-DatatableDatatable_1_10_18

<p>Build for Bootstrap 4 usage.
Add sort, paging and search methods to a html table via Javascript. Also export to csv, excel, pdf.</p>

<a name="key_0"></a>

## Widgets



<a name="key_0_0"></a>

### include

<p>Include widget in head section.</p>
<pre><code>type: widget
data:
  plugin: datatable/datatable_1_10_18
  method: include</code></pre>

<a name="key_0_1"></a>

### run

<p>Transform table to a Datatable with a widget.</p>
<pre><code>type: widget
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
      searching_focus: false
      order:
        -
          - 0
          - desc
      _dom: Blfrtip
      dom: "&lt;'row'&lt;'col-sm-12 col-md-6'l&gt;&lt;'col-sm-12 col-md-6'f&gt;&gt;&lt;'row'&lt;'col-sm-12'tr&gt;&gt;&lt;'row'&lt;'col-sm-12 col-md-5'i&gt;&lt;'col-sm-12 col-md-7'p&gt;&gt;&lt;'row'&lt;'col-sm-12 col-md-6'B&gt;&gt;"
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
          searchable: false</code></pre>
<p>One could set translation file. But this is set automatic to current language.</p>
<pre><code>      language:
        url: /plugin/datatable/datatable_1_10_18/i18n/Swedish.json</code></pre>
<p>Responsive table.</p>
<p>Put table in div element with class table-responsive.</p>
<pre><code>type: div
attribute:
  class: table-responsive
innerHTML: ...</code></pre>
<p>Object.</p>
<p>An object is created named depending on id parameter. 
One could use this to reload, get/set data in rows.</p>
<pre><code>    id: table_member</code></pre>
<p>Object name.</p>
<pre><code>datatable_table_member</code></pre>

<a name="key_1"></a>

## Usage



<a name="key_1_0"></a>

### Ajax

<p>Use this in a page request.</p>
<pre><code>wfPlugin::includeonce('datatable/datatable_1_10_18');
$datatable = new PluginDatatableDatatable_1_10_18();
exit($datatable-&gt;set_table_data($data));</code></pre>
<p>Data example.</p>
<pre><code>$data = array(array('id' =&gt; 1, 'name' =&gt; 'John'), array('id' =&gt; 2, 'name' =&gt; 'Jane'));</code></pre>
<p>Render only name.</p>
<pre><code>exit($datatable-&gt;set_table_data($data, array('name')));</code></pre>

<a name="key_1_1"></a>

### Reload

<p>Reload table.</p>
<pre><code>var table = $('#table_member').DataTable();table.ajax.reload();</code></pre>
<pre><code>$('#table_member').DataTable().ajax.reload();</code></pre>

<a name="key_1_2"></a>

### Change url and load

<p>Change ajax url and load table again.</p>
<pre><code>$('#table_member').DataTable().ajax.url('/path/ajax_test?my_param=yes').load();</code></pre>

<a name="key_1_3"></a>

### Click

<p>Row click.</p>
<pre><code>$('#table_member tbody').on( 'click', 'tr', function () {
    console.log( this ); //Set this to a variable to be able to remove (_this_).
    console.log( datatable_table_member.row( this ).index() );
    console.log( datatable_table_member.row( this ).data() );
} );</code></pre>

<a name="key_1_4"></a>

### Update

<p>Update row.
In this example we asume row data has parameter name.</p>
<pre><code>var index = datatable_table_member.row(this).index();
var data = datatable_table_member.row(this).data();
data.name = 'James';
datatable_table_member.row(index).data( data ).draw();</code></pre>

<a name="key_1_5"></a>

### Delete

<p>Delete row.</p>
<pre><code>datatable_table_member.row(_this_).remove().draw();</code></pre>

<a name="key_1_6"></a>

### Get rows

<p>Every row.</p>
<pre><code>table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
  var data = this.data();
  console.log(data);
} );</code></pre>
<p>Rows where filter applied.</p>
<pre><code>table.rows( { filter: 'applied' } ).every( function () {
  var data = this.data();
  console.log(data);
});</code></pre>

<a name="key_1_7"></a>

### Custom paging

<p>One could set custom page length options.</p>
<pre><code>lengthMenu:
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
    - All</code></pre>

<a name="key_1_8"></a>

### Dom

<p>Use dom param to modify element position.</p>
<pre><code>dom: "&lt;'row'&lt;'col-sm-6'l&gt;&lt;'col-sm-6'f&gt;&gt;&lt;'row'&lt;'col-sm-5'i&gt;&lt;'col-sm-7'p&gt;&gt;&lt;'row'&lt;'col-sm-12'tr&gt;&gt;&lt;'row'&lt;'col-sm-5'i&gt;&lt;'col-sm-7'p&gt;&gt;"</code></pre>

<a name="key_1_9"></a>

### Hidden columns

<p>By using param columnDefs one could hide columns and also make them not searchable.</p>

<a name="key_1_10"></a>

### Hide table if empty

<p>By using order event one could run a method to hide table if empty.</p>
<pre><code>$( document ).ready(function() {
  $('#table_member')
      .on('order.dt', () =&gt;  handle_table_member() )
      ;
});
function handle_table_member(){
  if(datatable_table_member.rows().count()==0){
    document.getElementById('table_member_wrapper').parentNode.style.display='none';
  }
}</code></pre>

<a name="key_2"></a>

## I18N



<a name="key_2_0"></a>

### File for translation

<p>Pic up I18N content.</p>
<pre><code>https://datatables.net/plug-ins/i18n/</code></pre>

<a name="key_3"></a>

## Plugin usage



<a name="key_3_0"></a>

### wf/table

<p>Concider use this plugin. It will build your table and implement this plugin.</p>

