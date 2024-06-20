@extends('layout.main')

@section('content')

<form action="#" post="#">
    <a role="button" href="/"><i class="fa fa-angle-double-left" style="color: black;"></i></a>
    <h2>Registration Form</h2>
    <div class="form-group fullname">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" placeholder="Enter your full name">
    </div>
    <div class="form-group email">
        <label for="email">Email Address</label>
        <input type="text" id="email" placeholder="Enter your email address">
    </div>
    <div class="form-group password">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Enter your password">
    </div>
    <div class="form-group date">
        <label for="date">Birth Date</label>
        <input type="date" id="date" placeholder="Select your date">
    </div>
    <div class="form-group gender">
        <label for="gender">Gender</label>
        <select id="gender">
          <option value="" selected disabled>Select your gender</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Other">Other</option>
        </select>
    </div>
    <div class="form-group submit-btn">
        <input type="submit" value="Submit">
    </div>
</form>

<style>

@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap');

* {
  margin: 0;
  padding-top: 0;
  box-sizing: border-box;
  -webkit-font-smoothing: antialiased;
  font-family: 'Open Sans', sans-serif;
}

body {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 10px 10px;
  min-height: 100vh;
  background: #fafdff;
}

form {
  padding: 25px;
  background: #fff;
  display: -webkit-box;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
          flex-direction: column;
  max-width: 500px;
  width: 100%;
  border-radius: 7px;
  box-shadow: 0 2px 25px rgba(0, 0, 0, 0.2);
}

form h2 {
  font-size: 27px;
  text-align: center;
  margin: 0px 0 30px;
}

form .form-group {
  margin-bottom: 15px;
  position: relative;
}

form label {
  display: block;
  font-size: 15px;
  margin-bottom: 7px;
}

form input,
form select {
  height: 45px;
  padding: 10px;
  width: 100%;
  font-size: 15px;
  outline: none;
  background: #fff;
  border-radius: 3px;
  border: 1px solid #bfbfbf;
}

form input:focus,
form select:focus {
  border-color: #9a9a9a;
}

form input.error,
form select.error {
  border-color: #f91919;
  background: #f9f0f1;
}

form small {
  font-size: 14px;
  margin-top: 5px;
  display: block;
  color: #f91919;
}

.submit-btn {
  margin-top: 30px;
}

.submit-btn input {
  color: white;
  border: none;
  height: auto;
  font-size: 16px;
  padding: 13px 0;
  border-radius: 5px;
  cursor: pointer;
  font-weight: 500;
  text-align: center;
  background: black;
  transition: 0.2s ease;
}

.submit-btn input:hover {
  background: gray;
}
    
</style>
