@extends('layout.main')

@section('content')

@include('include.sidebar')

<!-- Index Table -->
@if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif
<div class="card mt-3">
  <div class="card-body">
    <h4 class="card-title"><a href="/transactions" style="text-decoration:none; color:black">Transaction History</a></h4>
    <div class="print-transaction" align="right">
    <button type="button" id="print-btn" class="btn" onclick="printTable()"><i class="fa-solid fa-print"></i></button>
    </div>
    <div class="table-responsive">
      <table class="table table-hover">
        <div class="mb-3 col-sm-3 ms-1 float-end">
          <form action="#" method="get">
            <label for="search">Search</label>
            <input type="text" class="form-control mt-1" name="search" id="search" />
          </form>
        </div>
        <thead class="thead-dark">
          <tr>
            <th scope="col">Transaction ID</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Discount</th>
            <th scope="col">Amount Tendered</th>
            <th scope="col">Change</th>
            <th scope="col">Payment Method</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Created At</th>
            <th class="text-center" scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($transactions as $transaction)
          <tr>
            <td>{{ $transaction->transaction_id }}</td>
            <td>{{ $transaction->total_amount }}</td>
            <td>{{ $transaction->discount }}</td>
            <td>{{ $transaction->tendered_amount }}</td>
            <td>{{ $transaction->change }}</td>
            <td>{{ $transaction->payment_method }}</td>
            <td>{{ $transaction->customer_name }}</td>
            <td>{{ $transaction->created_at }}</td>
            <td><div class="btn-group" role="group" aria-label="Default button group">
            <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-show"><i class="fas fa-eye"></i></a>
            </div></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div>
        {{ $transactions->links() }}
        </div>
    </div>
  </div>
</div>
<script>
function printTable() {
  var table = document.querySelector('.table');
  var tableClone = table.cloneNode(true); // Create a clone of the table

  // Remove the action column (last column)
  var rows = tableClone.rows;
  for (var i = 0; i < rows.length; i++) {
    var cells = rows[i].cells;
    cells[cells.length - 1].parentNode.removeChild(cells[cells.length - 1]);
  }

  // Create a temporary iframe to print the table
  var iframe = document.createElement('iframe');
  iframe.frameBorder = 0;
  iframe.width = 0;
  iframe.height = 0;
  document.body.appendChild(iframe);

  // Write the printable content to the iframe
  var printableContent = '<html><head><title>Supplier List</title></head><body>';

  printableContent += '<style>';
  printableContent += `
    table {
      width: 100%;
      border: 1px solid black;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
  `;
  printableContent += '</style>';

  printableContent += tableClone.outerHTML;

  printableContent += '</body></html>';

  iframe.contentWindow.document.write(printableContent);
  iframe.contentWindow.document.close();

  // Print the iframe content
  iframe.contentWindow.print();

  // Remove the iframe
  document.body.removeChild(iframe);
}
</script>

<!-- View Modal -->
@foreach ($transactions as $transaction)
<div class="modal fade text-left" id="exampleModal-show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="exampleModalLabel">Transaction Details</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i class="fa-regular fa-x"></i>
          </button>                    
        </div>            
          <div class="modal-body">
            <div class="col-md-12">
              <div class="form-group mb-2">
                  <label for="transaction_id" class="form-label">Transaction ID</label>
                  <input type="text" class="form-control" id="transaction_id" name="transaction_id" value="{{ $transaction->transaction_id }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="total_amount" class="form-label">Total Amount</label>
                <input type="text" class="form-control" id="total_amount" name="total_amount" value="{{ $transaction->total_amount }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="discount" class="form-label">Discount</label>
                <input type="text" class="form-control" id="discount" name="discount" value="{{ $transaction->discount }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="tendered_amount" class="form-label">Amount Tendered</label>
                <input type="text" class="form-control" id="tendered_amount" name="tendered_amount" value="{{ $transaction->tendered_amount }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="change" class="form-label">Change</label>
                <input type="text" class="form-control" id="change" name="change" value="{{ $transaction->change }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="customer_name" class="form-label">Customer Name</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ $transaction->customer_name }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="created_at" class="form-label">Created At</label>
                <input type="text" class="form-control" id="created_at" name="created_at" value="{{ $transaction->created_at }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn px-4 float-start" style="margin-top: 15px; background-color:black; color:white">Back</button>
              <button class="btn px-4 float-end" style="margin-top: 17px; background-color:black; color:white" onclick="printModal()"><i class="fa-solid fa-print"></i></button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script> 
function printModal() {
    var modalBody = document.getElementById('exampleModal-show').getElementsByClassName('modal-body')[0];
    var printContent = modalBody.innerHTML;
    var printWindow = window.open('','', 'width=800,height=600');
    printWindow.document.write('<html><head><title>Transaction Details</title></head><body>' + printContent + '</body></html>');
    printWindow.document.close();
    printWindow.print();
}
</script>
@endforeach


<style>
    .card-title:hover {
    color: darkgray;
  }
  body {
    display: table;
    width: 80%;
    max-width: 400px;
    max-width: fit-content;
    margin-left: 220px;
    margin-top: 10px;
    border-collapse: collapse;
    table-layout: auto;
    height: 100%;
  }

  td, th {
    text-align: center;
    vertical-align: middle;
  }

  #print-btn {
    background-color: black;
    color: white;
    margin-bottom: 4px;
    text-align: center;
    text-decoration: none;
    padding: 6px 16px;
  }

  #print-btn:hover {
    color: darkgrey;
  }

  </style>
@endsection