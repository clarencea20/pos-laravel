@extends('layout.main')

@section('content')

@include('include.sidebar')

@if (session('success'))
  <script>
    setTimeout(function() {
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session("success") }}',
      })
    }, 100); // Delay by 100ms
  </script>
@endif

<!-- Create Modal -->
<div class="modal fade text-left" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Add New Supplier</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i class="fa-regular fa-x"></i>
          </button>                    
        </div>
        <form action="{{ url('add-supplier') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="col-md-12">
              <div class="form-group mb-2">
                  <label for="supplier_name" class="form-label">Supplier Name</label>
                  <input type="text" class="form-control" placeholder="Enter Supplier Name" id="supplier_name" name="supplier_name">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" placeholder="Enter Address" id="address" name="address">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="text" class="form-control" placeholder="Enter Contact Number" id="contact_number" name="contact_number">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" placeholder="Enter Email" id="email" name="email">
              </div>
            </div>
            <div class="col-md-12">
              <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn px-4 float-start" style="margin-top: 15px; margin-bottom: 20px; background-color:black; color:white">Back</button>
              <button type="submit" class="btn px-4 float-end" style="margin-top: 15px; margin-bottom: 20px; background-color:black; color:white">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<!-- View Modal -->
@foreach ($suppliers as $supplier)
<div class="modal fade text-left" id="exampleModal-show-{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="exampleModalLabel">Add New Supplier</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i class="fa-regular fa-x"></i>
          </button>                    
        </div>               
          <div class="modal-body">
            <div class="col-md-12">
              <div class="form-group mb-2">
                  <label for="supplier_name" class="form-label">Supplier Name</label>
                  <input type="text" class="form-control" placeholder="Enter Supplier Name" id="supplier_name" name="supplier_name" value="{{ $supplier->supplier_name }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" placeholder="Enter Address" id="address" name="address" value="{{ $supplier->address }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="text" class="form-control" placeholder="Enter Contact Number" id="contact_number" name="contact_number" value="{{ $supplier->contact_number }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" placeholder="Enter Email" id="email" name="email" value="{{ $supplier->email }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn px-4 float-start" style="margin-top: 15px; background-color:black; color:white">Back</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach

<!-- Edit Modal -->
@foreach ($suppliers as $supplier)
<form action="/supplier/update/{{$supplier->supplier_id}}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="modal fade text-left" id="exampleModal-edit-{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Supplier Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>                   
          <div class="modal-body">
            <div class="col-md-12">
              <div class="form-group mb-2">
                  <label for="supplier_name" class="form-label">Supplier Name</label>
                  <input type="text" class="form-control" placeholder="Enter Supplier Name" id="supplier_name" name="supplier_name" value="{{ $supplier->supplier_name }}">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" placeholder="Enter Address" id="address" name="address" value="{{ $supplier->address }}">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="text" class="form-control" placeholder="Enter Contact Number" id="contact_number" name="contact_number" value="{{ $supplier->contact_number }}">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" placeholder="Enter Email" id="email" name="email" value="{{ $supplier->email }}">
              </div>
            </div>
            <div class="col-md-12">
              <a href="/suppliers" class="btn px-4 float-start" style="margin-top: 10px; background-color:black; color:white">Back</a>
              <button type="submit" class="btn px-4 float-end" style="margin-top: 11px; background-color:black; color:white"><i class="fa-regular fa-floppy-disk"></i></button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
@endforeach

<!-- Delete Modal -->
@foreach ($suppliers as $supplier)
<form action="/supplier/delete/{{$supplier->supplier_id}}" method="POST">
@csrf
@method('DELETE')
<div class="modal fade text-left" id="exampleModal-delete-{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Supplier Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>                   
          <div class="modal-body">
          <div class="col-md-12">
              <div class="form-group mb-2">
                  <label for="supplier_name" class="form-label">Supplier Name</label>
                  <input type="text" class="form-control" placeholder="Enter Supplier Name" id="supplier_name" name="supplier_name" value="{{ $supplier->supplier_name }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" placeholder="Enter Address" id="address" name="address" value="{{ $supplier->address }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="text" class="form-control" placeholder="Enter Contact Number" id="contact_number" name="contact_number" value="{{ $supplier->contact_number }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" placeholder="Enter Email" id="email" name="email" value="{{ $supplier->email }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <a href="/suppliers" class="btn px-4 float-start" style="margin-top: 15px; background-color:black; color:white">Back</a>
              <button type="submit" class="btn btn-danger px-4 float-end" style="margin-top: 17px;" ><i class="fa-solid fa-trash"></i></button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
@endforeach


<!-- Index Table -->
@if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif
<div class="card mt-3">
  <div class="card-body">
    <h4 class="card-title"><a href="/suppliers" style="text-decoration:none; color:black">Supplier List</a></h4>
    <div class="add-user" align="right">
      <button type="button" data-bs-toggle="modal" data-bs-target="#supplierModal" id="supplieradd_btn"><i class="fas fa-plus" style="padding-right: 10px;"></i>Add Supplier</button>
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
            <th scope="col">Supplier Name</th>
            <th scope="col">Address</th>
            <th scope="col">Contact Number</th>
            <th scope="col">Email</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
            <th class="text-center" scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($suppliers as $supplier)
          <tr>
            <td>{{ $supplier->supplier_name }}</td>
            <td>{{ $supplier->address }}</td>
            <td>{{ $supplier->contact_number }}</td>
            <td>{{ $supplier->email }}</td>
            <td>{{ $supplier->created_at }}</td>
            <td>{{ $supplier->updated_at }}</td>
            <td><div class="btn-group" role="group" aria-label="Default button group">
            <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-show-{{ $loop->index }}"><i class="fas fa-eye"></i></a>
            <a class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal-edit-{{ $loop->index }}"><i class="fas fa-edit"></i></a>
            <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-delete-{{ $loop->index }}"><i class="fas fa-trash"></i></a>
            </div></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div>
        {{ $suppliers->links() }}
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

  #supplieradd_btn {
    background-color: black;
    color: white;
    margin-bottom: 10px;
    text-align: center;
    text-decoration: none;
    padding: 6px 16px;
  }
  
  #supplieradd_btn:hover {
    color: darkgrey;
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