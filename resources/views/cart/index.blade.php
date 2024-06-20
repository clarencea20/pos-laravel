<!-- index.blade.php under the cart folder -->
@extends('layout.main')

@section('content')

@include('include.sidebar')

@if (session('success'))
    <div id="session-status" class="alert alert-success alert-sm d-flex justify-content-center align-items-center">{{ session('success') }}</div>
@endif

@if (session('status'))
  <script>
    setTimeout(function() {
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session("status") }}',
      })
    }, 100); // Delay by 100ms
  </script>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var sessionStatus = document.getElementById("session-status");
        if (sessionStatus) {
            sessionStatus.style.position = "fixed";
            sessionStatus.style.top = "50%";
            sessionStatus.style.left = "50%";
            sessionStatus.style.transform = "translate(-50%, -50%)";
            sessionStatus.style.zIndex = "9999";
            sessionStatus.style.width = "300px";
            sessionStatus.style.opacity = "1";
            sessionStatus.style.transition = "all 0.3s ease";
            setTimeout(function() {
                sessionStatus.style.opacity = "0";
                setTimeout(function() {
                    sessionStatus.style.display = "none";
                }, 300);
            }, 2000); 
        }
    });
</script>

<div class="container">
    <div class="card product-card">
        <h2><i class="fa-solid fa-cart-shopping"></i><a href="/pos" style="text-decoration:none; color:black">Products</a></h2>
        <div class="search-bar">
            <form action="{{ route('cart.index') }}" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" placeholder="Search Products" aria-label="Search Products" aria-describedby="basic-addon2" value="{{ request()->get('search') }}">
                    <button class="btn btn-outline-secondary" type="submit" id="basic-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
        @foreach($products as $product)
    <div class="product-item">
        <img src="{{ ($product->image)? asset('storage/img/product/'. $product->image) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png' }}" class="product-image">
        <div class="product-info">
            <h3>{{ $product->product_name }}</h3>
            <p class="product-price">P{{ $product->product_price }}</p>
        </div>
        <p class="product-quantity">{{ $product->product_quantity }} Items left</p>
        <form action="{{ route('cart.add') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
            <input type="number" value="1" class="quantity-input" id="quantity-{{ $product->product_id }}" name="quantity">
            <button class="add-to-cart-btn" type="submit"><i class="fa-solid fa-plus"></i></button>
        </form>
    </div>
@endforeach
    </div>
    <div class="card cart-card">
        <h2 style="margin-bottom: 10px;"><i class="fa-solid fa-cart-shopping"></i> Cart</h2>
        <div class="cart-items">
        @foreach(session('cart', []) as $productId => $product)
    <div class="cart-item">
        <p class="cart-item-name">{{ $product['product_name'] }}</p>
        <p class="cart-item-quantity">{{ $product['product_quantity'] }}x</p>
        <p class="cart-item-price">P{{ $product['product_price'] * $product['product_quantity'] }}</p>
        <form action="{{ route('cart.remove') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{ $productId }}">
            <button class="remove-from-cart-btn" type="submit" style="margin-left: 10px;"><i class="fa-solid fa-xmark"></i></button>
        </form>
    </div>
@endforeach
    </div>
    <form action="{{ route('cart.discount') }}" method="post">
        @csrf
        <p>Discount: <input type="number" name="discount" value="{{ session('discountPercentage', 0) }}" class="discount-input">%</p>
        <button class="calculate-btn" type="submit">Calculate</button>
    </form>
    <p>Discount Amount: <span class="discount-amount">P{{ session('discountAmount', 0) }}</span></p>
    <p>Total Price: <span class="total-price">P{{ session('totalPrice', 0) }}</span></p>
    <button class="pay-btn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal-pay">Pay</button>

       <!-- Pay Modal -->
       <form action="{{ route('cart.pay') }}" method="POST">
          @csrf
          <p>
            <input type="text" id="customer_name" name="customer_name" class="customer_name customer-name-input" placeholder="Enter Customer Name">
        </p>
        <div class="input-field">
            <label for="payment_method" class="form-label">Payment Method</label>
            <select id="payment_method" name="payment_method">
                <option value="Cash">Cash</option>
                <option value="Gcash">GCash</option>
                <option value="Mastercard">Mastercard</option>
                <option value="Visa">Visa</option>
            </select>
        </div>
    <div class="modal fade text-left" id="exampleModal-pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Tendered Amount</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i class="fa-regular fa-x"></i>
          </button>                    
        </div>
          <div class="modal-body">
            <div class="col-md-12">
              <div class="form-group mb-2">
                  <label for="tendered_amount" class="form-label">Tendered Amount</label>
                  <input type="text" class="form-control" placeholder="Enter Tendered Amount" id="tendered_amount" name="tendered_amount">
                  @if ($errors->has('tendered_amount'))
                    <span id="tendered-amount-error" style="color: red;">{{ $errors->first('tendered_amount') }}</span>
                @endif
              </div>
            </div>
            <div class="pay-modal">
              <button type="submit" class="pay-modal-btn" id="pay-btn">Pay</button>
            </div>
    </div>

 
            

<!-- Add a hidden div to generate the receipt -->
<div id="receipt" style="display: none;">
    <table class="receipt">
        <tbody>
            @foreach(session('cart', []) as $productId => $product)
            <tr>
                <td>{{ $product['product_name'] }}</td>
                <td>{{ $product['product_quantity'] }}x</td>
                <td>P{{ $product['product_price'] * $product['product_quantity'] }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">Discount Amount:</td>
                <td id="discount-amount">P{{ session('discountAmount', 0) }}</td>
            </tr>
            <tr>
                <td colspan="2">Total Price:</td>
                <td id="total-price">P{{ session('totalPrice', 0) }}</td>
            </tr>
            <tr>
                <td colspan="2">Tendered Amount:</td>
                <td id="tendered-amount">P{{ session('tendered_amount', 0) }}</td>
            </tr>
            <tr>
                <td colspan="2">Change:</td>
                <td id="change">P{{ session('change', 0) }}</td>
            </tr>
            <tr>
                <td colspan="2">Customer Name:</td>
                <td id="customer-name">{{ session('customer_name', '') }}</td>
            </tr>
        </tfoot>
    </table>
</div>
<input type="hidden" id="total-price-value" value="{{ session('totalPrice', 0) }}">

<script>
document.getElementById('pay-btn').addEventListener('click', function() {
    var receiptDiv = document.getElementById('receipt');
    var tenderedAmount = document.getElementById('tendered_amount').value;
    var customerName = document.getElementById('customer_name').value;
    var totalPrice = document.getElementById('total-price-value').value;

    if (tenderedAmount === '') {
        alert('Please enter a tendered amount.');
        return false;
    }

    var change = parseFloat(tenderedAmount) - parseFloat(totalPrice);

    if (change < 0) {
        alert('Tendered amount is not enough to cover the total price.');
        return false;
    }

    document.getElementById('tendered-amount').innerHTML = 'P' + tenderedAmount;
    document.getElementById('customer-name').innerHTML = customerName;
    document.getElementById('change').innerHTML = 'P' + change.toFixed(2);

    var printWindow = window.open('', '', 'width=400,height=600');
    printWindow.document.write(receiptDiv.innerHTML);
    printWindow.print();
    printWindow.close();
});
</script>
          </form>
        </div>
      </div>
    </div>
  </div>
    </div>
</div>
<style>
        .container {
            max-width: 1200px;
            margin-left: 200px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .product-card {
            overflow-y: auto;
            max-height: 700px;
            flex-basis: 55%;
            margin: 20px;
            margin-bottom: 10px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .cart-card {
            flex-basis: 30%;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product-card .search-bar {
            margin-left: 335px;
        }

        .product-card .search-bar .input-group {
            width: 250px; /* adjust the width to your liking */
            height: 40px;
        }

        .product-card .search-bar .form-control {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .product-card .search-bar .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .product-item {
            display: flex;
            align-items: center;
        }
        .product-image {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }
        .product-info {
            flex-grow: 1;
            margin-top: 15px;
            margin-bottom: 10px;
        }
        .product-price {
            font-weight: bold;
            font-size: 18px;
            float: left;
        }
        .product-quantity {
            font-weight: normal;
            font-size: 16px;
            float: right;
            margin-right: 10px;
            margin-top: 35px;
        }
        .quantity-input {
            width: 50px;
            height: 40px;
            margin: 0 10px;
            margin-top: 15px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .add-to-cart-btn {
            background-color: black;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .add-to-cart-btn:hover {
            color: #ccc;
        }
        .add-to-cart-btn:active {
            color: whitesmoke;
        }
        .cart-card {
            position: relative;
            padding: 20px;
            max-height: 700px;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .cart-items {
            overflow-y: auto;
            max-height: 700px; /* adjust the max height to your liking */
            padding-right: 10px; /* add some padding to account for the scrollbar */
        }

        .cart-item-name {
            flex-grow: 1;
        }
        .cart-item-quantity {
            width: 50px;
            text-align: center;
        }
        .cart-item-price {
            font-weight: bold;
            font-size: 18px;
        }
        .discount-input {
            width: 100px;
            height: 30px;
            margin: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        }
        .discount-input:focus {
            border-color: #aaa;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); 
        }
        .discount-amount {
            font-weight: bold;
            font-size: 24px;
        }
        .remove-from-cart-btn {
            background-color: black;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em; /* reduce font size */
        }
        .remove-from-cart-btn:hover {
            color: #ccc;
        }
        .remove-from-cart-btn:active {
            color: whitesmoke;
        }
        .calculate-btn {
            background-color: black;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em; /* reduce font size */
        }
        .calculate-btn:hover {
            color: #ccc;
        }
        .calculate-btn:active {
            color: whitesmoke;
        }
        .total-price {
            font-weight: bold;
            font-size: 24px;
        }
        .pay-btn {
            background-color: black;
            color: #fff;
            padding: 10px 20px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .pay-btn:hover {
            color: #ccc;
        }
        .pay-btn:active {
            color: whitesmoke;
        }
        .customer-name-input {
            width: 100%; /* make the input field take up the full width of its container */
            padding: 10px; /* add some padding to make the input field more readable */
            margin-top: 15px;
            font-size: 16px; /* set the font size to 16 pixels */
            border: 1px solid #ccc; /* add a light gray border around the input field */
            border-radius: 5px; /* add a slight rounded corner to the input field */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* add a subtle shadow to the input field */
        }
        
       .customer-name-input:focus {
            border-color: #aaa; /* change the border color to a darker gray when the input field is focused */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* increase the shadow intensity when the input field is focused */
        }
        
       .customer-name-input::placeholder {
            color: #999; /* set the placeholder text color to a light gray */
            font-style: italic; /* make the placeholder text italic */
        }

        .input-field {
            width: 100%; /* make the input field take up the full width of its container */
            padding: 10px; /* add some padding to make the input field more readable */
            margin-top: 10px;
            font-size: 16px; /* set the font size to 16 pixels */
            border: 1px solid #ccc; /* add a light gray border around the input field */
            border-radius: 5px; /* add a slight rounded corner to the input field */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* add a slight shadow to the input field */
        }

        .input-field select {
            width: 100%; /* make the select dropdown take up the full width of its container */
            padding: 10px; /* add some padding to make the select dropdown more readable */
            font-size: 16px; /* set the font size to 16 pixels */
            border: none; /* remove the default border from the select dropdown */
            border-radius: 0; /* remove the default border radius from the select dropdown */
            background-color: #fff; /* set the background color of the select dropdown to white */
            cursor: pointer;
            border-color: #666;
        }

        .input-field select:focus {
            outline: none; /* remove the default outline from the select dropdown when focused */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* add a slight shadow to the select dropdown when focused */
        }

        .pay-modal-btn {
            margin-top: 10px; 
            margin-bottom: 15px;
            padding: 5px 15px;
            float: inline-end;
            border-radius: 5px; 
            background-color:black; 
            color:white;
        }
        .pay-modal-btn:hover{
            color:#ccc;
        }
        .pay-modal-btn:active{
            color: whitesmoke;
        }
        .receipt {
            width: 100%;
            border-collapse: collapse;
        }
        .receipt th, .receipt td {
            padding: 8px;
            border: 1px solid #ccc;
        }
        .receipt th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .receipt td:nth-child(1) {
            width: 20%;
            text-align: left;
        }
        .receipt td:nth-child(2) {
            width: 60%;
            text-align: left;
        }
        .receipt td:nth-child(3) {
            width: 20%;
            text-align: right;
        }
        .receipt tfoot tr td {
            font-weight: bold;
        }
        .receipt tfoot tr td:nth-child(3) {
            font-size: 18px;
        }
</style>

@endsection
