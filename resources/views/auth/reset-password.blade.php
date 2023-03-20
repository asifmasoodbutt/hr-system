<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>

    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="home-btn d-none d-sm-block">
        <a href="index.html" class="text-white"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="wrapper-page">
        <div class="card card-pages shadow-none">

            <div class="card-body">
                <div class="text-center m-t-0 m-b-15">
                    <a href="index.html" class="logo logo-admin"><img src="assets/images/logo-dark.png" alt="" height="24"></a>
                </div>
                <h5 class="font-18 text-center">New Password</h5>

                <form class="form-horizontal m-t-30" action="index.html">

                    <div class="form-group">
                        <div class="col-12">
                            <label>New Password</label>
                            <input id="new-password" class="form-control" type="password" required placeholder="New Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label>Confirm Password</label>
                            <input id="password-confirmation" class="form-control" type="password" required placeholder="Confirm Password">
                        </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-12">
                            <button onclick="return sendResetPasswordRequest()" class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="button">Reset Password</button>
                        </div>
                    </div>

                    <div class="col-12" style="display: none;" id="error-alert-box">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <p id="error-message"></p>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- END wrapper -->

</body>
<script>
    function sendResetPasswordRequest() {
        let new_password = document.getElementById("new-password").value;
        let password_confirmation = document.getElementById("password-confirmation").value;
        let error_alert_box = document.getElementById('error-alert-box');
        let error_message = document.getElementById('error-message');
        if (new_password != password_confirmation) {
            error_alert_box.removeAttribute('style');
            error_message.innerHTML = 'The password does not match!';
            return false;
        }
        const postObj = {
            password: new_password,
            password_confirmation: password_confirmation
        };
        let post = JSON.stringify(postObj)
        const url = @json(config('constants.RESET_PASSWORD_ENDPOINT'));
        let xhr = new XMLHttpRequest()
        xhr.open('POST', url, true)
        xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8')
        xhr.setRequestHeader('Accept', 'application/json');
        xhr.send(post);
        xhr.onload = function() {
            var response = JSON.parse(xhr.responseText);
            if (xhr.status === 200) {
                window.location = "{{ route('dashboard') }}";
            } else {
                let error_alert_box = document.getElementById('error-alert-box');
                let error_message = document.getElementById('error-message');
                error_alert_box.removeAttribute('style');
                error_message.innerHTML = response.message;
                return false;
            }
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</html>