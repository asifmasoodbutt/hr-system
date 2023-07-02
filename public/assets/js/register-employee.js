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
          <input type="text" class="form-control" name="company_name_${experienceCounter}" maxlength="50" required placeholder="Enter employee's company name" />
          <div class="validation-error"></div>
        </div>
      </div>
      <div class="col themed-grid-col">
        <div class="form-group text-left">
          <label class="font-weight-bolder">Latest Position <span class="required"></span></label>
          <input type="text" class="form-control" name="latest_position_${experienceCounter}" maxlength="50" required placeholder="Enter employee's latest position" />
          <div class="validation-error"></div>
        </div>
      </div>
      <div class="col themed-grid-col">
        <div class="form-group text-left">
          <label class="font-weight-bolder">Start Date <span class="required"></span></label>
          <input type="date" class="form-control" name="company_start_date_${experienceCounter}" required placeholder="Enter employee's joining date" />
          <div class="validation-error"></div>
        </div>
      </div>
      <div class="col themed-grid-col">
        <div class="form-group text-left">
          <label class="font-weight-bolder">End Date <span class="required"></span></label>
          <input type="date" class="form-control" name="company_end_date_${experienceCounter}" required placeholder="Enter employee's ending date" />
          <div class="validation-error"></div>
        </div>
      </div>
    `);
        // Append the new fields to the container
        container.append(div);

        // Increment the experience counter
        experienceCounter++;
    }

    const registerEmployeeForm = $('#register-employee-form');
    $('#register-employee-btn').click(function (event) {
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
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    });
});