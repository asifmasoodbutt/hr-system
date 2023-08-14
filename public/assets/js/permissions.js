$(document).ready(function () {

    // Perform validations
    $('.input-field').on('keyup', function () {
        // Handle the change event here
        var permissionName = $(this).val().trim();
        if (permissionName.length === 0) {
            $(this).addClass('is-invalid');
            $('#permissionNameErrorDiv').text("Permission Name is required.").show().css('color', 'red');;
        } else {
            $(this).removeClass('is-invalid');
            $('#permissionNameErrorDiv').hide();
        }
    });

    // Add event listener for create permission button
    $('#modal-create-btn').on('click', function () {
        var permissionName = $('.input-field').val().trim();
        createPermissionApiCall(permissionName);
    });

    // Create permission ajax call
    function createPermissionApiCall(permissionName) {
        const dataObject = {
            name: permissionName,
        };
        $.ajax({
            url: create_permission_url,
            method: 'POST',
            data: JSON.stringify(dataObject),
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function (response) {
                // Close the modal on error
                $('#createPermissionModal').modal('hide');
                // Generate success notification
                generateMessage('success', 'Success', response.message);
                // Get roles API call
                getPermissionsApiCall();
            },
            error: function (xhr, status, error) {
                // Close the modal on error
                $('#createPermissionModal').modal('hide');
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
    function getPermissionsApiCall() {
        $.ajax({
            url: get_permissions_url,
            type: 'GET',
            dataType: 'json',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function (data) {
                try {
                    const tableBody = $('#permissions-table tbody');
                    tableBody.empty(); // Clear the table body before appending new rows
                    data.data.forEach(function (item) {
                        const row = `<tr>
                                    <td>${item.id}</td>
                                    <td>${item.name}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm edit-permission-button" data-permission-name="${item.name}" data-id="${item.id}">Edit</button>
                                        <button class="btn btn-danger btn-sm delete-permission-button" data-id="${item.id}">Delete</button>
                                        <button class="btn btn-success btn-sm show-roles-button" data-id="${item.id}">Show Roles</button>
                                    </td>
                                 </tr>`;
                        tableBody.append(row);
                    });

                    // Add event listener for edit button
                    $('.edit-permission-button').on('click', function () {
                        var permissionId = $(this).data('id');
                        var permissionName = $(this).data('permission-name');
                        // Populate modal input field
                        $('#permission_name').val(permissionName);
                        // Show modal
                        $('#editPermissionModal').modal('show');
                        // Unbind any previous event listener
                        $('#modal-edit-btn').off('click');
                        // Event listener for modal edit button click
                        $('#modal-edit-btn').on('click', function () {
                            var updatedPermissionName = $('#permission_name').val();
                            editPermissionApiCall(permissionId, updatedPermissionName);
                        });
                    });

                    // Add event listener for delete button
                    $('.delete-permission-button').on('click', function () {
                        const permissionId = $(this).data('id');
                        // Show the consent modal
                        $('#deletePermissionModal').modal('show');
                        // Add an event listener for the "Delete" button in the consent modal
                        $('#modal-delete-btn').off('click').on('click', function () {
                            // Perform the delete action here using the roleId variable
                            deletePermissionApiCall(permissionId);
                            // Close the consent modal
                            $('#deletePermissionModal').modal('hide');
                        });
                    });

                    // Add event listener for show permissions button
                    $('.show-roles-button').on('click', function () {
                        const permissionId = $(this).data('id');
                        // Show the consent modal
                        $('#showRolesModal').modal('show');
                        getPermissionWithRolesApiCall(permissionId);
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

    // Delete permission ajax call
    function deletePermissionApiCall(permissionId) {
        const dataObject = {
            permission_id: permissionId,
        };
        $.ajax({
            url: delete_permission_url,
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
                getPermissionsApiCall();
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

    // Edit permission ajax call
    function editPermissionApiCall(permissionId, newPermissionName) {
        const dataObject = {
            permission_id: permissionId,
            updated_permission_name: newPermissionName
        };
        $.ajax({
            url: edit_permission_url,
            method: 'POST',
            data: JSON.stringify(dataObject),
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function (response) {
                // Close modal
                $('#editPermissionModal').modal('hide');
                // Generate success notification
                generateMessage('success', 'Success', response.message);
                // Get roles API call
                getPermissionsApiCall();
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

    // Get permission's roles ajax call
    function getPermissionWithRolesApiCall(permissionId) {
        const dataObject = {
            permission_id: permissionId
        };
        $.ajax({
            url: get_permission_with_roles_url,
            method: 'POST',
            data: JSON.stringify(dataObject),
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function (response) {
                try {
                    const tableBody = $('#roles-table tbody');
                    tableBody.empty(); // Clear the table body before appending new rows
                    response.data.roles.forEach(function (item) {
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

    getPermissionsApiCall();
});