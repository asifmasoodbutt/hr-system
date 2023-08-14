$(document).ready(function () {
    $.ajax({
        url: get_departments_url,
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
                data.data.forEach(function (item) {
                    const row = `<tr>
                                    <td>${item.id}</td>
                                    <td>${item.name}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm show-sections-button">Show Sections</button>
                                    </td>
                                 </tr>`;
                    tableBody.append(row);
                });

                // Add event listener to buttons
                $('.show-sections-button').on('click', function () {
                    const index = $(this).closest('tr').index();
                    const departmentName = data.data[index].name;
                    const sections = data.data[index].sections;
                    showModal(departmentName, sections);
                });
            } catch (error) {
                console.error(error);
            }
        },
        error: function (xhr, status, error) {
            console.error('Request failed with status ' + xhr.status + ': ' + error);
        }
    });


    // Handle showSectionsButton click event
    function showModal(departmentName, sections) {
        const modalContent = $('<div></div>').addClass('modal-content');
        const modalHeader = $('<div></div>').addClass('modal-header');
        const heading = $('<h5></h5>').addClass('modal-title').text(departmentName + ' Department (Sections)');
        const closeButton = $('<button></button>')
            .addClass('close')
            .attr('type', 'button')
            .attr('data-dismiss', 'modal')
            .html('&times;');
        modalHeader.append(heading, closeButton);

        const modalBody = $('<div></div>').addClass('modal-body');
        const sectionTable = $('<table></table>').addClass('table');
        const tableBody = $('<tbody></tbody>');

        sections.forEach(function (section) {
            const row = $('<tr></tr>');
            const nameCell = $('<td></td>').text(section.name);
            row.append(nameCell);
            tableBody.append(row);
        });

        sectionTable.append(tableBody);
        modalBody.append(sectionTable);

        modalContent.append(modalHeader, modalBody);

        const modalDialog = $('<div></div>').addClass('modal-dialog').append(modalContent);

        const modal = $('<div></div>').addClass('modal fade');
        modal.attr('tabindex', '-1').attr('role', 'dialog');
        modal.append(modalDialog);

        $('body').append(modal);

        modal.modal('show');
    }
});