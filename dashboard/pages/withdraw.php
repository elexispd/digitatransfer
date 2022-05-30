<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Digitatransfer Withdraw</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../vendors/select2/select2.min.css">
    <link rel="stylesheet" href="../vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/custom.css" />
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
          <div class="content-wrapper" id="package">
            <div class="page-header">
              <h3 class="page-title"></h3>
            </div>
            <div class="row">
              <div class="col-md-8 mx-auto">
                <div class="card">
                  <div class="card-body">
                    <h2 class="card-title">Withdraw</h2>
                    <span class="text-danger"></span>
                    <form action="../../handlers/general.php" method="post" id="withdraw">
                      <div class="form-group">
                        <label class="form-label mt-3">
                          Amount
                        </label>
                        <input class="form-control metho" type="number" name="amount" id="amount">
                        <label class="form-label mt-3">
                          Coin
                        </label>
                        <select name="coin" class="form-control"> 
                          <option value="btc">BTC</option>
                          <option value="eth">Ethereum</option>
                          <option value="tron">Tron</option>
                        </select>
                         <label class="form-label mt-3">
                          Wallet Address
                        </label>
                        <input class="form-control metho" type="text" name="addr" id="addr">
                        <input class="form-control metho" type="text" hidden name="user"  value="<?php echo $_SESSION["user"]; ?>">
                        <button type="submit" id="submit" name="withdraw" class="btn btn-primary " style="background: linear-gradient(to right, rgba(31, 35, 97, .8), rgba(31, 35, 97, 0.7)) !important; color: white; margin-top:12px;">Transfer</button>
                      </div>
                  </div>
                </div>
              </div>
            </div>
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
    <script src="../vendors/select2/select2.min.js"></script>
    <script src="../vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../js/off-canvas.js"></script>
    <script src="../js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../js/typeahead.js"></script>
    <script src="../js/select2.js"></script>
    <!-- End custom js for this page -->
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script src="../js/general.js"></script>
  </body>
</html>