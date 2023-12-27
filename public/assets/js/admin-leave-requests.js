$(document).ready(function () {

    // Get employee leave requests ajax call
    function getEmployeesLeaveRequestsApiCall() {
        $.ajax({
            url: get_employees_leave_requests_url,
            type: 'GET',
            dataType: 'json',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function (data) {
                try {
                    const tableBody = $('#data-table tbody');
                    let index = 1;
                    let statusClass = '';

                    tableBody.empty(); // Clear the table body before appending new rows

                    data.data.forEach(function (item) {
                        isPending = false;

                        if (item.status.toLowerCase() === 'cancelled') {
                            statusClass = 'cancelled';
                        } else if (item.status.toLowerCase() === 'pending') {
                            isPending = true;
                            statusClass = 'pending';
                        } else if (item.status.toLowerCase() === 'approved') {
                            statusClass = 'approved';
                        } else if (item.status.toLowerCase() === 'not-approved') {
                            statusClass = 'not-approved';
                        }

                        const row = `<tr>
                                    <td class="font-size-14">${index}</td>
                                    <td class="font-size-14">${item.employee.first_name + ' ' + item.employee.last_name}</td>
                                    <td class="font-size-14">${item.leave_type.leave_type}</td>
                                    <td class="font-size-14"><span style="width:30px" class='${statusClass}'>${item.status}</td>
                                    <td class="font-size-14">${new Date(item.from_date).toLocaleDateString('en-US', { day: '2-digit', month: '2-digit', year: 'numeric' })}</td>
                                    <td class="font-size-14">${new Date(item.to_date).toLocaleDateString('en-US', { day: '2-digit', month: '2-digit', year: 'numeric' })}</td>
                                    <td class="font-size-14">${item.description}</td>
                                    <td class="font-size-14">${new Date(item.created_at).toLocaleDateString('en-US', { day: '2-digit', month: '2-digit', year: 'numeric' })}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm approve-request-btn" data-id="${item.id}" ${!isPending ? 'disabled' : ''}>Approve</button>
                                        <br>
                                        <button class="btn btn-danger btn-sm disapprove-request-btn" data-id="${item.id}" ${!isPending ? 'disabled' : ''}>Disapprove</button>
                                    </td>
                                </tr>`;
                        tableBody.append(row);
                        index++;
                    });

                    // Add event listener for approve button
                    $('.approve-request-btn').on('click', function () {
                        var leaveRequestId = $(this).data('id');
                        var status = 'approved';
                        // Show the consent modal
                        $('#approveLeaveRequestModal').modal('show');
                        // Add an event listener for the "Yes" button in the consent modal
                        $('#approve-yes-modal-btn').off('click').on('click', function () {
                            // Perform the approve action here using the leaveRequestId variable
                            approveDisapproveLeaveRquestApiCall(leaveRequestId, status);
                            // Close the consent modal
                            $('#approveLeaveRequestModal').modal('hide');
                        });
                    });

                    // Add event listener for disapprove button
                    $('.disapprove-request-btn').on('click', function () {
                        var leaveRequestId = $(this).data('id');
                        var status = 'not-approved';
                        // Show the consent modal
                        $('#disapproveLeaveRequestModal').modal('show');
                        // Add an event listener for the "Yes" button in the consent modal
                        $('#disapprove-yes-modal-btn').off('click').on('click', function () {
                            // Perform the disapprove action here using the leaveRequestId variable
                            approveDisapproveLeaveRquestApiCall(leaveRequestId, status);
                            // Close the consent modal
                            $('#disapproveLeaveRequestModal').modal('hide');
                        });
                    });

                    // Generate success notification
                    generateMessage('success', 'Success', data.message);

                } catch (error) {
                    generateMessage('danger', 'Error', 'Something went wrong!');
                }
            },
            error: function (xhr, status, error) {
                // Display the error message to the user
                var responseJSON = xhr.responseJSON;
                if (responseJSON && responseJSON.errors && responseJSON.message) {
                    generateMessage('danger', 'Error', responseJSON.message);
                } else {
                    generateMessage('danger', 'Error', 'Something went wrong!');
                }
            }
        });
    }

    // approve disapprove leave request ajax call
    function approveDisapproveLeaveRquestApiCall(leaveRequestId, status) {
        const dataObject = {
            leave_request_id: leaveRequestId,
            status: status
        };
        $.ajax({
            url: approve_disapprove_leave_request_url,
            method: 'POST',
            data: JSON.stringify(dataObject),
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function (response) {
                // Generate success notification
                generateMessage('success', 'Success', response.message);
                // Get employee leave requests API call
                getEmployeesLeaveRequestsApiCall();
            },
            error: function (xhr, status, error) {
                // Display the error message to the user
                var responseJSON = xhr.responseJSON;
                if (responseJSON && responseJSON.errors && responseJSON.message) {
                    generateMessage('danger', 'Error', responseJSON.message);
                } else {
                    generateMessage('danger', 'Error', 'Something went wrong!');
                }
            }
        });
    }

    getEmployeesLeaveRequestsApiCall();
});