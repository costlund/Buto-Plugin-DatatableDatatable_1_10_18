# Buto-Plugin-DatatableDatatable_1_10_18
Build for Bootstrap 4 usage.
Add sort, paging and search methods to a html table via Javascript. Also export to csv, excel, pdf.

## Head section

Include widget in head section.

```
type: widget
data:
  plugin: datatable/datatable_1_10_18
  method: include
```

## Widget

Add widget after table. Set id param of your table. Param ajax is optional.

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
        language:
          url: /plugin/datatable/datatable_1_10_18/i18n/Swedish.json
        dom: Blfrtip
        buttons:
          - copy
          - csv
          - excel
          - pdf
```

## Ajax

When using param ajax.

```
public function page_ajax_test(){
  $data = array(array('John', 1), array('Jane', 2));
  exit(json_encode(array('data' => $data)));
}
```
Reload table.

```
var table = $('#table_member').DataTable();table.ajax.reload();
```

Row click.
```
$('#table_member tbody').on( 'click', 'tr', function () {
    console.log( datatable_table_member.row( this ).data() );
} );
```


## Custom paging

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
