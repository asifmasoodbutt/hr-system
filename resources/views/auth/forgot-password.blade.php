<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        #email-error-message {
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
                            <p>Please enter your email to get reset link!</p>
                            <form class="form-horizontal m-t-30" id="reset-form">
                                <div class="form-outline mb-4">
                                    <input type="email" id="email-field" class="form-control form-control-lg" placeholder="Email" required />
                                </div>

                                <div class="col-12" style="display: none;" id="email-validation-div">
                                    <p id="email-error-message"></p>
                                </div>

                                <button class="btn btn-primary btn-lg btn-block" id="submit-button" type="submit" disabled>Send Link</button>

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

    <script>
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let email_error_box = document.getElementById('email-validation-div');
        let email_error_message = document.getElementById('email-error-message');
        let submit_button = document.getElementById('submit-button');
        let email = document.getElementById("email-field");
        let api_alert_box = document.getElementById('api-alert-box');
        let api_message = document.getElementById('api-message');

        email.addEventListener("input", () => {
            // Check if the email is valid
            if (regex.test(email.value)) {
                email_error_box.style.display = "none";
                submit_button.removeAttribute("disabled");
            } else {
                email_error_box.removeAttribute('style');
                email_error_message.innerHTML = 'You have entered an invalid email address!';
                submit_button.setAttribute("disabled", "");
            }
        });
    </script>
    <script>
        let form = document.getElementById('reset-form');
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            submit_button.disabled = true;
            submit_button.innerHTML = 'Sending...';
            const postObj = {
                email: email.value,
            };
            let dataObj = JSON.stringify(postObj)
            const url = @json(config('constants.FORGOT_PASSWORD_ENDPOINT'));
            let xhr = new XMLHttpRequest()
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    submit_button.disabled = false;
                    submit_button.innerHTML = 'Send Link';
                    if (xhr.status === 200) {
                        // Successful sent email
                        email.value = ""
                        const response = JSON.parse(xhr.responseText);
                        api_alert_box.classList.replace('alert-danger', 'alert-success');
                        api_message.innerHTML = response.data.message;
                        api_alert_box.removeAttribute('style');
                        setTimeout(() => {
                            api_alert_box.style.display = 'none';
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

</body>

</html>