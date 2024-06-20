@extends('layout.main')

@section('content')

@include('include.sidebar')

<h1 class="title">Dashboard</h1>

<div class="row">
    <div class="col-md-4">
        <div class="card product-card">
            <div class="card-body">
                <i class="fas fa-shopping-cart"></i>
                <h5 class="card-title">Total Products</h5>
                <p class="card-text">{{ $totalProducts }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card transaction-card">
            <div class="card-body">
                <i class="fas fa-money-bill-alt"></i>
                <h5 class="card-title">Total Transactions</h5>
                <p class="card-text">{{ $totalTransactions }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card income-card">
            <div class="card-body">
                <i class="fas fa-chart-line"></i>
                <h5 class="card-title">Total Sales</h5>
                <p class="card-text">₱{{ number_format($totalIncome, 2) }}</p>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
  <script>
    setTimeout(function() {
      Swal.fire({
        icon: 'success',
        title: 'Welcome!',
        text: '{{ session("success") }}',
      })
    }, 100); // Delay by 100ms
  </script>
@endif

<style>

.title {
  font-weight: bold;
  margin-left: 220px;
  margin-top: 20px;
  margin-bottom: 20px;
}

.card {
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 10px;
  padding: 10px;
  margin-bottom: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  position: relative;
  left: 190px;
}

.card-body {
  padding: 10px;
}

.card-title {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 20px;
}

.card-text {
  font-size: 18px;
  color: black;
}

.card.product-card {
    background-color: rgba(229, 229, 230, 1); 
}

.card.product-card i {
  font-family: "Font Awesome 5 Free";
  font-size: 40px;
  color: #fff;
  position: absolute;
  top: 20px;
  right: 20px; /* Move the icon to the right side */
}

.card.transaction-card {
    background-color: lightgray; 
}

.card.transaction-card i {
  font-family: "Font Awesome 5 Free";
  font-size: 40px;
  color: #fff;
  position: absolute;
  top: 20px;
  right: 20px; /* Move the icon to the right side */
}

.card.income-card {
    background-color: rgba(189, 195, 199, 1);
}

.card.income-card i {
  font-family: "Font Awesome 5 Free";
  font-size: 40px;
  color: #fff;
  position: absolute;
  top: 20px;
  right: 20px; /* Move the icon to the right side */
}

.row {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  margin-right: 170px;
}

.col-md-4 {
  width: 30.33%;
  padding: 10px;
}

/* Add media queries for responsive design */

/* For screens smaller than 768px (tablets and mobile devices) */
@media (max-width: 768px) {
  .title {
    margin-left: 120px;
  }
  .card {
    left: 120px;
  }
  .row {
    margin-right: 120px;
  }
  .col-md-4 {
    width: 50%;
  }
}

/* For screens smaller than 480px (smaller mobile devices) */
@media (max-width: 480px) {
  .title {
    margin-left: 60px;
  }
  .card {
    left: 60px;
  }
  .row {
    margin-right: 60px;
  }
  .col-md-4 {
    width: 100%;
  }
}
    </style>

@endsection