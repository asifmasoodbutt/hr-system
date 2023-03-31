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

    #error-alert-box {
        top: 20px;
    }

    #forgot-password-link {
        padding-top: 15px;
        padding-left: 15px;
    }
</style>

<body>

    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-5">HR Management System</h3>
                            <p>Please enter your login and password!</p>
                            <form class="form-horizontal m-t-30" id="login-form">
                                <div class="form-outline mb-4">
                                    <input type="email" id="email-field" class="form-control form-control-lg" placeholder="Email" required />
                                </div>

                                <div class="col-12" style="display: none;" id="email-validation-div">
                                    <p id="email-error-message"></p>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="password-field" class="form-control form-control-lg" placeholder="Password" required />
                                </div>

                                <div class="col-12" style="display: none;" id="password-validation-div">
                                    <p id="password-error-message"></p>
                                </div>

                                <!-- Checkbox -->
                                <!-- <div class="form-check d-flex justify-content-start mb-4">
                                <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
                                <label class="form-check-label" for="form1Example3"> Remember password </label>
                            </div> -->

                                <button class="btn btn-primary btn-lg btn-block" id="submit-button" type="submit" disabled>Login</button>

                                <div class="col-12 alert alert-danger" style="display: none;" id="error-alert-box">
                                    <p id="error-message"></p>
                                </div>

                                <div class="form-group row m-t-30 m-b-0" id="forgot-password-link">
                                    <a href="{{ route('forgotPassword') }}" class="text-muted"> Forgot your password?
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let email_error_box = document.getElementById('email-validation-div');
        let pwd_error_box = document.getElementById('password-validation-div');
        let email_error_message = document.getElementById('email-error-message');
        let pwd_error_message = document.getElementById('password-error-message');
        let error_alert_box = document.getElementById('error-alert-box');
        let error_message = document.getElementById('error-message');
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
                email: email.value,
                password: password.value
            };
            let dataObj = JSON.stringify(postObj)
            const url = @json(config('constants.LOGIN_ENDPOINT'));
            let xhr = new XMLHttpRequest()
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Successful login
                        const response = JSON.parse(xhr.responseText);
                        // Store access token in local storage
                        localStorage.setItem('token', response.data.token);
                        window.location = "{{ route('dashboard') }}"; // Redirect to dashboard page
                    } else {
                        // Failed login
                        const response = JSON.parse(xhr.responseText);
                        error_alert_box.removeAttribute('style');
                        error_message.innerHTML = response.message;
                        setTimeout(() => {
                            error_alert_box.style.display = 'none';
                        }, 5000);
                    }
                }
            }
            xhr.open('POST', url);
            xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8')
            xhr.setRequestHeader('Accept', 'application/json');
            xhr.send(dataObj);
        });
    </script>
</body>

</html>