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
<div class="modal fade text-left" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Add New Product</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i class="fa-regular fa-x"></i>
          </button>                    
        </div>
        <form action="{{ url('add-product') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="col-md-12">
              <div class="form-group mb-2">
                  <label for="product_name" class="form-label">Product Name</label>
                  <input type="text" class="form-control" placeholder="Enter Product Name" id="product_name" name="product_name">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" class="form-control" placeholder="Enter Product Price" id="product_price" name="product_price">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="product_quantity" class="form-label">Product Quantity</label>
                <input type="text" class="form-control" placeholder="Enter Product Quantity" id="product_quantity" name="product_quantity">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="supplier" class="form-label">Supplier</label>
                <select id="supplier" class="form-control" name="supplier_id" required>
                  <option value="">Select Supplier</option>
                  @foreach ($suppliers as $supplier)
                  <option value="{{ $supplier->supplier_id }}" {{ ($supplier->supplier_id) }}> {{ $supplier->supplier_name }} </option>
                  @endforeach
                </select>
                <div class="invalid-feedback">
                  Please select a supplier.
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="image" name="image">
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
@foreach ($products as $product)
<div class="modal fade text-left" id="exampleModal-show-{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">            
          <div class="modal-body">
          <div class="col-md-12">
                    <div class="form-group mb-2">
                        <div class="mb-3 mt-2 d-flex flex-column align-items-center">
                            <img src="{{ ($product->image) ? asset('storage/img/product/'. $product->image) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png' }}" class="rounded-circle" height="250px" width="250px" alt="Image">
                        </div>
                    </div>
                </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                  <label for="product_name" class="form-label">Product Name</label>
                  <input type="text" class="form-control" placeholder="Enter Product Name" id="product_name" name="product_name" value="{{ $product->product_name }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" class="form-control" placeholder="Enter Product Price" id="product_price" name="product_price" value="{{ $product->product_price }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="product_quantity" class="form-label">Product Quantity</label>
                <input type="text" class="form-control" placeholder="Enter Product Quantity" id="product_quantity" name="product_quantity" value="{{ $product->product_quantity }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="supplier_name" class="form-label">Supplier</label>
                <input type="text" class="form-control" id="supplier_name" name="supplier_name" value="{{ $product->supplier->supplier_name }}" readonly>
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
@foreach ($products as $product)
<form action="/product/update/{{$product->product_id}}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="modal fade text-left" id="exampleModal-edit-{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">            
          <div class="modal-body">
            <div class="col-md-12">
              <div class="form-group mb-2">
                <div class="mb-3 mt-2 d-flex flex-column align-items-center">
                  <img src="{{ ($product->image) ? asset('storage/img/product/'. $product->image) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png' }}" class="rounded-circle" height="250px" width="250px" alt="Image">
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                  <label for="product_name" class="form-label">Product Name</label>
                  <input type="text" class="form-control" placeholder="Enter Product Name" id="product_name" name="product_name" value="{{ $product->product_name }}">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" class="form-control" placeholder="Enter Product Price" id="product_price" name="product_price" value="{{ $product->product_price }}">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="product_quantity" class="form-label">Product Quantity</label>
                <input type="text" class="form-control" placeholder="Enter Product Quantity" id="product_quantity" name="product_quantity" value="{{ $product->product_quantity }}">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="supplier_id" class="form-label">Supplier</label>
                <select class="form-control" id="supplier_id" name="supplier_id">
                  @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->supplier_id }}" {{ $supplier->supplier_id == $product->supplier_id ? 'selected' : '' }}> {{ $supplier->supplier_name }} </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" class="form-control" placeholder="New Image" id="image" name="image">
              </div>
            </div>
            <div class="col-md-12">
              <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn px-4 float-start" style="margin-top: 15px; background-color:black; color:white">Back</button>
              <button type="submit" class="btn px-4 float-end" style="margin-top: 18px; background-color:black; color:white"><i class="fa-regular fa-floppy-disk"></i></button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
@endforeach

<!-- Delete Modal -->
@foreach ($products as $product)
<form action="/product/delete/{{$product->product_id}}" method="POST">
@csrf
@method('DELETE')
<div class="modal fade text-left" id="exampleModal-delete-{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">            
          <div class="modal-body">
          <div class="col-md-12">
                    <div class="form-group mb-2">
                        <div class="mb-3 mt-2 d-flex flex-column align-items-center">
                            <img src="{{ ($product->image) ? asset('storage/img/product/'. $product->image) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png' }}" class="rounded-circle" height="250px" width="250px" alt="Image">
                        </div>
                    </div>
                </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                  <label for="product_name" class="form-label">Product Name</label>
                  <input type="text" class="form-control" placeholder="Enter Product Name" id="product_name" name="product_name" value="{{ $product->product_name }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" class="form-control" placeholder="Enter Product Price" id="product_price" name="product_price" value="{{ $product->product_price }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="product_quantity" class="form-label">Product Quantity</label>
                <input type="text" class="form-control" placeholder="Enter Product Quantity" id="product_quantity" name="product_quantity" value="{{ $product->product_quantity }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-2">
                <label for="supplier_name" class="form-label">Supplier</label>
                <input type="text" class="form-control" id="supplier_name" name="supplier_name" value="{{ $product->supplier->supplier_name }}" readonly>
              </div>
            </div>
            <div class="col-md-12">
              <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn px-4 float-start" style="margin-top: 15px; background-color:black; color:white">Back</button>
              <button type="submit" class="btn btn-danger px-4 float-end" style="margin-top: 18px;"><i class="fa-solid fa-trash"></i></button>
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
    <h4 class="card-title"><a href="/products" style="text-decoration:none; color:black">Product Management</a></h4>
    <div class="add-user" align="right">
      <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" id="studentadd_btn"><i class="fas fa-plus" style="padding-right: 10px;"></i>Add Product</button>
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
            <th scope="col">Image</th>
            <th scope="col">Product</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Supplier Name</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
            <th class="text-center" scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
          <tr>
            <td>
            <img src="{{ ($product->image) ? asset('storage/img/product/'. $product->image) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png' }}"
               class="rounded-circle" width="80" height="80">
          </td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->product_price }}</td>
            <td>{{ $product->product_quantity }}</td>
            <td>{{ $product->supplier->supplier_name }}</td>
            <td>{{ $product->created_at }}</td>
            <td>{{ $product->updated_at }}</td>
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
        {{ $products->links() }}
        </div>
    </div>
  </div>
</div>
<script>
function printTable() {
  var table = document.querySelector('.table');
  var tableClone = table.cloneNode(true); // Create a clone of the table

  // Remove the image column
  var rows = tableClone.rows;
  for (var i = 0; i < rows.length; i++) {
    var cells = rows[i].cells;
    for (var j = 0; j < cells.length; j++) {
      if (cells[j].getElementsByTagName('img').length > 0) {
        cells[j].parentNode.removeChild(cells[j]);
        break;
      }
    }
  }

  // Update the table structure
  var ths = tableClone.querySelectorAll('th');
  ths[0].parentNode.removeChild(ths[0]);

  // Remove the action column (now 5th column)
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
  var printableContent = '<html><head><title>Product List</title></head><body>';

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
    width: 100%;
    max-width: fit-content;
    margin-left: 220px;
    margin-right: 25px;
    margin-top: 10px;
    margin-bottom: 20px;
    border-collapse: collapse;
    table-layout: auto;
    height: 100%;
  }

  td, th {
    text-align: center;
    vertical-align: middle;
  }

  #studentadd_btn {
    background-color: black;
    color: white;
    margin-bottom: 10px;
    text-align: center;
    text-decoration: none;
    padding: 6px 16px;
  }
  
  #studentadd_btn:hover {
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