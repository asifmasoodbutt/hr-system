$(document).ready(function () {

    let initialPageNumber = 1;

    // Get employee leave requests ajax call
    function getEventsApiCall(pageNumber) {
        $.ajax({
            url: get_events_url + '?page=' + pageNumber,
            type: 'GET',
            dataType: 'json',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function (data) {
                try {
                    const tableBody = $('#dataTable tbody');
                    let statusClass = '';

                    tableBody.empty(); // Clear the table body before appending new rows
                    data.data.data.forEach(function (item) {

                        if (item.is_active === 1) {
                            statusClass = 'status-active';
                            eventStatus = 'Active';
                        } else {
                            statusClass = 'status-inactive';
                            eventStatus = 'Inactive';
                        }

                        const row = `<tr>
                                    <td class="font-size-14">${item.title}</td>
                                    <td class="font-size-14">${item.event_type.name}</td>
                                    <td class="font-size-14">${item.from_date}</td>
                                    <td class="font-size-14">${item.to_date}</td>
                                    <td class="font-size-14">${item.manager.first_name + ' ' + item.manager.last_name}</td>
                                    <td class="font-size-14"><span class='${statusClass}'>${eventStatus}</td>
                                </tr>`;
                        tableBody.append(row);
                    });

                    $('#pagination-links').empty();
                    // Append Bootstrap pagination buttons
                    $('#pagination-links').append('<ul class="pagination">');
                    data.data.links.forEach(function (link) {
                        const liClass = link.active ? 'page-item active' : 'page-item';
                        const buttonHtml = `<li class="${liClass}">
                        <a class="page-link" href="${link.url}">${link.label}</a>
                        </li>`;
                        $('#pagination-links ul').append(buttonHtml);
                    });
                    $('#pagination-links').append('</ul>');

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

    // Event delegation for pagination buttons
    $('#pagination-links').on('click', '.page-link', function (event) {
        event.preventDefault();

        // Extract the page number from the href attribute
        const pageUrl = $(this).attr('href');
        const pageNumber = pageUrl.split('page=')[1];

        // Call the API with the new page number
        getEventsApiCall(pageNumber);
    });

    getEventsApiCall(initialPageNumber);
});