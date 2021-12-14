<?php 
   require "koneksidb.php";	
  
    $data = query("SELECT * FROM tb_monitoring")[0];

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>	</title>
 </head>
 <body>

 <div class="row">
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card bg-gradient-danger card-img-holder text-white">
                                <div class="card-body">
                                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">Tanggal<i class="mdi mdi-clock mdi-24px float-right"></i>
                                    </h4>
                                    <h2 class="mb-5">11/12/2021 23:42</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card bg-gradient-info card-img-holder text-white">
                                <div class="card-body">
                                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">RFID<i class="mdi mdi-account-card-details mdi-24px float-right"></i>
                                    </h4>
                                    <h2 class="mb-5">KDW21L0</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card bg-gradient-success card-img-holder text-white">
                                <div class="card-body">
                                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">Pintu Tol<i class="mdi mdi-highway mdi-24px float-right"></i>
                                    </h4>
                                    <h2 class="mb-5">Karawang</h2>
                                </div>
                            </div>
                        </div>
                    </div>

 </body>
 </html>