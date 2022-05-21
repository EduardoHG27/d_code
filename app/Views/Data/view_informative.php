<?= $this->extend('Front/layout/main') ?>
<?= $this->section('content') ?>



<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/select/css/select2.min.css">
<script type="text/javascript" src="<?php echo base_url(); ?>/select/js/select2.js"></script>


<div class="row mt-3 ml-3 mr-3">


    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <b>Panel Informativo</b>
                    <span class="">
                        <div class="row text-center">
                            <div class="col-md-12">


                                <button id="btn-refresh" class="ejemplo1 btn-default">
                                    <div class="icono">
                                        <i class="fa fa-refresh fa-spin"></i>
                                    </div>
                                    <a class="small-box-footere">Recargar Tabla <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </button>
                  
                            </div>
                        </div>
                 
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
                    <th>Id Pago</th>
                    <th>Id Miembro</th>
                    <th>Usuario</th>
                    <th>Fecha inicio</th>
                    <th>Fecha final</th>
                    <th>Pago</th>

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
                    <li class="nav-item" role="presentation" id="miembro_pestaña">
                        <button class="nav-link pestaña active" id="miembro" data-bs-toggle="tab" data-bs-target="#member_form" type="button" role="tab" aria-controls="home" aria-selected="true">Miembro</button>
                    </li>
                    <li class="nav-item" role="presentation" id="plan_pestaña">
                        <button class="nav-link pestaña" style="" id="plan_button" data-bs-toggle="tab" data-bs-target="#plan_form" type="button" role="tab" aria-controls="profile" aria-selected="false">Elegir Plan</button>
                    </li>
                    <li class="nav-item" role="presentation" id="view_pestaña">
                        <button class="nav-link pestaña" style="" id="view_button" data-bs-toggle="tab" data-bs-target="#view_form" type="button" role="tab" aria-controls="profile" aria-selected="false">Datos Plan</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="member_form" role="tabpanel" aria-labelledby="home-tab">
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
                                        <label class="control-label">Name</label>
                                        <input type="text" class="form-control" name="txt_name" id="txt_name" placeholder="Nombre" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">Email</label>
                                        <input type="text" class="form-control" name="txt_email" id="txt_email" placeholder="Email" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">Mobile</label>
                                        <input type="text" class="form-control" name="txt_mobile" id="txt_mobile" placeholder="Telefono" />
                                    </div>

                                    <div class="col-md-4">
                                        <label class="control-label">Contraseña</label>
                                        <input type="password" class="form-control" name="txt_password" id="txt_password" placeholder="Contraseña" />
                                    </div>

                                </div>
                                <div class="row form-group">
                                </div>
                            </form>
                            <button type="button" id="btnmiembro" class="btn btn-info">Crear Miembro</button>
                        </div>


                    </div>
                    <div class="tab-pane fade" id="plan_form" role="tabpanel" aria-labelledby="plan_button">
                        <div class="container">
                            <br>
                            <h3>Elegir plan</h3>
                            <br>
                            <form action="" id="member-plan">
                                <div id="msg"></div>
                                <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>" class="form-control">
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Descuento</label>
                                            <input type="text" id="txt_desc" name="txt_desc" class="form-control" value="" readonly>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Valor Mes</label>
                                            <input type="text" id="txt_valor" name="txt_valor" class="form-control" value="300" readonly>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Seleccionar Mes</label>
                                            <select class="js-select2" id="plan_select" style="width: 100%;">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <label class="control-label">Total</label>
                                        <input type="text" id="txt_total" name="txt_total" class="form-control" value="">
                                    </div>
                                </div>
                            </form>
                            <button type="button" id="btnplan" class="btn btn-info">Asignar Plan</button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="view_form" role="tabpanel" aria-labelledby="plan_button">
                        <div class="container">
                            <br>
                            <h3>Informacion de plan</h3>
                            <br>
                            <form action="" id="member-plan">
                                <div id="msg"></div>
                                <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>" class="form-control">
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Fecha Inicio</label>
                                            <input type="text" id="txt_date_1" name="txt_date_1" class="form-control" value="" readonly>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Fecha Final</label>
                                            <input type="text" id="txt_date_2" name="txt_date_2" class="form-control" value="300" readonly>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Dias Vigentes</label>
                                            <input type="text" id="txt_days" name="txt_days" class="form-control" value="" readonly>

                                        </div>
                                    </div>

                                </div>
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <label class="control-label">Proximo pago</label>
                                        <input type="text" id="txt_date_next" name="txt_date_next" class="form-control" value="">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>

                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>


            </div>
        </div>
    </div>
</div>
<script>
    var site_url = "<?php echo base_url(); ?>";


    $(document).ready(function() {

        get_plan();
        $("#plan_select").select2({
            dropdownParent: $("#exampleModal"),
            theme: "classic"
        });

        $(".js-select2").select2({
            dropdownParent: $("#exampleModal"),
            closeOnSelect: false
        });


        $('#plan_select').on('change', function() {
            if ($('#plan_select').select2('val') != null) {
                data = $('#plan_select').select2('data')[0];

                $.ajax({
                    url: site_url + '/student/student_data',
                    method: "post",
                    data: {
                        id: data['id']
                    },
                    success: function(resp) {
                        var result = $.parseJSON(resp);



                        if (result.resp == 1) {
                            monto = $('#txt_valor').val();

                            mes = result.data['month'];

                            res_1 = monto * mes;
                            descuento = result.data['discount'] / 100;
                            descuento = descuento * res_1
                            total = res_1 - descuento;


                            $('#txt_desc').val(result.data['discount']);
                            $('#txt_total').val(total);




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
        });

        var selected = [];




        /*
        $('#tbl-students-data tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });
*/

        $('#tbl-students-data thead tr').clone(true).appendTo('#tbl-students-data thead');
        $('#tbl-students-data thead tr:eq(1) th:nth-child(n+1):nth-child(-n+6)').each(function(i) {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control form-control-sm" placeholder="' + title + '" />');
            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });
        $('#tbl-students-data thead tr:eq(1) th:nth-child(7)').each(function(i) {
            $(this).html('');
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
                url: site_url + "/informativo/plan-ajax-load", // json datasource
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
                    data: "id_pay"
                },
                {
                    data: "id_member"
                },
                {
                    data: "name"
                },
                {
                    data: "date_in"
                },
                {
                    data: "date_out"
                },
                {
                    data: "cost"
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

        function enable_tabs() {


            document.getElementById("plan_pestaña").classList.add('disabledTab');
            document.getElementById("miembro").classList.remove('disabledTab');
            document.getElementById("plan_pestaña").classList.add('enableTab');
            document.getElementById("plan_pestaña").classList.add('active');
            //document.getElementById("member_form").classList.remove('active');
            // document.getElementById("plan_form").classList.add('active');
            // document.getElementById("plan_form").classList.add('show');

            $('#plan_button').attr("style", " ");


        }

        function disable_tabs() {
            document.getElementById("plan_pestaña").classList.remove('enableTab');
            document.getElementById("plan_pestaña").classList.remove('active');
            document.getElementById("plan_pestaña").classList.remove('disabledTab');
            document.getElementById("miembro").classList.remove('enableTab');
            document.getElementById("plan_pestaña").classList.add('disabledTab');

        }

        $("#btn_agregarmiembro").click(function() {



            $('.modal-title').text('Agregar | Estudiante');
            $('#exampleModal').modal('show');

            $('#txt_id').val('');
            $('#txt_name').val('');
            $('#txt_email').val('');
            $('#txt_mobile').val('');
            $('#btnmiembro').show();
            $('#btnactializar_est').hide();


            document.getElementById("plan_form").classList.remove('show');
            document.getElementById("plan_form").classList.remove('active');

            document.getElementById("view_form").classList.remove('show');
            document.getElementById("view_form").classList.remove('active');

            document.getElementById("view_pestaña").classList.remove('active');
            document.getElementById("view_pestaña").classList.remove('show');

            document.getElementById('plan_pestaña').style.display = 'block';
            document.getElementById('view_pestaña').style.display = 'none';

            document.getElementById("member_form").classList.add('active');
            document.getElementById("member_form").classList.add('show');
            document.getElementById("plan_pestaña").classList.add('disabledTab');




            $('#plan_button').attr("style", "opacity:0.4");
            $('#plan_pestaña').attr("class", "disabledTab");


        });


        $("#update_button").click(function() {
            $('#registration').trigger("reset");
            let data = table.rows('.selected').data()[0];
            $('.modal-title').text('Modificar | Estudiante');
            enable_tabs();
            if (data === undefined) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Debes seleccionar un registro de la tabla',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                actualizar(data['id']);
            }
        });




        $('#tbl-students-data tbody').on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                table.$('tr.selected').removeClass('selected')
            } else {
                table.$('tr.selected').removeClass('selected');
                data = table.row(this).data();
                document.getElementById('lbltipAddedComment').innerHTML = data.id;
                $(this).addClass('selected')
                $('#update_button').prop('disabled', false)
            }
        });
    });







    jQuery.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
    });

    var $registrationForm = $('#registration');
    if ($registrationForm.length) {
        $registrationForm.validate({
            rules: {
                txt_name: {
                    required: true,
                },
                txt_email: {
                    required: true,
                    email: true,
                },
                txt_mobile: {
                    required: true
                }
            },
            messages: {
                txt_name: {
                    required: 'Please enter username!'
                },
                txt_email: {
                    required: 'Please enter email!',
                    email: 'Please enter valid email!'
                },
                txt_mobile: {
                    required: 'Please enter mobile!'
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


    var $planForm = $('#member-plan');
    if ($planForm.length) {
        $planForm.validate({
            rules: {
                txt_total: {
                    required: true,
                }
            },
            messages: {
                txt_total: {
                    required: 'Please enter username!'
                }
            }
        });
    }

    $("#btn-refresh").click(function() {
        start_load();
        table.ajax.reload();
        end_load();
    });




    $("#btnplan").click(function() {
        if ($("#member-plan").valid() == false) {

            return;
        } else {
            document.getElementById("plan_button").disabled = false;
            if ($('#plan_select').select2('val') != null) {
                data = $('#plan_select').select2('data')[0];
            }
            var data = {
                'discount': $('#txt_desc').val(),
                'month': data['text'],
                'cost': $('#txt_total').val(),
                'id': $('#txt_id').val(),

            };
            $.ajax({
                url: site_url + '/student/planmember_store',
                method: "post",
                data: data,
                success: function(resp) {
                    var result = $.parseJSON(resp);
                    if (result.resp == 1) {
                        table.ajax.reload();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Plan asignado correctamente',
                            showConfirmButton: false,
                            timer: 1500
                        })


                    } else if (resp == 2) {
                        $('#msg').html('<div class="alert alert-danger">ID No already existed.</div>')
                        end_load();
                    }
                }
            })


        }
    });

    $("#btnmiembro").click(function() {
        if ($("#registration").valid() == false) {

            return;
        } else {

            document.getElementById("plan_button").disabled = false;

            var data = {
                'name': $('#txt_name').val(),
                'email': $('#txt_email').val(),
                'mobile': $('#txt_mobile').val(),
                'password': $('#txt_password').val()
            };
            $.ajax({
                url: site_url + '/student/student_store',
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

                        $('#txt_id').val(result.id);
                        $('#plan_button').attr("style", "");
                        $('#plan_pestaña').attr("class", "enabledTab");
                        $('#plan_pestaña').attr("class", "active");
                        $('#plan_pestaña').attr("class", "show");

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
            disable_tabs();
            return;
        } else {

            document.getElementById("plan_button").disabled = false;

            var data = {
                'id': $('#txt_id').val(),
                'name': $('#txt_name').val(),
                'email': $('#txt_email').val(),
                'mobile': $('#txt_mobile').val()
            };
            $.ajax({
                url: site_url + '/student/student_update',
                method: "post",
                data: data,
                success: function(resp) {
                    var result = $.parseJSON(resp);
                    if (result.resp == 1) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Estudiante actualizado correctamente',
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





        $.ajax({
            url: site_url + '/student/student_chek_delete',
            method: "post",
            data: {
                id: id
            },
            success: function(resp) {

                console.log(resp);
                var result = $.parseJSON(resp);
                if (result.resp == 1) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Miembro con una cuenta activa no es posible eliminar el registro',
                        showConfirmButton: false,
                        timer: 3500
                    })
                    table.ajax.reload();
                    end_load();
                } else if (result.resp == 0) {
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

                            start_load();
                            $.ajax({
                                url: site_url + '/student/student_delete',
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
                    end_load();
                }
            }
        });


        /*
         */
    }

    function actualizar(id) {
        end_load();
        $('#exampleModal').modal('toggle');
        $('#exampleModal').modal('show');
        $('#btnmiembro').hide();
        $('#btnactializar').show();

        $.ajax({
            url: site_url + '/student/student_get',
            method: "post",
            data: {
                id: id
            },
            success: function(resp) {
                var result = $.parseJSON(resp);
                console.log(result.data['id']);
                if (result.resp == 1) {

                    $('#txt_id').val(result.data['id']);
                    $('#txt_name').val(result.data['name']);
                    $('#txt_email').val(result.data['email']);
                    $('#txt_mobile').val(result.data['mobile']);
                    table.ajax.reload();
                    //	setTimeout(function() {
                    //		location.reload()
                    //	}, 1000)

                    if (result.pay != null) {
                        console.log(result.pay);
                        console.log("no vacio");
                        document.getElementById('plan_pestaña').style.display = 'none';
                        document.getElementById('view_pestaña').style.display = 'block';


                        var date1 = new Date(result.pay['date_in']);
                        var date2 = new Date(result.pay['date_out']);

                        var Difference_In_Time = date2.getTime() - date1.getTime();
                        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

                        date_new = addDays(date2, 2);

                        $('#txt_date_1').val(result.pay['date_in']);
                        $('#txt_date_2').val(result.pay['date_out']);
                        $('#txt_days').val(Difference_In_Days);
                        $('#txt_date_next').val(date_new);



                    } else {
                        document.getElementById('view_pestaña').style.display = 'none';
                        document.getElementById('plan_pestaña').style.display = 'block';
                        console.log("vacio");
                    }

                } else if (resp == 2) {
                    $('#msg').html('<div class="alert alert-danger">ID No already existed.</div>')
                    end_load();
                }
            }
        });
    }


    function addDays(date, days) {
        var result = new Date(date);

        ostras = format(new Date(result.setDate(result.getDate() + days)), 'yyyy-MM-dd')

        return ostras;
    }



    format = function date2str(x, y) {
        var z = {
            M: x.getMonth() + 1,
            d: x.getDate(),
            h: x.getHours(),
            m: x.getMinutes(),
            s: x.getSeconds()
        };
        y = y.replace(/(M+|d+|h+|m+|s+)/g, function(v) {
            return ((v.length > 1 ? "0" : "") + z[v.slice(-1)]).slice(-2)
        });

        return y.replace(/(y+)/g, function(v) {
            return x.getFullYear().toString().slice(-v.length)
        });
    }

    function get_plan() {
        $.ajax({
            url: site_url + '/student/student_get_plan',
            method: "post",
            success: function(resp) {
                var result = $.parseJSON(resp);



                if (result.resp == 1) {
                    console.log(result.data);
                    $("#plan_select").append("<option value=''></option>");
                    $.each(result.data, function(key, value) {

                        $("#plan_select").append('<option value=' + value.id_plan + '>' + value.month + '</option>');
                    });

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
</script>

<style>

</style>

<?= $this->endSection() ?>