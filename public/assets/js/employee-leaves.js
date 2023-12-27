$(document).ready(function () {

    // Get employee leave requests ajax call
    function getEmployeeLeaveRequestsApiCall() {
        $.ajax({
            url: get_employee_leave_requests_url,
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
                            approvedBy = 'Cancelled';
                        } else if (item.status.toLowerCase() === 'pending') {
                            isPending = true;
                            statusClass = 'pending';
                            approvedBy = 'Not Approved Yet';
                        } else if (item.status.toLowerCase() === 'approved') {
                            statusClass = 'approved';
                            approvedBy = item.approver.first_name + ' ' + item.approver.last_name;
                        } else if (item.status.toLowerCase() === 'not-approved') {
                            statusClass = 'not-approved';
                            approvedBy = item.approver.first_name + ' ' + item.approver.last_name;
                        }

                        const row = `<tr>
                                    <td class="font-size-14">${index}</td>
                                    <td class="font-size-14">${item.leave_type.leave_type}</td>
                                    <td class="font-size-14"><span class='${statusClass}'>${item.status}</td>
                                    <td class="font-size-14">${approvedBy}</td>
                                    <td class="font-size-14">${new Date(item.from_date).toLocaleDateString('en-US', { day: '2-digit', month: '2-digit', year: 'numeric' })}</td>
                                    <td class="font-size-14">${new Date(item.to_date).toLocaleDateString('en-US', { day: '2-digit', month: '2-digit', year: 'numeric' })}</td>
                                    <td class="font-size-14">${item.description}</td>
                                    <td class="font-size-14">${new Date(item.created_at).toLocaleDateString('en-US', { day: '2-digit', month: '2-digit', year: 'numeric' })}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm cancel-request-btn" data-id="${item.id}" ${!isPending ? 'disabled' : ''}>Cancel Request</button>
                                    </td>
                                </tr>`;
                        tableBody.append(row);
                        index++;
                    });

                    // Add event listener for cancel button
                    $('.cancel-request-btn').on('click', function () {
                        var leaveRequestId = $(this).data('id');
                        // Show the consent modal
                        $('#cancelLeaveRequestModal').modal('show');
                        // Add an event listener for the "Yes" button in the consent modal
                        $('#cancel-yes-modal-btn').off('click').on('click', function () {
                            // Perform the cancel action here using the leaveRequestId variable
                            cancelLeaveRquestApiCall(leaveRequestId);
                            // Close the consent modal
                            $('#cancelLeaveRequestModal').modal('hide');
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

    // Cancel leave request ajax call
    function cancelLeaveRquestApiCall(leaveRequestId) {
        const dataObject = {
            leave_request_id: leaveRequestId,
        };
        $.ajax({
            url: cancel_leave_requests_url,
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
                getEmployeeLeaveRequestsApiCall();
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

    getEmployeeLeaveRequestsApiCall();
});