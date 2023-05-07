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
    xhttp.send();
}
