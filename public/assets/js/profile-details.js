// Call the functions on page load
const token = localStorage.getItem('token');
$.ajax({
    type: "GET",
    url: get_profile_details_url,
    headers: {
        "Authorization": `Bearer ${token}`
    },
    dataType: "json",
    success: function (response) {
        var experiences = response.data.experiences;
        var jobs = response.data.jobs;
        const apiData = response.data;
        $('#first_name').text(apiData.first_name);
        $('#last_name').text(apiData.last_name);
        $('#gender').text(apiData.gender);
        $('#date_of_birth').text(apiData.date_of_birth);
        $('#email').text(apiData.email);
        $('#father_name').text(apiData.father_name);
        $('#cnic').text(apiData.cnic);
        $('#mobile_number').text(apiData.phone_no);
        $('#current_address').text(apiData.current_address);
        $('#permanent_address').text(apiData.permanent_address);
        $('#department').text(apiData.department);
        $('#bank_name').text(apiData.bank_name);
        $('#bank_account_number').text(apiData.bank_account_no);
        $('#degree_level').text(apiData.qualification.degree_level.level);
        $('#institution').text(apiData.qualification.institution);
        $('#graduation_year').text(apiData.qualification.graduation_year);
        populateExperiences(experiences);
        populateJobDetails(jobs);
        $('#contract_type').text(apiData.contract.contract_type.type);
        $('#start_date').text(apiData.contract.start_date);
        $('#end_date').text(apiData.contract.end_date);
        $('#spouse_name').text(apiData.family_details.spouse_name);
        $('#children').text(apiData.family_details.children);
    },
    error: function (jqXHR, textStatus, errorThrown) {
        if (jqXHR.status === 401) {
            console.log("Unauthorized");
        } else {
            console.log("Something went wrong");
        }
    }
});

function populateExperiences(experiences) {
    // Iterate over the array of objects
    $.each(experiences, function (index, experience) {
        // Populate the data into the respective <p> tags using their IDs
        $('#company_name').text(experience.company_name);
        $('#latest_position').text(experience.position);
        $('#company_start_date').text(experience.start_date);
        $('#company_end_date').text(experience.end_date);
    });
}

function populateJobDetails(jobs) {
    // Iterate over the array of objects
    $.each(jobs, function (index, job) {
        // Populate the data into the respective <p> tags using their IDs
        $('#pay_scale').text(job.pay_scale.level);
        $('#position').text(job.position);
        $('#job_description').text(job.job_description);
    });
}
