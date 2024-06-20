@extends('layout.main')

@section('content')

@include('include.sidebar')

<div class="container mt-4"> 
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h5>User Information</h5>
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-md-7">
                  <div class="form-group mb-2">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" readonly>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group mb-2">
                    <label for="middle_name" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $user->middle_name }}" readonly>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="form-group mb-2">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" readonly>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group mb-2">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control" id="position" name="position" value="{{ $user->position }}" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group mb-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                    <a href="/users" class="btn px-4 float-start" style="margin-top: 10px; background-color:black; color:white">Back</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection
