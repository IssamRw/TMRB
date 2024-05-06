<?php include('includes/header.php');?>
<main>
<div class="container-fluid px-4">
   
     <div class="row">
       <div class="col-md-12">
       <h1 class="mt-4">Dashboard</h1>
       <?php alertMessage(); ?>
       </div>
       <div class="col-md-3 mb-3">
             
              <div class="card card-body p-3" style="background-color: #A6B2F9;">
                     <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Categorie</p>
                     <h5 class="fw-bold mb-0">
                            <?= getCount('categorie'); ?>
                     
                     </h5>
              </div>
       </div>
       
       <div class="col-md-3 mb-3">
              <div class="card card-body p-3" style="background-color: #945BF5;">
                     <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Produit</p>
                     <h5 class="fw-bold mb-0">
                            <?= getCount('produit'); ?>
                     </h5>
              </div>
       </div>
       <div class="col-md-3 mb-3">
              <div class="card card-body p-3" style="background-color: #763EEC;">
                     <p class="text-sm mb-0 text-capitalize font-weight-bold">Total d'utilisateurs</p>
                     <h5 class="fw-bold mb-0">
                            <?= getCount('admins'); ?>
                     </h5>
              </div>
       </div>
       <div class="col-md-3 mb-3">
              <div class="card card-body p-3"  style="background-color: #4836E5;">
                     <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Projet</p>
                     <h5 class="fw-bold mb-0">
                            <?= getCount('projet'); ?>
                     </h5>
              </div>
       </div>
       <div class="col-md-12">
              <hr>
       <h4 class="mt-4">Projet</h4>
       </div>
      
       <div class="col-md-3 mb-3">
              <div class="card card-body p-3"  style="background-color: #8879C2;">
                     <p class="text-sm mb-0 text-capitalize font-weight-bold">Today Create Dossier Financier</p>
                     <h5 class="fw-bold mb-0">
                            <?php $todayDate = date('Y-m-d'); 
                            $todayFinancier = mysqli_query($conn, "SELECT * FROM financier WHERE financier_date='$todayDate' ");
                            if($todayFinancier){
                                if(mysqli_num_rows($todayFinancier) > 0){
                                   $totalCountFinancier = mysqli_num_rows($todayFinancier);
                                   echo $totalCountFinancier;
                                }else{
                                   echo'0';
                                }
                            }else{
                                   echo'Quelque chose s"est mal passé';
                            }
                            
                            
                            ?>
                     </h5>
              </div>
       </div>
       <div class="col-md-3 mb-3">
              <div class="card card-body p-3"  style="background-color: #B583C9;">
                     <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Dossier Financier</p>
                     <h5 class="fw-bold mb-0">
                            <?= getCount('financier'); ?>
                     </h5>
              </div>
       </div>
       <div class="col-md-3 mb-3">
              <div class="card card-body p-3"  style="background-color: #6766D7;">
                     <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Dossier Administratif</p>
                     <h5 class="fw-bold mb-0">
                            <?= getCount('tbl_name'); ?>
                     </h5>
              </div>
       </div>
       
       
     </div>
</div><html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Produit', 'Quantite'],
          <?php
     $con=mysqli_connect("localhost","root","") or die(mysqli_error($con));
     $db=mysqli_select_db($con,"pfe") or die(mysqli_error($con));
          $sql="select * from produit";
          $rs=mysqli_query($con,$sql)or die(mysqli_error($con));
          while($data=mysqli_fetch_assoc($rs)){
              echo "['".$data['nameproduit']."',".$data['quantite']."],";
              
          }
     ?>

        ]);

        var options = {
          title: 'Diagramme camembert pour les articles les plus demandés ',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart_3d" style="width: 1350px; height: 500px;"></div>
  </body>
</html>
<?php include('includes/footer.php');?>