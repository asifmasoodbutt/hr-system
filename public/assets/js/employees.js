// Call the functions on page load
const token = localStorage.getItem('token');
$.ajax({
    type: "GET",
    url: get_employees_url,
    headers: {
        "Authorization": `Bearer ${token}`
    },
    dataType: "json",
    success: function (response) {
        let tableBody = $('#dataTable tbody');
        tableBody.empty();
        $.each(response.data, function (index, employee) {
            const employeeId = btoa(employee.id);

            let tableRow = $('<tr/>');
            tableRow.append($('<td/>').append($('<a/>').attr('href', employee_details_url + '/' + employeeId).text(employee.full_name)));
            tableRow.append($('<td/>').text(employee.email));
            tableRow.append($('<td/>').text(employee.department));
            tableRow.append($('<td/>').text(employee.position));
            tableRow.append($('<td/>').text(employee.contract));
            tableRow.append($('<td/>').text(employee.salary + ' PKR'));
            tableBody.append(tableRow);
        });
    },
    error: function (jqXHR, textStatus, errorThrown) {
        if (jqXHR.status === 401) {
            console.log("Unauthorized");
        } else {
            console.log("Something went wrong");
        }
    }
});
