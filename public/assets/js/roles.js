$(document).ready(function () {

    // Perform validations
    $('.input-field').on('keyup', function () {
        // Handle the change event here
        var roleName = $(this).val().trim();
        if (roleName.length === 0) {
            $(this).addClass('is-invalid');
            $('#roleNameErrorDiv').text("Role Name is required.").show().css('color', 'red');;
        } else {
            $(this).removeClass('is-invalid');
            $('#roleNameErrorDiv').hide();
        }
    });

    // Add event listener for create role button
    $('#modal-create-btn').on('click', function () {
        var roleName = $('.input-field').val().trim();
        var lowerCasedRoleName = roleName.toLowerCase();
        createRoleApiCall(lowerCasedRoleName);
    });

    // Create role ajax call
    function createRoleApiCall(lowerCasedRoleName) {
        const dataObject = {
            name: lowerCasedRoleName,
        };
        $.ajax({
            url: create_role_url,
            method: 'POST',
            data: JSON.stringify(dataObject),
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function (response) {
                // Close the modal on error
                $('#createRoleModal').modal('hide');
                // Generate success notification
                generateMessage('success', 'Success', response.message);
                // Get roles API call
                getRolesApiCall();
            },
            error: function (xhr, status, error) {
                // Close the modal on error
                $('#createRoleModal').modal('hide');
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

    // Get roles ajax call
    function getRolesApiCall() {
        $.ajax({
            url: get_roles_url,
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
                    tableBody.empty(); // Clear the table body before appending new rows
                    data.data.forEach(function (item) {
                        const row = `<tr>
                                    <td>${item.id}</td>
                                    <td>${item.name}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm edit-role-button" data-role-name="${item.name}" data-id="${item.id}">Edit</button>
                                        <button class="btn btn-danger btn-sm delete-role-button" data-id="${item.id}">Delete</button>
                                        <button class="btn btn-success btn-sm show-permissions-button" data-id="${item.id}">Show Permissions</button>
                                    </td>
                                 </tr>`;
                        tableBody.append(row);
                    });

                    // Add event listener for edit button
                    $('.edit-role-button').on('click', function () {
                        var roleId = $(this).data('id');
                        var roleName = $(this).data('role-name');
                        // Populate modal input field
                        $('#role_name').val(roleName);
                        // Show modal
                        $('#editRoleModal').modal('show');
                        // Unbind any previous event listener
                        $('#modal-edit-btn').off('click');
                        // Event listener for modal edit button click
                        $('#modal-edit-btn').on('click', function () {
                            var updatedRoleName = $('#role_name').val();
                            editRoleApiCall(roleId, updatedRoleName);
                        });
                    });

                    // Add event listener for delete button
                    $('.delete-role-button').on('click', function () {
                        var roleId = $(this).data('id');
                        // Show the consent modal
                        $('#deleteRoleModal').modal('show');
                        // Add an event listener for the "Delete" button in the consent modal
                        $('#modal-delete-btn').off('click').on('click', function () {
                            // Perform the delete action here using the roleId variable
                            deleteRoleApiCall(roleId);
                            // Close the consent modal
                            $('#deleteRoleModal').modal('hide');
                        });
                    });

                    // Add event listener for show permissions button
                    $('.show-permissions-button').on('click', function () {
                        var roleId = $(this).data('id');
                        // Set the role id as a data attribute on the "Assign More Permissions" button
                        $('#assign-permission-btn').attr('data-role-id', roleId);
                        // Show the consent modal
                        $('#showPermissionsModal').modal('show');
                        getRoleWithPermissionsApiCall(roleId);
                    });

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

    // Delete role ajax call
    function deleteRoleApiCall(roleId) {
        const dataObject = {
            role_id: roleId,
        };
        $.ajax({
            url: delete_role_url,
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
                // Get roles API call
                getRolesApiCall();
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

    // Edit role ajax call
    function editRoleApiCall(roleId, newRoleName) {
        const dataObject = {
            role_id: roleId,
            updated_role_name: newRoleName
        };
        $.ajax({
            url: edit_role_url,
            method: 'POST',
            data: JSON.stringify(dataObject),
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function (response) {
                // Close modal
                $('#editRoleModal').modal('hide');
                // Generate success notification
                generateMessage('success', 'Success', response.message);
                // Get roles API call
                getRolesApiCall();
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

    // Get role's permissions ajax call
    function getRoleWithPermissionsApiCall(roleId) {
        const dataObject = {
            role_id: roleId
        };
        $.ajax({
            url: get_role_with_permissions_url,
            method: 'POST',
            data: JSON.stringify(dataObject),
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function (response) {
                try {
                    const tableBody = $('#permissions-table tbody');
                    tableBody.empty(); // Clear the table body before appending new rows
                    response.data.permissions.forEach(function (item) {
                        const row = `<tr>
                                        <td>${item.id}</td>
                                        <td>${item.name}</td>
                                     </tr>`;
                        tableBody.append(row);
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

    getRolesApiCall();

    // Capture click event on the "Assign More Permissions" button in the modal
    $('#assign-permission-btn').click(function () {
        let roleId = $(this).data('role-id'); // Get the role name from the data attribute
        let url = assign_permission_to_role_web_url.replace(':id', btoa(roleId));
        window.location = url; // Redirect to page
    });
});