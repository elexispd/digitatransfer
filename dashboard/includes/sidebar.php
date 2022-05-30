<?php 
  // session_start();
  // if (!isset($_SESSION["user_logged_in"])) {
  //   header("location:../../pages/login.php");
  // }
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-category">
      <span class="nav-link text-primary">Digitatransfer</span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php">
        <span class="menu-title">Home</span>
        <i class="icon-home menu-icon"></i>
      </a>
    </li>
     <li class="nav-item">
      <a class="nav-link" href="statistics.php">
        <span class="menu-title">Statistics</span>
        <i class="icon-chart menu-icon"></i>
      </a>
    </li>

     <li class="nav-item">
      <a class="nav-link rank" href="#">
        <span class="menu-title">Rank</span>
        <i class="icon-trophy menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="packages.php">
        <span class="menu-title">Packages</span>
        <i class="icon-book-open menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#transact" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-title">Transaction</span>
        <i class="icon-share-alt menu-icon"></i>
      </a>
      <div class="collapse" id="transact">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="withdraw.php">Withdraw</a></li>
          <li class="nav-item"> <a class="nav-link" href="transfer.php">Transfer</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-title">Network paid</span>
        <i class="icon-globe menu-icon"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="referals.php">Referals</a></li>
          <li class="nav-item"> <a class="nav-link" href="history.php">Transaction History</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../../handlers/logout.php">
        <span class="menu-title">Logout</span>
        <i class="icon-login menu-icon"></i>
      </a>
    </li>
    <!-- <li class="nav-item px-3">
      <a href="logout.php" style="font-weight: 700; font-size: 1.5em; color: black;"><i class="icon-login menu-icon"></i></a>
    </li> -->
 <!--    <li class="nav-item">
      <a class="nav-link" href="icons/simple-line-icons.html">
        <span class="menu-title">Icons</span>
        <i class="icon-globe menu-icon"></i>
      </a>
    </li>
    
   
    <li class="nav-item">
      <a class="nav-link" href="tables/basic-table.html">
        <span class="menu-title">Tables</span>
        <i class="icon-grid menu-icon"></i>
      </a>
    </li> -->
  </ul>
</nav>

