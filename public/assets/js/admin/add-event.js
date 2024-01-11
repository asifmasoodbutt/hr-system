const token = localStorage.getItem('token');
// Call the functions on page load
window.onload = function () {
    getEventTypes();
    getUsers();
}

$(document).ready(function () {

    // Ajax call
    $("#add-event-btn").on("click", function (event) {
        event.preventDefault();

        const form = $("#add-event-form");

        let fromDateTime = new Date($("#fromDateTime").val());
        let toDateTime = new Date($("#toDateTime").val());
        
        let formattedFromDate = formatDate(fromDateTime);
        console.log(formattedFromDate);
        let formattedToDate = formatDate(toDateTime);
        console.log(formattedToDate);

        let formData = {
            title: $("#title").val(),
            event_type_id: $("#eventTypeId").val(),
            from_date: formattedFromDate,
            to_date: formattedToDate,
            manager_id: $("#managerId").val()
        };

        // Make the Ajax call
        $.ajax({
            type: "POST",
            url: add_event_endpoint,
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

// Format the to and from date
function formatDate(date) {
    // Format the date as Y-m-d H:i:s
    let year = date.getFullYear();
    let month = String(date.getMonth() + 1).padStart(2, '0');
    let day = String(date.getDate()).padStart(2, '0');
    let hours = String(date.getHours()).padStart(2, '0');
    let minutes = String(date.getMinutes()).padStart(2, '0');
    let seconds = String(date.getSeconds()).padStart(2, '0');

    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}


// Get event types for dropdown
function getEventTypes() {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                try {
                    const data = JSON.parse(this.responseText);
                    const optionsData = data.data;
                    // Select tag with id 'leaveTypeId'
                    const eventTypeSelect = document.querySelector('#eventTypeId');
                    // Remove any existing options from the select tag
                    eventTypeSelect.innerHTML = '';
                    // Iterate over the data received from AJAX call and create options
                    optionsData.forEach(option => {
                        const optionTag = document.createElement('option');
                        optionTag.value = option.id; // Set the value of the option
                        optionTag.text = option.name; // Set the text of the option
                        eventTypeSelect.appendChild(optionTag); // Add the option to the select tag
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
    xhttp.open('GET', get_event_types_endpoint, true);
    if (token) {
        xhttp.setRequestHeader('Authorization', `Bearer ${token}`);
    }
    xhttp.setRequestHeader("Accept", "application/json");
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send();
}

// Get users(managers) for dropdown
function getUsers() {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                try {
                    const data = JSON.parse(this.responseText);
                    const optionsData = data.data;
                    // Select tag with id 'leaveTypeId'
                    const managerIdSelect = document.querySelector('#managerId');
                    // Remove any existing options from the select tag
                    managerIdSelect.innerHTML = '';
                    // Iterate over the data received from AJAX call and create options
                    optionsData.forEach(option => {
                        const optionTag = document.createElement('option');
                        optionTag.value = option.id; // Set the value of the option
                        optionTag.text = option.first_name + ' ' + option.last_name; // Set the text of the option
                        managerIdSelect.appendChild(optionTag); // Add the option to the select tag
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
    xhttp.open('GET', get_users_endpoint, true);
    if (token) {
        xhttp.setRequestHeader('Authorization', `Bearer ${token}`);
    }
    xhttp.setRequestHeader("Accept", "application/json");
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send();
}