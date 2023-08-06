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

    // Create role ajax call
    $('#modal-create-btn').on('click', function () {

        var roleName = $('.input-field').val().trim();
        var lowerCasedRoleName = roleName.toLowerCase();
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
    });

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
                                        <button class="btn btn-primary btn-sm edit-role-button" data-id="${item.id}">Edit</button>
                                        <button class="btn btn-danger btn-sm delete-role-button" data-id="${item.id}">Delete</button>
                                    </td>
                                 </tr>`;
                        tableBody.append(row);
                    });

                    // Add event listener for delete button
                    $('.delete-role-button').on('click', function () {
                        const roleId = $(this).data('id');
                        // Show the consent modal
                        $('#deleteRoleModal').modal('show');
                        // Add an event listener for the "Delete" button in the consent modal
                        $('#modal-delete-btn').on('click', function () {
                            // Perform the delete action here using the roleId variable
                            deleteRoleApiCall(roleId);
                            // Close the consent modal
                            $('#deleteRoleModal').modal('hide');
                        });
                    });

                    // Add event listener for edit button
                    $('.edit-role-button').on('click', function () {
                        const roleId = $(this).data('id');
                        console.log(roleId);
                        // Show the consent modal
                        $('#deleteRoleModal').modal('show');
                        // Add an event listener for the "Delete" button in the consent modal
                        $('#modal-delete-btn').on('click', function () {
                            // Perform the delete action here using the roleId variable
                            deleteRoleApiCall(roleId);
                            // Close the consent modal
                            $('#deleteRoleModal').modal('hide');
                        });
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

    getRolesApiCall();
});