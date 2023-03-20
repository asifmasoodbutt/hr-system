<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<style>
    #email-error-message,
    #password-error-message {
        color: red;
    }
</style>

<body>
    <!-- Begin page -->
    <div class="wrapper-page">
        <div class="card card-pages shadow-none">

            <div class="card-body">
                <div class="text-center m-t-0 m-b-15">
                    <h3>HR Management System</h3>
                </div>
                <h5 class="font-18 text-center">Login to the system</h5>

                <form class="form-horizontal m-t-30" id="login-form">

                    <div class="form-group">
                        <div class="col-12">
                            <label>Email</label>
                            <input id="email-field" class="form-control" type="text" placeholder="Email" required>
                        </div>
                    </div>

                    <div class="col-12" style="display: none;" id="email-validation-div">
                        <p id="email-error-message"></p>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label>Password</label>
                            <input id="password-field" class="form-control" type="password" required placeholder="Password">
                        </div>
                    </div>

                    <div class="col-12" style="display: none;" id="password-validation-div">
                        <p id="password-error-message"></p>
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-12">
                            <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" id="submit-button" type="submit" disabled>Log In</button>
                        </div>
                    </div>

                    <div class="col-12" style="display: none;" id="error-alert-box">
                        <div class="alert alert-danger">
                            <p id="error-message"></p>
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
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let email_error_box = document.getElementById('email-validation-div');
        let pwd_error_box = document.getElementById('password-validation-div');
        let email_error_message = document.getElementById('email-error-message');
        let pwd_error_message = document.getElementById('password-error-message');
        let submit_button = document.getElementById('submit-button');
        let email = document.getElementById("email-field");
        let password = document.getElementById("password-field")

        email.addEventListener("input", checkInputs);
        password.addEventListener("input", checkInputs);

        function checkInputs() {
            // Check if the email and password are valid
            if (regex.test(email.value)) {
                email_error_box.style.display = "none";
                if (password.value.length >= 8) {
                    pwd_error_box.style.display = "none";
                    submit_button.removeAttribute("disabled");
                } else {
                    pwd_error_box.removeAttribute('style');
                    pwd_error_message.innerHTML = 'Password should have minimum length of 8 digits!';
                    submit_button.setAttribute("disabled", "");
                }
            } else {
                email_error_box.removeAttribute('style');
                email_error_message.innerHTML = 'You have entered an invalid email address!';
                submit_button.setAttribute("disabled", "");
            }
        }
    </script>
    <script>
        const form = document.getElementById('login-form');
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const postObj = {
                email: document.getElementById("email-field").value,
                password: document.getElementById("password-field").value
            };
            let dataObj = JSON.stringify(postObj)
            const url = @json(config('constants.LOGIN_ENDPOINT'));
            let xhr = new XMLHttpRequest()
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Successful login
                        const response = JSON.parse(xhr.responseText);
                        // Store access token or session token in local storage
                        localStorage.setItem('token', response.data.token);
                        window.location = "{{ route('dashboard') }}"; // Redirect to dashboard page
                    } else {
                        // Failed login
                        const response = JSON.parse(xhr.responseText);
                        let error_alert_box = document.getElementById('error-alert-box');
                        let error_message = document.getElementById('error-message');
                        error_alert_box.removeAttribute('style');
                        error_message.innerHTML = response.message;
                    }
                }
            }
            xhr.open('POST', url);
            xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8')
            xhr.setRequestHeader('Accept', 'application/json');
            xhr.send(dataObj);
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>