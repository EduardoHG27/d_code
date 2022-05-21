<?= $this->extend('Front/layout/main') ?>
<?= $this->section('content') ?>




<div class="row mt-3 ml-3 mr-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <b>Plan</b>
                    <span class="">
                        <div class="row text-center">
                            <div class="col-md-12">

                                <div class="col-md-12">

                                    <button id="btn-refresh" class="ejemplo1 btn-default">
                                        <div class="icono">
                                            <i class="fa fa-refresh fa-spin"></i>
                                        </div>
                                        <a class="small-box-footere">Recargar Tabla <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    </button>
                                    <button id="add_button" class="ejemplo1 btn-info" data-toggle="modal" data-target="#addForma_Adq">
                                        <div class="icono">
                                            <i class="fa fa-plus"></i>
                                        </div>
                                        <a class="small-box-footere">Agregar Plan<i class="fa fa-arrow-circle-right"></i></a>
                                    </button>
                                    <button id="update_button" class="ejemplo1 btn-warning dis">
                                        <div class="icono">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </div>
                                        <a class="small-box-footere">Modificar Plan<i class="fa fa-arrow-circle-right"></i></a>
                                    </button>

                                    <button id="btndelete" class="ejemplo1 bg-red dis eliminar">
                                        <div class="icono">
                                            <i class="far fa-trash-alt"></i>
                                        </div>
                                        <a class="small-box-footere">Eliminar Plan<i class="fa fa-arrow-circle-right"></i></a>
                                    </button>

                                    <button id="btnActForm" class="ejemplo1 bg-green-active dis activate">
                                        <div class="icono">
                                            <i class="fa-solid fa-file-lines"></i>
                                        </div>
                                        <a class="small-box-footere">Activar/Desactivar Plan<i class="fa fa-arrow-circle-right"></i></a>
                                    </button>

                                </div>
                            </div>
                        </div>
                        <!--  <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-primary btn-block btn-sm col-sm-2 float-right" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"> <i class="fa fa-plus"></i>New</button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" id="update_button" class="btn btn-primary btn-block btn-sm col-sm-2 float-right" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"> <i class="fa fa-plus"></i>Update</button>
                    </div>
                </div>
            </div>-->
                        <label id="lbltipAddedComment">test</label>
                    </span>
                </div>
            </div>

            <div class="card-body">
                <hr>
                <div class="card-body">

                    <table class="table table-sm table-striped  table-bordered table-hover " id="tbl-students-data">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Meses</th>
                                <th>Descuento (Porciento)</th>
                                <th>Estado</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>









<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalTitle"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <br>
            <div class="container">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link pestaña active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="container">
                            <br>
                            <form action="" id="registration">
                                <div id="msg"></div>
                                <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>" class="form-control">
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <label class="control-label">ID No.</label>
                                        <input type="text" class="form-control" name="txt_id" id="txt_id" placeholder="ID" readonly />
                                        <small><i>Leave this blank if you want to a auto generate ID no.</i></small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <label class="control-label">Meses del plan</label>
                                        <input type="text" class="form-control" name="txt_mes" id="txt_mes" placeholder="Numeros de meses" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">Descuento (Porciento)</label>
                                        <input type="text" class="form-control" name="txt_desc" id="txt_desc" placeholder="Monto del descuento" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">Estatus</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Activar
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Desactivar
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" id="btnNewForma_Adq" class="btn btn-info">Crear Plan</button>
                <button type="button" id="btnactializar_est" class="btn btn-info">Actualizar Plan</button>
            </div>
        </div>
    </div>
</div>
<script>
    var site_url = "<?php echo base_url(); ?>";


   

    $(document).ready(function() {


        var selected = [];

        // document.getElementById("profile-tab").disabled = false;


        /*
        $('#tbl-students-data tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });
*/

        $('#tbl-students-data thead tr').clone(true).appendTo('#tbl-students-data thead');
        $('#tbl-students-data thead tr:eq(1) th:nth-child(n+1):nth-child(-n+4)').each(function(i) {
            var title = $(this).text();
            $(this).html('<input id="txt_' + i + '" class="form-control form-control-sm" placeholder="' + title + '" />');
            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });
        $('#tbl-students-data thead tr:eq(1) th:nth-child(5)').each(function(i) {
            $(this).html('<button type="button" class="blue-button-min" onclick="limpiar()">Limpiar<i class="fa fa-eraser" aria-hidden="true"></i></button>');
        });



        // DataTable
        table = $('#tbl-students-data').DataTable({
            lengthMenu: [
                [15, 25, 50, -1],
                [15, 25, 50, "Todo"]
            ], // page length options
            select: "multi",
            bProcessing: true,
            serverSide: true,
            scrollY: "400px",
            scrollCollapse: true,
            ajax: {
                url: site_url + "/plans/plan-ajax-load", // json datasource
                type: "post",
                data: {
                    // key1: value1 - in case if we want send data with request
                }
            },
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
                    data: "id_plan"
                },
                {
                    data: "month"
                },
                {
                    data: "discount"
                },
                {
                    data: null,
                    'orderable': false,
                    'searchable': false,

                    render: function(data, type, row) {
                        if (row.status == "true") {
                            return '<div >' +
                                '<button type="button" class="green-button" onclick="update_status(' + row.id_plan + ')" data-toggle="tooltip" data-placement="top" title="Estatus" >Activo</button>' +
                                '</div>';
                        } else {
                            return '<div >' +
                                '<button  class="red-button" onclick="update_status(' + row.id_plan + ')" title="Estatus" >No activo</button>' +
                                '</div>';
                        }

                    }
                },
                {
                    data: null,
                    'orderable': false,
                    'searchable': false,

                    render: function(data, type, row) {
                        /*
                                                return '<div class="btn-group">' +
                                                    '<button type="button" class="btn btn-primary btn-flat btn-sm visible-lg-inline-block" data-toggle="modal" data-target="#addTramite" onclick="edit(' + row.id + ')">Modificar</button>' +
                                                    '<button type="button" class="btn btn-primary btn-flat btn-sm dropdown-toggle" data-toggle="dropdown">' +
                                                    '<span class="caret"></span>' +
                                                    '<span class="sr-only">Opciones</span>' +
                                                    '</button>' +
                                                    '</div>';*/
                        return '<div >' +
                            '<button class="red-button-min" onclick="eliminar(' + row.id + ')"><i class="fas fa-trash-alt"></i></button>' +
                            '<button class="yellow-button-min" onclick="actualizar(' + row.id + ')"><i class="fa fa-pencil-square-o"></i></button>' +
                            '</div>';
                    }
                }
            ],
            columnDefs: [{
                orderable: false,
                targets: [0, 1, 2, 3]
            }],
            bFilter: true,
            // to display datatable search
        });


        $("#btndelete").click(function() {
            start_load();
            let data = table.rows('.selected').data()[0];


            if (data === undefined) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Debes seleccionar un registro de la tabla',
                    showConfirmButton: false,
                    timer: 1500
                })
                end_load();
            } else {

                eliminar(data['id']);
            }
        });



        $("#add_button").click(function() {
            //disable_tabs();
            $('.modal-title').text('Agregar | Plan');
            $('#exampleModal').modal('show');
            $('#txt_name').val('');
            $('#txt_mes').val('');
            $('#txt_desc').val('');
            $('#btnNewForma_Adq').show();
            $('#btnactializar_est').hide();
        });


        $("#update_button").click(function() {

            let data = table.rows('.selected').data()[0];
            $('.modal-title').text('Modificar | Plan');
            // enable_tabs();
            if (data === undefined) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Debes seleccionar un registro de la tabla',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                actualizar(data['id_plan']);
            }
        });







        $('#tbl-students-data tbody').on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                table.$('tr.selected').removeClass('selected')
            } else {
                table.$('tr.selected').removeClass('selected');
                data = table.row(this).data();
                document.getElementById('lbltipAddedComment').innerHTML = data.id_plan;
                $(this).addClass('selected')
                $('#update_button').prop('disabled', false)
            }
        });
    });

    function limpiar() {

$('#txt_0').val('');
$('#txt_1').val('');
$('#txt_2').val('');
$('#txt_3').val('');
//document.getElementById("status").selectedIndex = 0;
$('input[type=search]').val('').change();

table.columns(0).search('').draw();
table.columns(1).search('').draw();
table.columns(2).search('').draw();
table.columns(3).search('').draw();
table.columns(4).search('').draw();
}   





    jQuery.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
    });

    var $registrationForm = $('#registration');
    if ($registrationForm.length) {
        $registrationForm.validate({
            rules: {
                txt_mes: {
                    required: true,
                    number: true
                },
                txt_desc: {
                    required: true,
                    number: true
                }
            },
            messages: {
                txt_mes: {
                    required: 'Porfavor ingresa un mes!'
                },
                txt_desc: {
                    required: 'Please enter email!',
                    email: 'Please enter valid email!'
                }
            },
            errorPlacement: function(error, element) {
                if (element.is(":radio")) {
                    error.appendTo(element.parents('.gender'));
                } else if (element.is(":checkbox")) {
                    error.appendTo(element.parents('.hobbies'));
                } else {
                    error.insertAfter(element);
                }

            }

        });
    }



    $("#btnActForm").click(function() {
        start_load();
        let data = table.rows('.selected').data()[0];
        $('.modal-title').text('Modificar | Plan');
        // enable_tabs();
        if (data === undefined) {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Debes seleccionar un registro de la tabla',
                showConfirmButton: false,
                timer: 1500
            })
        } else {
            update_status(data['id_plan']);
        }
        end_load();
    });

    $("#btn-refresh").click(function() {
        start_load();
        table.ajax.reload();
        end_load();
    });

    $("#btnNewForma_Adq").click(function() {
        if ($("#registration").valid() == false) {

            return;
        } else {
            let res;
            status = $("#flexRadioDefault1").is(":checked");



            var data = {
                'month': $('#txt_mes').val(),
                'desc': $('#txt_desc').val(),
                'status': status
            };
            $.ajax({
                url: site_url + '/plans/plan_store',
                method: "post",
                data: data,
                success: function(resp) {
                    var result = $.parseJSON(resp);
                    if (result.resp == 1) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Estudiante registrado correctamente',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        table.ajax.reload();
                        //	setTimeout(function() {
                        //		location.reload()
                        //	}, 1000)
                    } else if (resp == 2) {
                        $('#msg').html('<div class="alert alert-danger">ID No already existed.</div>')
                        end_load();
                    }
                }
            })


        }
    });


    $("#btnactializar_est").click(function() {
        if ($("#registration").valid() == false) {
            //disable_tabs();
            return;
        } else {


            let res;

            if ($("#flexRadioDefault1").is(":checked")) {
                res = 'true';
            } else {
                res = 'false';
            }

            var data = {
                'id': $('#txt_id').val(),
                'month': $('#txt_mes').val(),
                'discount': $('#txt_mes').val(),
                'status': res
            };
            $.ajax({
                url: site_url + '/plans/plan_update',
                method: "post",
                data: data,
                success: function(resp) {
                    var result = $.parseJSON(resp);
                    if (result.resp == 1) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Plan actualizado correctamente',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        table.ajax.reload();
                        //	setTimeout(function() {
                        //		location.reload()
                        //	}, 1000)
                    } else if (resp == 2) {
                        $('#msg').html('<div class="alert alert-danger">ID No already existed.</div>')
                        end_load();
                    }
                }
            })


        }
    });


    /*
        function enable_tabs() {


            document.getElementById("slide").classList.remove('disabledTab');
            document.getElementById("slide").classList.add('enableTab');
            $('#profile-tab').attr("style", " ");


        }

        function disable_tabs() {
            document.getElementById("slide").classList.remove('enableTab');
            document.getElementById("slide").classList.add('disabledTab');
            $('#profile-tab').attr("style", "opacity:0.4");
        }
    */

    window.start_load = function() {
        $('body').prepend('<di id="preloader2"></di>')
    }
    window.end_load = function() {
        $('#preloader2').fadeOut('fast', function() {
            $(this).remove();
        })
    }


    function eliminar(id) {
        end_load();
        Swal.fire({
            title: 'Esta seguro de eliminar el registro con Id : ' + id + ' ?',
            text: "Una vez eliminado el registro no se podra recuperar!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si Eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                var id = {
                    'id': document.getElementById('lbltipAddedComment').innerHTML
                };
                start_load();

                $.ajax({
                    url: site_url + '/student/student_delete',
                    method: "post",
                    data: id,
                    success: function(resp) {
                        var result = $.parseJSON(resp);
                        if (result.resp == 1) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Registro eliminado',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            table.ajax.reload();
                            end_load();
                        } else if (resp == 2) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Error al eliminar el registro',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            end_load();
                        }
                    }
                });
            }
        })
    }

    function actualizar(id) {
        end_load();
        $('#exampleModal').modal('toggle');
        $('#exampleModal').modal('show');
        $('.modal-title').text('Modificar | Plan');
        $('#btnNewForma_Adq').hide();
        $('#btnactializar').show();
        console.log(id);
        $.ajax({
            url: site_url + '/plans/plan_get',
            method: "post",
            data: {
                id: id
            },
            success: function(resp) {
                var result = $.parseJSON(resp);
                console.log(result.data['id_plan']);
                if (result.resp == 1) {
                    $('#txt_id').val(result.data['id_plan']);
                    $('#txt_mes').val(result.data['month']);
                    $('#txt_desc').val(result.data['discount']);

                    if (result.data['status'] == 'true') {
                        $("#flexRadioDefault1").prop("checked", true);
                        $("#flexRadioDefault2").prop("checked", false);
                    } else {
                        $("#flexRadioDefault2").prop("checked", true);
                        $("#flexRadioDefault1").prop("checked", false);
                    }

                    table.ajax.reload();
                    //	setTimeout(function() {
                    //		location.reload()
                    //	}, 1000)
                } else if (resp == 2) {
                    $('#msg').html('<div class="alert alert-danger">ID No already existed.</div>')
                    end_load();
                }
            }
        });
    }

    function update_status(id) {

        $.ajax({
            url: site_url + '/plans/plan_status_up',
            method: "post",
            data: {
                id: id
            },
            success: function(resp) {
                var result = $.parseJSON(resp);

                if (result.resp == 1) {

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Se modifico el estatus correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    table.ajax.reload();
                    //	setTimeout(function() {
                    //		location.reload()
                    //	}, 1000)
                } else if (resp == 2) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Error al modificar el estatus',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        });
    }
</script>

<style>
    /* Black */
</style>
<?= $this->endSection() ?>