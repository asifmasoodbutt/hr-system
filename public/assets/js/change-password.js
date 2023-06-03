const token = localStorage.getItem('token');
$(document).ready(function () {

    // Input Validation
    let inputs = {
        currentPassword: {
            element: $('#currentPassword'),
            validationDiv: $('#currentPasswordValidationDiv'),
            errorMessage: $('#currentPasswordErrorMessage'),
            minLength: 8
        },
        newPassword: {
            element: $('#newPassword'),
            validationDiv: $('#newPasswordValidationDiv'),
            errorMessage: $('#newPasswordErrorMessage'),
            minLength: 8
        },
        confirmPassword: {
            element: $('#confirmPassword'),
            validationDiv: $('#confirmPasswordValidationDiv'),
            errorMessage: $('#confirmPasswordErrorMessage')
        }
    };

    let changePasswordBtn = $('#changePasswordBtn');

    inputs.currentPassword.element.on('input', checkInputs);
    inputs.newPassword.element.on('input', checkInputs);
    inputs.confirmPassword.element.on('input', checkInputs);

    function checkInputs() {
        let allConditionsMet = true;

        for (let inputKey in inputs) {
            let input = inputs[inputKey];
            let inputValue = input.element.val();

            if (inputValue.length >= input.minLength || !input.minLength) {
                input.validationDiv.addClass('hiddenDiv');
            } else {
                input.validationDiv.removeClass('hiddenDiv');
                input.errorMessage.text(`Your ${inputKey} should have a minimum length of ${input.minLength} digits!`);
                allConditionsMet = false;
            }
        }

        if (inputs.confirmPassword.element.val() === inputs.newPassword.element.val()) {
            inputs.confirmPassword.validationDiv.addClass('hiddenDiv');
        } else {
            inputs.confirmPassword.validationDiv.removeClass('hiddenDiv');
            inputs.confirmPassword.errorMessage.text('This password should match the new password!');
            allConditionsMet = false;
        }

        if (allConditionsMet) {
            changePasswordBtn.removeAttr('disabled');
        } else {
            changePasswordBtn.attr('disabled', 'disabled');
        }
    }

    // Ajax call
    $("#changePasswordBtn").on("click", function (event) {
        event.preventDefault();

        const form = $("#changePasswordForm");
        var formData = {
            current_password: $("#currentPassword").val(),
            password: $("#newPassword").val(),
            password_confirmation: $("#confirmPassword").val()
        };

        var changePasswordBtn = $("#changePasswordBtn");

        // Make the Ajax call
        $.ajax({
            type: "POST",
            url: change_password_endpoint,
            headers: {
                "Authorization": `Bearer ${token}`
            },
            dataType: "json",
            data: formData,
            success: function (response) {
                form[0].reset();
                $("#myElement").attr("disabled", true);
                let apiValidationErrorBox = $('#apiValidationErrorBox');
                let apiValidationErrorMessage = $('#apiValidationErrorMessage');

                apiValidationErrorBox.removeClass('hiddenDiv alert-danger').addClass('alert-success');
                apiValidationErrorMessage.text(response.data.message).addClass('text-green');

                changePasswordBtn.prop("disabled", true); // Disable the button

                setTimeout(function () {
                    apiValidationErrorBox.removeClass('alert-success').addClass('alert-danger hiddenDiv');
                    apiValidationErrorMessage.removeClass('text-green');
                }, 5000);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                let apiValidationErrorBox = $('#apiValidationErrorBox');
                let apiValidationErrorMessage = $('#apiValidationErrorMessage');

                apiValidationErrorBox.removeClass('hiddenDiv');
                apiValidationErrorMessage.text(jqXHR.responseJSON.message).addClass('redError');

                setTimeout(function () {
                    apiValidationErrorBox.addClass('hiddenDiv');
                }, 5000); // 5000 milliseconds = 5 seconds
            }
        });
    });
});
