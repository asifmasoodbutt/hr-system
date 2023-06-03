<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        #new-password-error-message,
        #confirm-password-error-message {
            color: red;
        }

        #api-alert-box {
            top: 20px;
        }
    </style>
</head>

<body>

    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-5">HR Management System</h3>
                            <p>Please enter your new password and confirm it!</p>
                            <form class="form-horizontal m-t-30" id="new-password-form">

                                <div class="form-outline mb-4">
                                    <input type="password" id="new-password" class="form-control form-control-lg" placeholder="New Password" required />
                                </div>

                                <div class="col-12" style="display: none;" id="new-password-validation-div">
                                    <p id="new-password-error-message"></p>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="password-confirmation" class="form-control form-control-lg" placeholder="Confirm Password" required />
                                </div>

                                <div class="col-12" style="display: none;" id="confirm-password-validation-div">
                                    <p id="confirm-password-error-message"></p>
                                </div>

                                <button class="btn btn-primary btn-lg btn-block" id="submit-button" type="submit" disabled>Reset Password</button>

                                <div class="col-12 alert alert-danger" style="display: none;" id="api-alert-box">
                                    <p id="api-message"></p>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

<script>
    let new_password = document.getElementById('new-password');
    let confirm_password = document.getElementById('password-confirmation');
    let new_password_error_box = document.getElementById('new-password-validation-div');
    let confirm_password_error_box = document.getElementById('confirm-password-validation-div');
    let new_password_error_message = document.getElementById('new-password-error-message');
    let confirm_password_error_message = document.getElementById('confirm-password-error-message');
    let submit_button = document.getElementById('submit-button');
    let api_alert_box = document.getElementById('api-alert-box');
    let api_message = document.getElementById('api-message');

    new_password.addEventListener("input", checkInputs);
    confirm_password.addEventListener("input", checkInputs);

    function checkInputs() {
        // Check if the new password and confirm password fields are valid
        if (new_password.value.length >= 8) {
            new_password_error_box.style.display = "none";
            if (new_password.value == confirm_password.value) {
                confirm_password_error_box.style.display = "none";
                submit_button.removeAttribute("disabled");
            } else {
                confirm_password_error_box.removeAttribute('style');
                confirm_password_error_message.innerHTML = 'This password should match the above password!';
                submit_button.setAttribute("disabled", "");
            }
        } else {
            new_password_error_box.removeAttribute('style');
            new_password_error_message.innerHTML = 'Password should have minimum length of 8 digits!';
            submit_button.setAttribute("disabled", "");
        }
    }
</script>

<script>
    let urlObject = new URL(window.location.href);
    let pathname = urlObject.pathname;
    let url_array = pathname.split('/');
    let form = document.getElementById('new-password-form');
    
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        submit_button.disabled = true;
        submit_button.innerHTML = 'Reseting Password...';
        const postObj = {
            password: new_password.value,
            password_confirmation: confirm_password.value,
            token: url_array[2],
            email: url_array[3]
        };
        let dataObj = JSON.stringify(postObj)
        const url = @json(config('constants.RESET_PASSWORD_ENDPOINT'));
        let xhr = new XMLHttpRequest()
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                submit_button.disabled = false;
                submit_button.innerHTML = 'Reset Password';
                if (xhr.status === 200) {
                    // Successful reset password
                    const response = JSON.parse(xhr.responseText);
                    api_alert_box.classList.replace('alert-danger', 'alert-success');
                    api_message.innerHTML = response.data.message;
                    api_alert_box.removeAttribute('style');
                    setTimeout(() => {
                        api_alert_box.style.display = 'none';
                        window.location = "{{ route('login') }}";
                    }, 5000);
                } else {
                    // Failed in sending email
                    const response = JSON.parse(xhr.responseText);
                    api_alert_box.removeAttribute('style');
                    api_message.innerHTML = response.message;
                    setTimeout(() => {
                        api_alert_box.style.display = 'none';
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

</html>