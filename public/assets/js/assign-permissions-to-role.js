$(document).ready(function () {
    // Fetching URL and getting text after last slash
    const currentURL = window.location.href;
    const encodedRoleId = currentURL.split('/').pop();
    const decodedRoleId = atob(encodedRoleId);

    function getAssignedUnassignedPermissions(encodedRoleId) {

        // Preparing data for ajax
        const dataObject = {
            role_id: encodedRoleId
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
                                        <td>
                                            <span class="permission-name">
                                            ${item.name}
                                            </span>
                                            <button class="btn btn-sm btn-danger float-right remove-permission-btn" data-role-id=${decodedRoleId} data-permission-id=${item.id}>
                                            Remove
                                            </button>
                                        </td>
                                     </tr>`;
                        assignedPermissionsTableBody.append(row);
                    });

                    // Add event listener for remove permission button
                    $('.remove-permission-btn').on('click', function () {
                        let roleId = $(this).data('role-id');
                        let permissionId = $(this).data('permission-id');
                        let row = $(this).closest('tr');

                        unassignPermissionApiCall(roleId, permissionId, row);
                        $(this).off('click');
                    });

                    data.data.unassigned_permissions.forEach(function (item) {
                        const row = `<tr>
                                        <td>
                                            <span class="permission-name">
                                            ${item.name}
                                            </span>
                                            <button class="btn btn-sm btn-success float-right assign-permission-btn" data-role-id=${decodedRoleId} data-permission-id=${item.id}>
                                            Assign
                                            </button>
                                        </td>
                                     </tr>`;
                        unassignedPermissionsTableBody.append(row);
                    });

                    // Add event listener for remove permission button
                    $('.assign-permission-btn').on('click', function () {
                        let roleId = $(this).data('role-id');
                        let permissionId = $(this).data('permission-id');
                        let row = $(this).closest('tr');

                        assignPermissionApiCall(roleId, permissionId, row);
                        $(this).off('click');
                    });
                } catch (error) {
                    generateMessage('danger', 'Error', error);
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

    // API Call to get assigned and unasssigned permissions
    getAssignedUnassignedPermissions(encodedRoleId);

    // Unassign permission ajax call
    function unassignPermissionApiCall(roleId, permissionId, row) {
        let permissionText = row.find('.permission-name').text();

        const dataObject = {
            role_id: roleId,
            permission_id: permissionId
        };
        $.ajax({
            url: unassign_permission_from_role_url,
            method: 'POST',
            data: JSON.stringify(dataObject),
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function (response) {
                try {
                    // Remove the row from the assigned permissions table
                    row.remove();

                    let unassignedPermissionsTableBody = $('#unassignedPermissionsDataTable tbody');
                    let newRow = `<tr>
                                    <td>
                                        <span class="permission-name">
                                        ${permissionText}
                                        </span>
                                        <button class="btn btn-sm btn-success float-right assign-permission-btn" data-role-id=${roleId} data-permission-id=${permissionId}>
                                        Assign
                                        </button>
                                    </td>
                                </tr>`;
                    unassignedPermissionsTableBody.prepend(newRow);

                    // Generate success notification
                    generateMessage('success', 'Success', response.message);

                    // Add event listener for remove permission button
                    $('.assign-permission-btn').on('click', function () {
                        let roleId = $(this).data('role-id');
                        let permissionId = $(this).data('permission-id');

                        assignPermissionApiCall(roleId, permissionId);
                        $(this).off('click');
                    });
                } catch (error) {
                    generateMessage('danger', 'Error', error);
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

    // Assign permission ajax call
    function assignPermissionApiCall(roleId, permissionId, row) {
        let permissionText = row.find('.permission-name').text();

        const dataObject = {
            role_id: roleId,
            permission_id: permissionId
        };
        $.ajax({
            url: assign_permission_to_role_url,
            method: 'POST',
            data: JSON.stringify(dataObject),
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function (response) {
                try {
                    // Remove the row from the assigned permissions table
                    row.remove();

                    let assignedPermissionsTableBody = $('#assignedPermissionsDataTable tbody');
                    let newRow = `<tr>
                                    <td>
                                        <span class="permission-name">
                                        ${permissionText}
                                        </span>
                                        <button class="btn btn-sm btn-danger float-right remove-permission-btn" data-role-id=${roleId} data-permission-id=${permissionId}>
                                        Remove
                                        </button>
                                    </td>
                                </tr>`;
                    assignedPermissionsTableBody.prepend(newRow);

                    // Generate success notification
                    generateMessage('success', 'Success', response.message);

                    // Add event listener for remove permission button
                    $('.remove-permission-btn').on('click', function () {
                        let roleId = $(this).data('role-id');
                        let permissionId = $(this).data('permission-id');
                        let row = $(this).closest('tr');

                        unassignPermissionApiCall(roleId, permissionId, row);
                        $(this).off('click');
                    });
                } catch (error) {
                    generateMessage('danger', 'Error', error);
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
});