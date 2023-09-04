<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <h3>Registered Here:</h3>
                <form  method="POST" id="regformdata" enctype="multipart/form-data">
                    @csrf
                    <label>Name:</label>
                    <input type="text" name="name" class="form-control"><br>

                    <label>Email:</label>
                    <input type="email" name="email" class="form-control"><br>

                    <label>Password:</label>
                    <input type="password" name="password" class="form-control"><br>

                    <label>Address:</label>
                    <textarea type="address" name="address" class="form-control"></textarea><br>

                    <label>Contact No.:</label>
                    <input type="text" name="phone_no" class="form-control"><br>

                    <label>Select Role:</label>
                    <select name="role" id="role" class="form-control">
                        <option value="1">Seller</option>
                        <option value="2">Buyer</option>
                    </select><br>

                    <label>Profile:</label>
                    <input type="file" name="profile" class="form-control"><br>
                    <div>
                        <button type="submit" class="btn btn-block btn-danger" id="register">Registration</button><br>
                        <div class="text-center">
                            <a href="{{route('login')}}" class="btn btn-primary">Back to Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#regformdata").submit(function(e) {
            event.preventDefault();

            var regformdata = new FormData(this);
            var url = "{{route('add_registration')}}";

            $.ajax({
            url: url,
            type: 'POST',
            data: regformdata,
            dataType:'json',
            contentType: false,
            processData: false,

            success: function(response){
                if (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'You are registered successfully!',
                            footer: "<a href={{route('login')}}>Login</a>"
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong!',
                            footer: "<a href={{route('login')}}>Login</a>"
                        })
                    }
            }
            });
        });
    });
</script>