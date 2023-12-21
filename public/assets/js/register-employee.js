// Call the functions on page load
window.onload = function () {
    getDepartments();
    getDegreeLevels();
    getPayScales();
    getContractTypes();
}

// Get departments for dropdown
function getDepartments() {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                try {
                    const data = JSON.parse(this.responseText);
                    const optionsData = data.data;
                    // Select tag with id 'select-department'
                    const deptSelect = document.querySelector('#select-department');
                    // Remove any existing options from the select tag
                    deptSelect.innerHTML = '';
                    // Iterate over the data received from AJAX call and create options
                    optionsData.forEach(option => {
                        const optionTag = document.createElement('option');
                        optionTag.value = option.id; // Set the value of the option
                        optionTag.text = option.name; // Set the text of the option
                        deptSelect.appendChild(optionTag); // Add the option to the select tag
                    });
                } catch (error) {
                    console.error(error);
                }
            } else {
                console.error(`Request failed with status ${this.status}`);
            }
        }
    };
    xhttp.open('GET', get_departments_url, true);
    const token = localStorage.getItem('token');
    if (token) {
        xhttp.setRequestHeader('Authorization', `Bearer ${token}`);
    }
    xhttp.setRequestHeader("Accept", "application/json");
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send();
}

// Get degree levels for dropdown
function getDegreeLevels() {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                try {
                    const data = JSON.parse(this.responseText);
                    const optionsData = data.data;
                    // Select tag with id 'select-department'
                    const degreeLevelSelect = document.querySelector('#select-degree-levels');
                    // Remove any existing options from the select tag
                    degreeLevelSelect.innerHTML = '';
                    // Iterate over the data received from AJAX call and create options
                    optionsData.forEach(option => {
                        const optionTag = document.createElement('option');
                        optionTag.value = option.id; // Set the value of the option
                        optionTag.text = option.level; // Set the text of the option
                        degreeLevelSelect.appendChild(optionTag); // Add the option to the select tag
                    });
                } catch (error) {
                    console.error(error);
                }
            } else {
                console.error(`Request failed with status ${this.status}`);
            }
        }
    };
    xhttp.open('GET', get_degree_levels_url, true);
    const token = localStorage.getItem('token');
    if (token) {
        xhttp.setRequestHeader('Authorization', `Bearer ${token}`);
    }
    xhttp.setRequestHeader("Accept", "application/json");
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send();
}

// Get pay scales for dropdown
function getPayScales() {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                try {
                    const data = JSON.parse(this.responseText);
                    const optionsData = data.data;
                    // Select tag with id 'select-department'
                    const PayScaleSelect = document.querySelector('#select-pay-scales');
                    // Remove any existing options from the select tag
                    PayScaleSelect.innerHTML = '';
                    // Iterate over the data received from AJAX call and create options
                    optionsData.forEach(option => {
                        const optionTag = document.createElement('option');
                        optionTag.value = option.id; // Set the value of the option
                        optionTag.text = option.level; // Set the text of the option
                        PayScaleSelect.appendChild(optionTag); // Add the option to the select tag
                    });
                } catch (error) {
                    console.error(error);
                }
            } else {
                console.error(`Request failed with status ${this.status}`);
            }
        }
    };
    xhttp.open('GET', get_pay_scales_url, true);
    const token = localStorage.getItem('token');
    if (token) {
        xhttp.setRequestHeader('Authorization', `Bearer ${token}`);
    }
    xhttp.setRequestHeader("Accept", "application/json");
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send();
}

// Get contract types for dropdown
function getContractTypes() {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                try {
                    const data = JSON.parse(this.responseText);
                    const optionsData = data.data;
                    // Select tag with id 'select-department'
                    const PayScaleSelect = document.querySelector('#select-contract-types');
                    // Remove any existing options from the select tag
                    PayScaleSelect.innerHTML = '';
                    // Iterate over the data received from AJAX call and create options
                    optionsData.forEach(option => {
                        const optionTag = document.createElement('option');
                        optionTag.value = option.id; // Set the value of the option
                        optionTag.text = option.type; // Set the text of the option
                        PayScaleSelect.appendChild(optionTag); // Add the option to the select tag
                    });
                } catch (error) {
                    console.error(error);
                }
            } else {
                console.error(`Request failed with status ${this.status}`);
            }
        }
    };
    xhttp.open('GET', get_contract_types_url, true);
    const token = localStorage.getItem('token');
    if (token) {
        xhttp.setRequestHeader('Authorization', `Bearer ${token}`);
    }
    xhttp.setRequestHeader("Accept", "application/json");
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send();
}

// Check if the form input details are valid
$(document).ready(function () {
    // Perform validations
    $('.input-field').on('keyup', function () {
        // Handle the change event here
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const nameRegex = /^[a-zA-Z\s]*$/;
        var currentElement = $(this);
        var nameAttribute = $(this).attr('name');
        var inputValue = $(this).val();

        switch (nameAttribute) {
            case 'first_name':
                if (inputValue.length === 0) {
                    $('#firstNameErrorDiv').removeAttr('style').text('This field is required.');
                } else if (!nameRegex.test(inputValue)) {
                    currentElement.val('');
                } else {
                    $('#firstNameErrorDiv').css('display', 'none');
                }
                break;

            case 'last_name':
                if (inputValue.length === 0) {
                    $('#lastNameErrorDiv').removeAttr('style').text('This field is required.');
                } else if (!nameRegex.test(inputValue)) {
                    currentElement.val('');
                } else {
                    $('#lastNameErrorDiv').css('display', 'none');
                }
                break;

            case 'dob':
                if (inputValue == '' || inputValue == null) {
                    $('#dobErrorDiv').removeAttr('style').text('This field is required.');
                } else {
                    $('#dobErrorDiv').css('display', 'none');
                }
                break;

            case 'email':
                if (inputValue.length === 0) {
                    $('#emailErrorDiv').removeAttr('style').text('This field is required.');
                } else if (!emailRegex.test(inputValue)) {
                    $('#emailErrorDiv').removeAttr('style').text('The email format is not correct.');
                } else {
                    $('#emailErrorDiv').css('display', 'none');
                }
                break;

            case 'password':
                if (inputValue.length === 0) {
                    $('#passwordErrorDiv').removeAttr('style').text('This field is required.');
                } else if (inputValue.length < 8) {
                    $('#passwordErrorDiv').removeAttr('style').text('The password should be at least 8 characters long.');
                } else {
                    $('#passwordErrorDiv').css('display', 'none');
                }
                break;

            case 'father_name':
                if (inputValue.length === 0) {
                    $('#fatherNameErrorDiv').removeAttr('style').text('This field is required.');
                } else if (!nameRegex.test(inputValue)) {
                    currentElement.val('');
                } else {
                    $('#fatherNameErrorDiv').css('display', 'none');
                }
                break;

            case 'cnic_number':
                if (inputValue.length === 0) {
                    $('#cnicErrorDiv').removeAttr('style').text('This field is required.');
                } else if (inputValue < 0) {
                    currentElement.val('');
                } else if (inputValue.length < 13) {
                    $('#cnicErrorDiv').removeAttr('style').text('The cnic number should be of 13 digits.');
                } else if (inputValue.length > 13) {
                    currentElement.val(inputValue.slice(0, 13));
                } else {
                    $('#cnicErrorDiv').css('display', 'none');
                }
                break;

            case 'mobile_number':
                if (inputValue.length === 0) {
                    $('#phoneErrorDiv').removeAttr('style').text('This field is required.');
                } else if (inputValue < 0) {
                    currentElement.val('');
                } else if (inputValue.length < 11) {
                    $('#phoneErrorDiv').removeAttr('style').text('The mobile number should be at least 11 digits.');
                } else if (inputValue.length > 15) {
                    currentElement.val(inputValue.slice(0, 15));
                } else {
                    $('#phoneErrorDiv').css('display', 'none');
                }
                break;

            case 'current_address':
                if (inputValue.length === 0) {
                    $('#currentAddressErrorDiv').removeAttr('style').text('This field is required.');
                } else {
                    $('#currentAddressErrorDiv').css('display', 'none');
                }
                break;

            case 'permanent_address':
                if (inputValue.length === 0) {
                    $('#permanentAddressErrorDiv').removeAttr('style').text('This field is required.');
                } else {
                    $('#permanentAddressErrorDiv').css('display', 'none');
                }
                break;

            case 'bank_name':
                if (inputValue.length === 0) {
                    $('#bankNameErrorDiv').removeAttr('style').text('This field is required.');
                } else {
                    $('#bankNameErrorDiv').css('display', 'none');
                }
                break;

            case 'bank_account_number':
                if (inputValue.length === 0) {
                    $('#bankAccountErrorDiv').removeAttr('style').text('This field is required.');
                } else if (inputValue < 0) {
                    currentElement.val('');
                } else if (inputValue.length < 6) {
                    $('#bankAccountErrorDiv').removeAttr('style').text('The account number should be at least 6 digits.');
                } else if (inputValue.length > 20) {
                    currentElement.val(inputValue.slice(0, 20));
                } else {
                    $('#bankAccountErrorDiv').css('display', 'none');
                }
                break;

            case 'institute':
                if (inputValue.length === 0) {
                    $('#instituteErrorDiv').removeAttr('style').text('This field is required.');
                } else {
                    $('#instituteErrorDiv').css('display', 'none');
                }
                break;

            case 'graduation_year':
                if (inputValue.length === 0) {
                    $('#gradYearErrorDiv').removeAttr('style').text('This field is required.');
                } else if (inputValue < 0) {
                    currentElement.val('');
                } else if (inputValue.length < 4) {
                    $('#gradYearErrorDiv').removeAttr('style').text('The year should be of 4 digits.');
                } else if (inputValue.length > 4) {
                    currentElement.val(inputValue.slice(0, 4));
                } else {
                    $('#gradYearErrorDiv').css('display', 'none');
                }
                break;

            case 'position':
                if (inputValue.length === 0) {
                    $('#positionErrorDiv').removeAttr('style').text('This field is required.');
                } else {
                    $('#positionErrorDiv').css('display', 'none');
                }
                break;

            case 'job_description':
                if (inputValue.length === 0) {
                    $('#jobDescErrorDiv').removeAttr('style').text('This field is required.');
                } else {
                    $('#jobDescErrorDiv').css('display', 'none');
                }
                break;

            case 'start_date':
                if (inputValue == '' || inputValue == null) {
                    $('#startDateErrorDiv').removeAttr('style').text('This field is required.');
                } else {
                    $('#startDateErrorDiv').css('display', 'none');
                }
                break;

            case 'spouse_name':
                if (!nameRegex.test(inputValue)) {
                    currentElement.val('');
                }
                break;

            case 'no_of_children':
                if (inputValue < 0) {
                    currentElement.val('');
                } else if (inputValue > 15) {
                    currentElement.val('');
                }
                break;
        }
    });
});

$(document).ready(function () {
    let experienceCounter = 1;

    // Add click event handler to the "Add Experiences" button
    $('.add-experiences-btn').click(function () {
        createExperienceFields();
    });

    // Function to create a new set of fields
    function createExperienceFields() {
        let container = $('#experiencesContainer');

        // Create a new div element for the fields
        let div = $('<div class="row row-cols-md-4 mb-4 text-center"></div>');

        // Set the HTML content for the fields
        div.html(`
            <div class="col themed-grid-col">
                <div class="form-group text-left">
                <label class="font-weight-bolder">Company Name <span class="required"></span></label>
                <input type="text" class="form-control experience-field" name="company_name_${experienceCounter}" maxlength="50" required placeholder="Enter employee's company name" />
                <div id="company_name_${experienceCounter}ErrorDiv"></div>
                </div>
            </div>
            <div class="col themed-grid-col">
                <div class="form-group text-left">
                <label class="font-weight-bolder">Latest Position <span class="required"></span></label>
                <input type="text" class="form-control experience-field" name="latest_position_${experienceCounter}" maxlength="50" required placeholder="Enter employee's latest position" />
                <div id="latest_position_${experienceCounter}ErrorDiv"></div>
                </div>
            </div>
            <div class="col themed-grid-col">
                <div class="form-group text-left">
                <label class="font-weight-bolder">Start Date <span class="required"></span></label>
                <input type="date" class="form-control experience-field" name="company_start_date_${experienceCounter}" required placeholder="Enter employee's joining date" />
                <div id="company_start_date_${experienceCounter}ErrorDiv"></div>
                </div>
            </div>
            <div class="col themed-grid-col">
                <div class="form-group text-left">
                <label class="font-weight-bolder">End Date <span class="required"></span></label>
                <input type="date" class="form-control experience-field" name="company_end_date_${experienceCounter}" required placeholder="Enter employee's ending date" />
                <div id="company_end_date_${experienceCounter}ErrorDiv"></div>
                </div>
            </div>
        `);
        // Append the new fields to the container
        container.append(div);

        // Increment the experience counter
        experienceCounter++;

        // Attach keyup event handler for the dynamically added fields
        div.on('keyup', '.experience-field', function () {
            validateExperienceField($(this));
        });

        // Function to validate a specific experience field
        function validateExperienceField(field) {
            var fieldValue = field.val().trim();
            var errorDiv = $('#' + field.attr('name') + 'ErrorDiv');

            if (fieldValue === '') {
                field.addClass('is-invalid');
                errorDiv.text('This field is required.').show().css('color', 'red');
                field.css('border-color', 'red');
            } else if (fieldValue.length < 3) {
                field.addClass('is-invalid');
                errorDiv.text('Field value is too short.').show().css('color', 'red');
                field.css('border-color', 'red');
            } else {
                field.removeClass('is-invalid');
                errorDiv.text('').hide();
                field.css('border-color', ''); // reset to default
            }
        }

        // Attach event handler for the newly created fields
        $('input[required]').on('input', function () {
            var isValid = checkFormValidity();
            $('#register-employee-btn').prop('disabled', !isValid);
        });
    }

    // Function to check the validity of all required fields
    function checkFormValidity() {
        var requiredFields = $('input[required]');
        var isValid = true;

        requiredFields.each(function () {
            var field = $(this);
            if (field.val().trim() === '') {
                return false; // Exit the loop early if any required field is empty
            }
        });

        return isValid;
    }

    // Attach event handlers for the input fields, including dynamically added fields
    $(document).on('input', 'input[required]', function () {
        var isValid = checkFormValidity();
        $('#register-employee-btn').prop('disabled', !isValid);
    });

    // Initial check to set the initial state of the submit button
    var isValidForm = checkFormValidity();
    $('#register-employee-btn').prop('disabled', !isValidForm);

    // Prepare payload for ajax call
    const registerEmployeeForm = $('#register-employee-form');
    $('#confirmRegisterEmployee').click(function (event) {
        event.preventDefault(); // prevent default behavior of the link

        const inputs = $('.input-field');
        const inputData = {};
        inputs.each(function () {
            inputData[$(this).attr('name')] = $(this).val();
        });

        var experiences = [];

        // Iterate over the dynamically added fields
        $('.row.row-cols-md-4.mb-4.text-center').each(function (index) {
            var companyName = $(this).find('input[name^="company_name"]').val();
            var latestPosition = $(this).find('input[name^="latest_position"]').val();
            var startDate = $(this).find('input[name^="company_start_date"]').val();
            var endDate = $(this).find('input[name^="company_end_date"]').val();

            // Create an experience object and populate its properties
            var experience = {
                company_name: companyName,
                latest_position: latestPosition,
                company_start_date: startDate,
                company_end_date: endDate
            };

            // Push the experience object to the experiences array
            experiences.push(experience);
        });

        // Add the experiences array to the inputData
        inputData.experiences = experiences;

        const url = register_employee_url;
        registerEmployee(inputData); // call your AJAX function
        registerEmployeeForm[0].reset();

        function registerEmployee(data) {
            const url = register_employee_url;
            const dataObject = {
                first_name: data.first_name,
                last_name: data.last_name,
                gender_id: parseInt(data.gender_id),
                date_of_birth: data.dob,
                email: data.email,
                password: data.password,
                father_name: data.father_name,
                cnic_number: data.cnic_number,
                mobile_number: data.mobile_number,
                current_address: data.current_address,
                permanent_address: data.permanent_address,
                department_id: parseInt(data.department_id),
                bank_name: data.bank_name,
                bank_account_number: data.bank_account_number,
                degree_level_id: parseInt(data.degree_level_id),
                institute: data.institute,
                graduation_year: data.graduation_year,
                pay_scale_id: parseInt(data.pay_scale_id),
                position: data.position,
                job_description: data.job_description,
                contract_type_id: parseInt(data.contract_type_id),
                start_date: data.start_date,
                end_date: data.end_date,
                experiences: data.experiences,
                spouse_name: data.spouse_name,
                no_of_children: parseInt(data.no_of_children)
            };

            $.ajax({
                url: url,
                method: 'POST',
                data: JSON.stringify(dataObject),
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                success: function (response) {
                    var $alert = $('#register-employee-alert');
                    $alert.html("New employee has been registered!").removeAttr('style');
                    // Set a timeout to remove the success message after 5 seconds
                    setTimeout(function() {
                        $alert.fadeOut(500);
                    }, 5000);  // 5000 milliseconds (5 seconds)

                    $('#registerEmployeeConfirmationModal').modal('hide');
                },
                error: function (xhr, status, error) {
                    // Restore the form data if an error occurs
                    var $form = $('#register-employee-form');
                    var formFields = dataObject;

                    for (var field in formFields) {
                        if (formFields.hasOwnProperty(field)) {
                            $form.find('[name="' + field + '"]').val(formFields[field]);
                        }
                    }

                    var $alert = $('#register-employee-alert');
                    // Remove existing error messages before displaying new ones
                    $alert.find('.alert-success, .alert-danger').hide();

                    $alert.removeClass('alert-success').addClass('alert-danger').html(xhr.responseJSON.message).removeAttr('style');
                    // Set a timeout to remove the error message after 5 seconds
                    setTimeout(function() {
                        $alert.fadeOut(500);
                        $alert.addClass('alert-success').removeClass('alert-danger');
                    }, 5000); // 5000 milliseconds (5 seconds)

                    $('#registerEmployeeConfirmationModal').modal('hide');
                }
            });
        }
    });
});