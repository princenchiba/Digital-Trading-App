var table;
$(document).ready(function() {
     "use strict";

    var inputdata = {};
        inputdata[BDTASK.csrf_token()] = BDTASK.csrf_hash();

    //datatables
    table = $('#ajaxtable').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [],        //Initial no order.
        "pageLength": 10,   // Set Page Length
        "lengthMenu":[[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url":  BDTASK.getSiteAction('admin/user/ajax-list'),
            "type": "POST",
            "data": inputdata
        },
        //Set column definition initialisation properties.
        "columnDefs": [
            { 
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            },
        ],
        dom: "<'row'<'col-sm-6 text-left'B><'col-sm-6'f>>tp", 
        buttons: [
            {
                extend: 'copy',
                text: '<i class="far fa-copy"></i>',
                titleAttr: 'Copy',
                className: 'btn-success'
            },
            {
                extend: 'excel',
                text: '<i class="far fa-file-excel"></i>',
                titleAttr: 'Excel',
                className: 'btn-success'
            },
            {
                extend: 'pdf',
                text: '<i class="far fa-file-pdf"></i>',
                titleAttr: 'PDF',
                className: 'btn-success'
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print" aria-hidden="true"></i>',
                titleAttr: 'Print',
                className: 'btn-success'
            },
            {
                extend: 'colvis',
                className: 'btn-success'
            },
        ],

       "fnInitComplete": function (oSettings, response) {
        }
    });
    $.fn.dataTable.ext.errMode = 'none';
});
