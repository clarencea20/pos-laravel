@extends('layout.main')

@section('content')

@include('include.sidebar')

<form action="store" method="post" enctype="multipart/form-data">
@csrf
<div class="container mt-4"> 
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h5 style="margin-top: 5px; margin-bottom: 5px;">Add User</h5>
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-md-7">
                  <div class="form-group mb-2">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" placeholder="Enter Your First Name" id="first_name" name="first_name">
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group mb-2">
                    <label for="middle_name" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" placeholder="Enter Your Middle Name" id="middle_name" name="middle_name">
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="form-group mb-2">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" placeholder="Enter Your Last Name" id="last_name" name="last_name">
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group mb-2">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control" placeholder="Enter Your Position" id="position" name="position">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group mb-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" placeholder="Enter Your Username" id="username" name="username">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group mb-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Enter Your Password" id="password" name="password">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group mb-2">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" placeholder="Confirm Password" id="confirm_password" name="confirm_password">
                  </div>
                </div>
                <div class="col-md-12">
                    <a href="/users" class="btn px-4 float-start" style="margin-top: 10px; background-color:black; color:white">Back</a>
                    <button type="submit" class="btn px-4 float-end" style="margin-top: 10px; background-color:black; color:white">Add</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</form>

@endsection
