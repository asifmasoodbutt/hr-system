<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="wrapper-page">
        <div class="card card-pages shadow-none">

            <div class="card-body">
                <div class="text-center m-t-0 m-b-15">
                    <h3>HR Management System</h3>
                </div>
                <h5 class="font-18 text-center">Login to the system</h5>

                <form class="form-horizontal m-t-30">

                    <div class="form-group">
                        <div class="col-12">
                            <label>Email</label>
                            <input id="email-field" class="form-control" type="text" required="" placeholder="Email">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label>Password</label>
                            <input id="password-field" class="form-control" type="password" required="" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-12">
                            <button onclick="sendLoginRequest()" class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>

                    <div class="form-group row m-t-30 m-b-0">
                        <div class="col-sm-7">
                            <a href="{{ route('forgotPassword') }}" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?
                            </a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- END wrapper -->
    <script>
        function sendLoginRequest() {
            let email = document.getElementById("email-field").value;
            let password = document.getElementById("password-field").value;
            const postObj = {
                email: email,
                password: password
            };
            let post = JSON.stringify(postObj)
            const url = "http://127.0.0.1:8000/api/login"
            let xhr = new XMLHttpRequest()
            xhr.open('POST', url, true)
            xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8')
            xhr.setRequestHeader('Accept', 'application/json');
            xhr.send(post);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var APP_URL = "{{ url('/') }}";
                    console.log(APP_URL);
                    var data = JSON.parse(xhr.responseText);
                    localStorage.setItem('token', data.response.token);
                    window.location = "{{ route('dashboard') }}";
                } else {
                    // Login failed, display error message
                    // const response = JSON.parse(xhr.responseText);
                    // alert(response);
                    // const error = document.getElementById('error');
                    // error.innerHTML = response.message;
                }
            }
        }
    </script>
</body>

</html>