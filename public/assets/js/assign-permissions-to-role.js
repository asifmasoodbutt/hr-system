$(document).ready(function () {
    // Fetching URL and getting text after last slash
    const currentURL = window.location.href;
    const textAfterLastSlash = currentURL.split('/').pop();

    // Preparing data for ajax
    const dataObject = {
        role_id: textAfterLastSlash
    };

    $.ajax({
        url: get_assigned_unassigned_permissions_url,
        method: 'POST',
        data: JSON.stringify(dataObject),
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        success: function (data) {
            try {
                const assignedPermissionsTableBody = $('#assignedPermissionsDataTable tbody');
                const unassignedPermissionsTableBody = $('#unassignedPermissionsDataTable tbody');
                data.data.assigned_permissions.forEach(function (item) {
                    const row = `<tr>
                                    <td>${item.name}</td>
                                 </tr>`;
                    assignedPermissionsTableBody.append(row);
                });
                data.data.unassigned_permissions.forEach(function (item) {
                    const row = `<tr>
                                    <td>${item.name}</td>
                                 </tr>`;
                    unassignedPermissionsTableBody.append(row);
                });
            } catch (error) {
                console.error(error);
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
});