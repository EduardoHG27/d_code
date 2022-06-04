<?=$this->extend('Front/layout/main')?>
<?= $this->section('content') ?>



<?php $session = session();?> 

	<div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card">
            
                <div class="card-body">
                    <?php echo "Welcome back ". $session->get('usuario')."!"  ?>
                    <hr>
                    <div class="row">
                    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg "></main>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body bg-primary">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-users"></i></span>
                                        <h4><b>
                                          
                                        </b></h4>
                                        <p><b>Miembros Activos</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body bg-info">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-th-list"></i></span>
                                        <h4><b>
                                          
                                        </b></h4>
                                        <p><b>Total Membership Plans</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body bg-warning">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-list"></i></span>
                                        <h4><b>

                                        </b></h4>
                                        <p><b>Total Packages</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>	
                </div>
              
                <div class="card-body">
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card" id="enter">
                                <div class="card-body bg-primary">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-users"></i></span>
                                        <h4><b>
                                          
                                        </b></h4>
                                        <p><b>Acceso</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" id="renew">
                                <div class="card-body bg-info">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"><i class="fa fa-th-list"></i></span>
                                        <h4><b>
                                         
                                        </b></h4>
                                        <p><b>Actualizar Membresia</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    </div>	
                </div>

            </div>      			
        </div>
        
    </div>

    
    
</div>

<script>

$(document).click(function(event) { 
     
});


document.querySelector("#enter").addEventListener("click", function(event) {
  uni_modal('Acceso al Gym', 'login_user.php'); // Fires if you click the label or the button
});

document.querySelector("#renew").addEventListener("click", function(event) {
  uni_modal('Renovar Membresia', 'renew_membership.php'); // Fires if you click the label or the button
});


	$('#manage-records').submit(function(e){
        e.preventDefault()
        start_load()
        $.ajax({
            url:'ajax.php?action=save_track',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(resp){
                resp=JSON.parse(resp)
                if(resp.status==1){
                    alert_toast("Data successfully saved",'success')
                    setTimeout(function(){
                        location.reload()
                    },800)

                }
                
            }
        })
    })
    $('#tracking_id').on('keypress',function(e){
        if(e.which == 13){
            get_person()
        }
    })
    $('#check').on('click',function(e){
            get_person()
    })
    function get_person(){
            start_load()
        $.ajax({
                url:'ajax.php?action=get_pdetails',
                method:"POST",
                data:{tracking_id : $('#tracking_id').val()},
                success:function(resp){
                    if(resp){
                        resp = JSON.parse(resp)
                        if(resp.status == 1){
                            $('#name').html(resp.name)
                            $('#address').html(resp.address)
                            $('[name="person_id"]').val(resp.id)
                            $('#details').show()
                            end_load()

                        }else if(resp.status == 2){
                            alert_toast("Unknow tracking id.",'danger');
                            end_load();
                        }
                    }
                }
            })
    }
</script>
<?=$this->endSection()?>

