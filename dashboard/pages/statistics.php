<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Digitatransfer</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../vendors/chartist/chartist.min.css">
    <!-- End Plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/custom.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../partials/_navbar.html -->
      <?php include "../includes/navbar.php" ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../partials/_sidebar.html -->
        <?php include "../includes/sidebar.php" ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          

                 <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card" id="new_stat">
              <div class="card-header" >
                <h5 class="title">Statistics</h5>
              </div>
              <div class="card-body">
                <!-- <form> -->
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <input type="text" class="form-control text-center" disabled="" value="Total profits paid">
                      </div>
                    </div>
                    <div class="col-md-6 px-1">
                      <div class="form-group">
                        <label>Trading Paid</label>
                        <input type="text" class="form-control v" value="Tether (&euro;)">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label for="">Network Paid</label>
                        <input type="text" class="form-control v" value="Tether (&euro;)">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <input type="text" class="form-control text-center" disabled="" value="Total Balance">
                      </div>
                    </div>
                    <div class="col-md-6 px-1">
                      <div class="form-group">
                        <label>Available Balance</label>
                        <input type="text" class="form-control v" value="Tether (&euro;)">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label for="">Withheld Balance</label>
                        <input type="text" class="form-control v" value="Tether (USDT) 0.00">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <input type="text" class="form-control text-center" disabled="" placeholder="Company" value="Purchase">
                      </div>
                    </div>
                    <div class="col-md-6 px-1">
                      <div class="form-group">
                        <label>Tether</label>
                        <input type="text" class="form-control v" value="Tether (USDT) 130.00">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label for="">Active</label>
                        <input type="text" class="form-control v" value="Tether (USDT) 3000.00">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <input type="text" class="form-control text-center" disabled="" placeholder="Company" value="Balance Transfered">
                      </div>
                    </div>
                    <div class="col-md-12 px-1">
                      <div class="form-group">
                        <label>Balance</label>
                        <input type="text" class="form-control v" value="Tether (&euro;)">
                      </div>
                    </div>
                  </div>

                <!-- </form> -->
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src="../../assets/images/team_01.jpg" alt="..." style="width: 100%;">
              </div>
              <div class="card-body">
                <div class="stat-rank">
                  <h3>Rank</h3>
                  <p class="" style="color: blue; font-family: 'roboto";>100 %</p>
                  <span>Current rank</span>
                  <span class="text-center">Sin Rango <br> <br> <a href="../../pages/registration.php?ref=<?php echo $_SESSION["user_logged_in"]; ?>">referral link</a></span>

                </div>
              </div>
              <hr>
            </div>
          </div>
        </div>
      </div>
          <!-- content-wrapper ends -->
          <!-- partial:../partials/_footer.html -->
         <?php include "../includes/footer.php" ?> 
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../vendors/chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../js/off-canvas.js"></script>
    <script src="../js/misc.js"></script>`
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../js/chartist.js"></script>
    <!-- End custom js for this page -->

    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script src="../js/custom.js"></script>
  
  </body>
</html>