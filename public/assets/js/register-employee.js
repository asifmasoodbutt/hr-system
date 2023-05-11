// Call the functions on page load
window.onload = function () {
    getDepartments();
    getDegreeLevels();
    getPayScales();
    getContractTypes();
}

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

const employeeRegisterForm = document.getElementById('register-employee-form');

employeeRegisterForm.addEventListener('submit', function (event) {
    const requiredFields = employeeRegisterForm.querySelectorAll('.input-field[required]');;

    for (let i = 0; i < requiredFields.length; i++) {
        if (!requiredFields[i].value) {
            event.preventDefault();
            alert('Please fill in all required fields.');
            return;
        }
    }
});

const registerEmployeeForm = document.getElementById('register-employee-form');
document.getElementById('register-employee-btn').addEventListener('click', function (event) {
    event.preventDefault(); // prevent default behavior of the link
    // Get all input fields and select tags with class "input-field"
    const inputs = document.querySelectorAll('.input-field');
    const inputData = {};
    inputs.forEach((input) => {
        inputData[input.name] = input.value;
    });
    const url = register_employee_url;
    registerEmployee(inputData); // call your AJAX function
    registerEmployeeForm.reset();
});

function registerEmployee(data) {
    const xhr = new XMLHttpRequest();
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
        company_name: data.company_name,
        latest_position: data.company_start_date,
        company_start_date: data.company_start_date,
        company_end_date: data.company_end_date,
        spouse_name: data.spouse_name,
        no_of_children: parseInt(data.no_of_children)
    };
    xhr.open("POST", url, true);
    const token = localStorage.getItem('token');
    if (token) {
        xhr.setRequestHeader('Authorization', `Bearer ${token}`);
    }
    xhr.setRequestHeader("Accept", "application/json");
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            if (this.status === 200) {
                const response = JSON.parse(this.responseText);
                console.log(response);
            } else {
                console.error("Error:", this.statusText);
            }
        }
    };

    xhr.onerror = function () {
        console.error("Request failed");
    };
    xhr.send(JSON.stringify(dataObject));
}