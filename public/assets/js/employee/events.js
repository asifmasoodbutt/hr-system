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

                        let from_time = '';
                        let to_time = '';

                        let fromDate = new Date(item.from_date);
                        let formYear = fromDate.getFullYear();
                        let fromMonth = String(fromDate.getMonth() + 1).padStart(2, '0'); // Months are zero-indexed
                        let fromDay = String(fromDate.getDate()).padStart(2, '0');
                        let from_date = `${formYear}-${fromMonth}-${fromDay}`;

                        let toDate = new Date(item.to_date);
                        let toYear = toDate.getFullYear();
                        let toMonth = String(toDate.getMonth() + 1).padStart(2, '0'); // Months are zero-indexed
                        let toDay = String(toDate.getDate()).padStart(2, '0');
                        let to_date = `${toYear}-${toMonth}-${toDay}`;

                        if (from_date === to_date) {

                            let fromTime = new Date(item.from_date);
                            let fromOptions = { hour: '2-digit', minute: '2-digit', hour12: true };
                            from_time = fromTime.toLocaleTimeString('en-US', fromOptions);
                            from_time = from_time + ` (${from_date})`;

                            let toTime = new Date(item.to_date);
                            let toOptions = { hour: '2-digit', minute: '2-digit', hour12: true };
                            to_time = toTime.toLocaleTimeString('en-US', toOptions);
                            to_time = to_time + ` (${to_date})`;

                        } else {
                            from_time = from_date;
                            to_time = to_date;
                        }

                        const row = `<tr>
                                    <td class="font-size-14">${item.title}</td>
                                    <td class="font-size-14">${item.event_type.name}</td>
                                    <td class="font-size-14">${from_time}</td>
                                    <td class="font-size-14">${to_time}</td>
                                    <td class="font-size-14">${item.manager.first_name + ' ' + item.manager.last_name}</td>
                                    <td>
                                    <button class="btn btn-success btn-sm participate-btn" data-id="${item.id}">Participate</button>
                                    </td>
                                </tr>`;
                        tableBody.append(row);
                    });

                    // Add event listener for participate event button
                    $('.participate-btn').on('click', function () {
                        var eventId = $(this).data('id');
                        // Show the consent modal
                        $('#participateEventModal').modal('show');
                        // Add an event listener for the "Yes" button in the consent modal
                        $('#participate-yes-modal-btn').off('click').on('click', function () {
                            // Perform the cancel action here using the eventId variable
                            participateEventApiCall(eventId);
                            // Close the consent modal
                            $('#participateEventModal').modal('hide');
                        });
                    });

                    // Append Bootstrap pagination buttons
                    $('#pagination-links').empty();
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
        localStorage.setItem('currentPageNumber', pageNumber);

        // Call the API with the new page number
        getEventsApiCall(pageNumber);
    });

    // Inactive event ajax call
    function participateEventApiCall(eventId) {
        currentPageNumber = localStorage.getItem('currentPageNumber') || 1;
        const dataObject = {
            event_id: eventId,
        };
        $.ajax({
            url: participate_event_url,
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

                // Get events API call
                setTimeout(() => {
                    getEventsApiCall(currentPageNumber)
                }, 4000);
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

    getEventsApiCall(initialPageNumber);
});