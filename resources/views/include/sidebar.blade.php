<!-- Side navigation -->
<div class="sidenav">
  <div class="header">
  <i class="fas fa-cash-register"></i>
    <h4>POS</h4>
  </div>
    <a href="/dashboard">Dashboard</a>
    <a href="/pos">POS System</a>
    <a href="/products">Products</a>
    <a href="/suppliers">Suppliers</a>
    <a href="/transactions">Transactions</a>
    <a href="/users">Users</a>
  <form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit" id="logout_btn">Logout</button>
  </form>
</div>

<!-- Page content -->

<style>
    /* The sidebar menu */
.sidenav {
  height: 100%; /* Full-height: remove this if you want "auto" height */
  width: 190px; /* Set the width of the sidebar */
  position: fixed; /* Fixed Sidebar (stay in place on scroll) */
  z-index: 1; /* Stay on top */
  top: 0; /* Stay at the top */
  left: 0;
  background-color: #111; /* Black */
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 30px;
}

/* The navigation menu links */
.sidenav a {
  padding-left: 25px;
  padding-top: 18px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
  margin-top: 5px;
}


.header {
  text-decoration: none;
  font-size: 30px;
  color: #818181;
  display: block;
  text-align: center;
  padding-top: 10px;
  padding-bottom: 15px;
}

#logout_btn {
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
  border: none;
  background: none;
  position: absolute; 
  bottom: 0;
  padding-bottom: 20px;
  padding-left: 25px;
}

#logout_btn:hover {
  color: #f1f1f1;
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover {
  color: #f1f1f1;
}

/* Style page content */
.main {
  margin-left: 160px; /* Same as the width of the sidebar */
  padding: 0px 10px;
}

/* For screens smaller than 768px (tablets and mobile devices) */
@media (max-width: 768px) {
  .sidenav {
    width: 120px; /* Reduce width of sidebar */
    padding-top: 20px; /* Reduce padding */
  }
  .sidenav a {
    font-size: 16px; /* Reduce font size */
  }
  .main {
    margin-left: 120px; /* Adjust margin for smaller screens */
  }
  #logout_btn {
    font-size: 16px; /* Reduce font size */
    padding-bottom: 15px; /* Reduce padding */
    padding-left: 20px; /* Reduce padding */
  }
}

/* For screens smaller than 480px (smaller mobile devices) */
@media (max-width: 480px) {
  .sidenav {
    width: 80px; /* Reduce width of sidebar even further */
    padding-top: 15px; /* Reduce padding even further */
  }
  .sidenav a {
    font-size: 14px;  /* Reduce font size even further */
  }
  .main {
    margin-left: 80px; /* Adjust margin for smaller screens */
  }
  #logout_btn {
    font-size: 14px; /* Reduce font size even further */
    padding-bottom: 10px; /* Reduce padding even further */
    padding-left: 15px; /* Reduce padding even further */
  }
}

</style>