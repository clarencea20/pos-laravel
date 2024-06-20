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
<div class="modal fade text-left" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Add New User</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i class="fa-regular fa-x"></i>
          </button>                    
        </div>
        <form action="{{ url('add-user') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
          <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" placeholder="Enter Your First Name" id="first_name" name="first_name">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="middle_name" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" placeholder="Enter Your Middle Name" id="middle_name" name="middle_name">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" placeholder="Enter Your Last Name" id="last_name" name="last_name">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="position" class="form-label">Position</label>
                    <select class="position-field" id="position" name="position">
                      <option value="">Select Position</option>
                      <option value="Cashier">Cashier</option>
                      <option value="Manager">Manager</option>
                    </select>
                  </div>
                </div>
                <!-- <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control" placeholder="Enter Your Position" id="position" name="position">
                  </div>
                </div> -->
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" placeholder="Enter Your Username" id="username" name="username">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Enter Your Password" id="password" name="password">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" placeholder="Confirm Password" id="confirm_password" name="confirm_password">
                  </div>
                </div>
                <div class="col-md-12">
                    <a href="/users" class="btn px-4 float-start" style="margin-top: 15px; margin-bottom: 20px; background-color:black; color:white">Back</a>
                    <button type="submit" class="btn px-4 float-end" style="margin-top: 17px; margin-bottom: 20px; background-color:black; color:white"><i class="fa-solid fa-plus"></i></button>
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<!-- View Modal -->
@foreach ($users as $user)
<div class="modal fade text-left" id="userModal-show-{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Employee Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>            
          <div class="modal-body">
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="middle_name" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $user->middle_name }}" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" readonly>
                  </div>
                </div>
                <!-- <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="position" class="form-label">Position</label>
                    <select class="position-field" id="position" name="position">
                      <option value="{{ $user->position }}">{{ $user->position }}</option>
                    </select>
                  </div>
                </div> -->
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control" id="position" name="position" value="{{ $user->position }}" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                    <a href="/users" class="btn px-4 float-start" style="margin-top: 10px; background-color:black; color:white">Back</a>
                    <button class="btn px-4 float-end" style="margin-top: 11px; background-color:black; color:white" onclick="printModal()"><i class="fa-solid fa-print"></i></button>
                </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script> 
function printModal() {
    var modalBody = document.getElementById('userModal-show-{{ $loop->index }}').getElementsByClassName('modal-body')[0];
    var printContent = modalBody.innerHTML;
    var printWindow = window.open('','', 'width=800,height=600');
    printWindow.document.write('<html><head><title>Employee Details</title></head><body>' + printContent + '</body></html>');
    printWindow.document.close();
    printWindow.print();
}
</script>
@endforeach

<!-- Edit Modal -->
@foreach ($users as $user)
<form action="/user/update/{{$user->user_id}}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="modal fade text-left" id="userModal-edit-{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Employee Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>                   
          <div class="modal-body">
          <div class="col-md-12">
                  <div class="form-group mb-2"> 
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="middle_name" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $user->middle_name }}">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="position" class="form-label">Position</label>
                    <select class="position-field" id="position" name="position">
                      <option value="">Select Position</option>
                      @if($user->position == 'Cashier')
                        <option value="Cashier" selected>Cashier</option>
                      @else
                        <option value="Cashier">Cashier</option>
                      @endif
                      @if($user->position == 'Manager')
                        <option value="Manager" selected>Manager</option>
                      @else
                        <option value="Manager">Manager</option>
                      @endif
                    </select>
                  </div>
                </div>
                <!-- <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control" id="position" name="position" value="{{ $user->position }}">
                  </div>
                </div> -->
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                  </div>
                </div>
                <div class="col-md-12">
                    <a href="/users" class="btn px-4 float-start" style="margin-top: 10px; background-color:black; color:white">Back</a>
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
@foreach ($users as $user)
<form action="/user/delete/{{$user->user_id}}" method="POST">
@csrf
@method('DELETE')
<div class="modal fade text-left" id="userModal-delete-{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Employee Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>                   
          <div class="modal-body">
          <div class="col-md-12">
                <div class="form-group mb-2">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="middle_name" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $user->middle_name }}" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control" id="position" name="position" value="{{ $user->position }}" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                    <a href="/users" class="btn px-4 float-start" style="margin-top: 15px; background-color:black; color:white">Back</a>
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
    <h4 class="card-title"><a href="/users" style="text-decoration:none; color:black">List of Users</a></h4>
    <div class="add-user" align="right">
      <button type="button" data-bs-toggle="modal" data-bs-target="#userModal" id="studentadd_btn"><i class="fas fa-plus" style="padding-right: 10px;"></i>Add User</button>
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
        <thead>
          <tr>
            <th scope="col">First Name</th>
            <th scope="col">Middle Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Username</th>
            <th scope="col">Position</th>
            <th class="text-center" scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
          <tr>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->middle_name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->position }}</td>
            <td><div class="btn-group" role="group" aria-label="Default button group">
            <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#userModal-show-{{ $loop->index }}"><i class="fas fa-eye"></i></a>
            <a class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#userModal-edit-{{ $loop->index }}"><i class="fas fa-edit"></i></a>
            <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#userModal-delete-{{ $loop->index }}"><i class="fas fa-trash"></i></a>
            </div></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div>
        {{ $users->links() }}
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
  var printableContent = '<html><head><title>User List</title></head><body>';

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
    margin-top: 10px;
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

.position-field {
  width: 100%;
  height: 38px;
  padding: 6px 12px;
  font-size: 16px;
  line-height: 1.42857143;
  color: #555;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
}

.position-field:focus {
  border-color: #66afe9;
  box-shadow: 0 0 0 0.2rem rgba(102, 175, 233, 0.25);
}
</style>

@endsection