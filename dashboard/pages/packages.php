<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Betatransfer Packages</title>
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
          <div class="content-wrapper" id="packages">
            <div class="page-header">
              <h3 class="page-title"> Get Your Packages </h3>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="card">
                  <div class="card-body p1">
                    <h2 class="card-title">One</h2>
                    <h4 class="card-title">&euro; 100</h4>
                    <center><img src="../images/logotrust.jpg" class="mx-auto">Betatransfer</center>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-body p2">
                  <h2 class="card-title">Two</h2>
                    <h4 class="card-title">&euro; 500</h4>
                     <center><img src="../images/logotrust.jpg" class="mx-auto">Betatransfer</center>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-body p3">
                  <h2 class="card-title">Three</h2>
                    <h4 class="card-title">&euro; 1000</h4>
                     <center><img src="../images/logotrust.jpg" class="mx-auto">Betatransfer</center>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal" tabindex="-1" id="procedure">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Payment Address</h4>
                </div>
                <div class="modal-body">
                  <h4>Hi, Your package selection is <span class="plan"></span></h4>
                  <p>Please follow the following steps to make your payment</p>
                  <ol type="i">
                    <li>Select The payment method you of your choice</li>
                    <li>Copy the wallet address or scan the QRCode to get our address </li>
                    <li>Make your payment to the address</li>
                    <li>Finally, upload eveidence of payment</li>
                  </ol>
                  <div class="planned d-flex justify-content-between px-2">
                      <div class="img"><img src="../images/logotrust.jpg"></div>
                      <div class="selected">
                        <h4></h4>
                        <span></span>
                      </div>
                    </div>
                  <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal" style="background: linear-gradient(to right, rgba(31, 35, 97, .8), rgba(31, 35, 97, 0.7)) !important; color: white">Cancel</button>
                    <button type="button" id="proceed" class="btn btn-primary" style="background: linear-gradient(to right, rgba(31, 35, 97, .8), rgba(31, 35, 97, 0.7)) !important; color: white">Proceed to payment</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          
          <div class="modal" tabindex="-1" id="buy-modal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Payment Method</h4>
                </div>
                <div class="modal-body">
                  <form id="invest" action="pay.php" method="post" enctype="multipart/form-data">
                    <div class="first">
                      <div class="form-check">
                        <input class="form-check-input metho" type="radio" name="method_of_pay" id="btc" value="btc">
                        <label class="form-check-label" for="btc">
                          Pay with BTC
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input metho" type="radio" name="method_of_pay" id="usdt" value="usdt">
                        <label class="form-check-label" for="usdt">
                          Pay with USDT
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input metho" type="radio" name="method_of_pay" id="tron" value="tron">
                        <label class="form-check-label" for="tron">
                          Pay with Tron
                        </label>
                      </div>
                      <span class="text-danger" id="err"></span>
                      <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal" style="background: linear-gradient(to right, rgba(31, 35, 97, .8), rgba(31, 35, 97, 0.7)) !important; color: white">Cancel</button>
                    <button type="button" id="next1" class="btn btn-primary" style="background: linear-gradient(to right, rgba(31, 35, 97, .8), rgba(31, 35, 97, 0.7)) !important; color: white">Next</button>
                    </div>
                    </div>
                    <div class="second">
                      <div class="scan mx-auto">
                        <div class="bit">
                          <img src="../images/bitcoin.png" class="coin-img">
                          <h3>Your Bitcoin Address</h3>
                          <h5>1M1TjNdb1Y8YXmeJBbu8teRncurXZvanp</h5>
                        </div>
                        <div class="eth">
                          <img src="../images/eth.png" class="coin-img">
                          <h3>Your Tether USD Address</h3>
                          <h5>0xab225CC908695853829147BDc2BE597DaD3F4F63</h5>
                          <p>Send only Ethereum ERC20 tokens to this address. <br>Sending any other tokens may result in permanent loss </p>
                        </div>
                        <div class="tron">
                          <img src="../images/tron.png" class="coin-img">
                          <h3>Your Bitcoin Address</h3>
                          <h5>TQtwyqfHmTv2pPi3m3x3g2DMc9HYLNBgq8</h5>
                        </div>
                      </div>
                      <div class="form-group">
                        <input class="form-control metho" type="file" name="evidence" id="evidence">
                        <label class="form-label mt-3" for="usdt">
                          Upload Evidence Of Payment
                        </label>
                        <input type="number" name="plan" class="plan" hidden>
                      </div>
                  <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal" style="background: linear-gradient(to right, rgba(31, 35, 97, .8), rgba(31, 35, 97, 0.7)) !important; color: white">Cancel</button>
                    <button type="submit" id="submit" name="invest" class="btn btn-primary" style="background: linear-gradient(to right, rgba(31, 35, 97, .8), rgba(31, 35, 97, 0.7)) !important; color: white">Finish</button>
                  </div>
                    </div>
                    
                  
                  </form>
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
    <script src="../js/custom.js"></script>
  </body>
</html>