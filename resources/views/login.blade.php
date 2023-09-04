<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
    label.error {
      color: #dc3545;
      font-size: 14px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form action="{{route('login_check')}}" method="POST" id="login_form">
          @csrf
          <h3>Login Here:</h3>
          <label>Email:</label>
          <input type="email" name="email" class="form-control" placeholder="Enter Email"><br>

          <label>Password:</label>
          <input type="password" name="password" class="form-control" placeholder="Enter Password"><br>

          <div>
            <button type="submit" class="btn btn-block btn-danger">Login</button>
            <a href="{{route('registration')}}" class="btn btn-primary">don't have an account?</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
  $(function() {
    $("#login_form").validate({
      rules: {
       
        email: {
          required: true,
          email: true,
          maxlength: 50
        },
        password: {
          required: true,
          minlength: 5
        },
       
      },
      messages: {
       
        email: {
          required: "Email is required",
          email: "Email must be a valid email address",
          maxlength: "Email cannot be more than 50 characters",
        },
        password: {
          required: "Password is required",
          minlength: "Password must be at least 5 characters"
        },
       
      }
    });
  });
</script>