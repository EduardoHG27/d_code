<?= $this->extend('Front/layout/main') ?>
<?= $this->section('content') ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Codeigniter 4 Server Side DataTable Tutorial - Online Web Tutor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />
</head>

<body>
    <div class="container">

        <br />
        <h2>Codeigniter 4 Server Side DataTable Tutorial</h2>
        <br />
        <table id="example" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            
        </tr>
    </thead>
 
    <tfoot>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            
        </tr>
    </tfoot>
 
    <tbody>
   
    </tbody>
</table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <script>
        var site_url = "<?php echo site_url(); ?>";

        $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $('#example thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#example').DataTable({
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "Todo"]
                ], // page length options
                bProcessing: true,
                serverSide: true,
                scrollY: "400px",
                scrollCollapse: true,
                ajax: {
                    url: site_url + "/ajax-load-data", // json datasource
                    type: "post",
                    data: {
                        // key1: value1 - in case if we want send data with request
                    }
                },
                searchable:true,
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información disponible",
                    "info": "Mostrando del registro _START_ al registro _END_. (Total _TOTAL_)",
                    "infoEmpty": "No hay información disponible",
                    "infoFiltered": "(filtrados de un total de _MAX_ registros)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "loadingRecords": "Cargando información...",
                    "processing": "Procesando información...",
                    "search": "Buscar:",
                    "zeroRecords": "No hay información disponible",
                    "paginate": {
                        "first": "Primera",
                        "last": "Última",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": activar para ordenar columna ascendente",
                        "sortDescending": ": activar para ordenar columna descendente"
                    }
                },
                columns: [{
                        data: "id"
                    },
                    {
                        data: "name"
                    },
                    {
                        data: "email"
                    },
                    {
                        data: "mobile"
                    }
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [0, 1, 2, 3]
                }],
                bFilter: true, // to display datatable search
            });
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            that
                .search( this.value )
                .draw();
        } );
    } );
} );
    </script>
</body>

</html>
<?= $this->endSection() ?>