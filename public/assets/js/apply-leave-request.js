const token = localStorage.getItem('token');
// Call the functions on page load
window.onload = function () {
    getLeaveTypes();
}

$(document).ready(function () {

    // Input Validations


    // Ajax call
    $("#apply-leave-btn").on("click", function (event) {
        event.preventDefault();

        const form = $("#apply-leave-form");
        let formData = {
            leave_type_id: $("#leaveTypeId").val(),
            from_date: $("#fromDate").val(),
            to_date: $("#toDate").val(),
            description: $("#description").val()
        };

        // Make the Ajax call
        $.ajax({
            type: "POST",
            url: apply_leave_request_endpoint,
            headers: {
                "Authorization": `Bearer ${token}`
            },
            dataType: "json",
            data: formData,
            success: function (response) {
                form[0].reset();
                generateMessage('success', 'Success', response.message);
            },
            error: function (xhr, status, error) {
                var responseJSON = xhr.responseJSON;
                if (responseJSON && responseJSON.errors && responseJSON.message) {
                    generateMessage('danger', 'Error', responseJSON.message);
                } else {
                    generateMessage('danger', 'Error', 'Something went wrong!');
                }
            }
        });
    });
});


// Get leave types for dropdown
function getLeaveTypes() {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                try {
                    const data = JSON.parse(this.responseText);
                    const optionsData = data.data;
                    // Select tag with id 'leaveTypeId'
                    const leaveTypeSelect = document.querySelector('#leaveTypeId');
                    // Remove any existing options from the select tag
                    leaveTypeSelect.innerHTML = '';
                    // Iterate over the data received from AJAX call and create options
                    optionsData.forEach(option => {
                        const optionTag = document.createElement('option');
                        optionTag.value = option.id; // Set the value of the option
                        optionTag.text = option.leave_type; // Set the text of the option
                        leaveTypeSelect.appendChild(optionTag); // Add the option to the select tag
                    });
                } catch (error) {
                    // Generate error notification
                    generateMessage('danger', 'Error', error);
                }
            } else {
                // Generate error notification
                generateMessage('danger', 'Error', `Request failed with status ${this.status}`);
            }
        }
    };
    xhttp.open('GET', get_leave_types_endpoint, true);
    if (token) {
        xhttp.setRequestHeader('Authorization', `Bearer ${token}`);
    }
    xhttp.setRequestHeader("Accept", "application/json");
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send();
}
