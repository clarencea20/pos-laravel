@extends('layout.main')

@section('content')

<div class="login-form">
  <form action="/process/login" method="post">
  @csrf
  <i id="cash-register" class="fas fa-cash-register"></i>
      <h1 style="margin-top: -20px;">Point of Sale System</h1>
        <div class="content">
          <div class="input-field">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username">
            @error('username')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
          </div>
          <div class="input-field">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
          </div>
        </div>
        <div class="action">
          <button type="submit">Login</button>
        </div>
  </form>
</div>
@if (session('error'))
  <script>
    setTimeout(function() {
      Swal.fire({
        icon: 'error',
        title: 'Try Again!',
        text: '{{ session("error") }}',
      })
    }, 100); // Delay by 100ms
  </script>
@endif

@if (session('logout'))
  <script>
    setTimeout(function(){
      Swal.fire({
        icon: 'success',
        title: 'Thank you!',
        text: '{{ session("logout") }}',
      })
    }, 100);
  </script>
@endif

<style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  -webkit-font-smoothing: antialiased;
}

body {
  background: #fafdff;
  font-family: 'Rubik', sans-serif;
}

#cash-register {
    font-size: 4em; /* Adjust this value to make the icon bigger or smaller */
    display: inline-block;
    margin: 0 auto; /* This will center the icon */
    margin-top: 30px;
}

.login-form {
  background: #fff;
  width: 500px;
  margin: 65px auto;
  display: -webkit-box;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
          flex-direction: column;
  border-radius: 4px;
  box-shadow: 0 2px 25px rgba(0, 0, 0, 0.2);
  text-align: center;
}

   /* For screens smaller than 768px (tablets and mobile devices) */
   @media (max-width: 768px) {
      .login-form {
        width: 90%; /* Adjust width to fit smaller screens */
        margin: 20px auto; /* Reduce margin for smaller screens */
        margin-top: 80px;
      }
    }

    /* For screens smaller than 480px (smaller mobile devices) */
    @media (max-width: 480px) {
      .login-form {
        width: 90%; /* Take up full width on small screens */
        margin: 10px auto; /* Reduce margin even further */
        margin-top: 80px;
      }
      .login-form h1, .login-form h2 {
        font-size: 18px; /* Reduce font size for smaller screens */
      }
      .login-form .input-field input {
        font-size: 14px; /* Reduce font size for smaller screens */
      }
    }

.login-form h1 {
  padding: 35px 35px 0 35px;
  font-weight: 300;
  text-align: center;
}
.login-form h2 {
  padding: 5px 35px 0 35px;
  font-weight: 200;
  text-align: center;
}
.login-form .content {
  padding: 35px;
  text-align: left;
}
.login-form .input-field {
  padding: 12px 5px;
}
.login-form .input-field input {
  font-size: 16px;
  display: block;
  font-family: 'Rubik', sans-serif;
  width: 100%;
  padding: 10px 1px;
  border: 0;
  border-bottom: 1px solid #747474;
  outline: none;
  -webkit-transition: all .2s;
  transition: all .2s;
}
.login-form .input-field input::-webkit-input-placeholder {
  text-transform: uppercase;
}
.login-form .input-field input::-moz-placeholder {
  text-transform: uppercase;
}
.login-form .input-field input:-ms-input-placeholder {
  text-transform: uppercase;
}
.login-form .input-field input::-ms-input-placeholder {
  text-transform: uppercase;
}
.login-form .input-field input::placeholder {
  text-transform: uppercase;
}
.login-form .input-field input:focus {
  border-color: #222;
}
.login-form a.link {
  text-decoration: none;
  color: #747474;
  letter-spacing: 0.2px;
  text-transform: uppercase;
  display: inline-block;
  margin-top: 20px;
}
.login-form .action {
  display: -webkit-box;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
          flex-direction: row;
}
.login-form .action button {
  width: 100%;
  border: none;
  padding: 18px;
  font-family: 'Rubik', sans-serif;
  cursor: pointer;
  text-transform: uppercase;
  background: #000305;
  color: #f0f3f5;
  border-bottom-left-radius: 4px;
  border-bottom-right-radius: 0;
  letter-spacing: 0.2px;
  outline: 0;
  -webkit-transition: all .3s;
  transition: all .3s;
}
.login-form .action button:hover {
  background: #d8d8d8;
}
.login-form .action button:nth-child(2) {
  background: #2d3b55;
  color: #fff;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 4px;
}
.login-form .action button:nth-child(2):hover {
  background: #3c4d6d;
}

</style>

@endsection