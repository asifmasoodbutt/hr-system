$(document).ready(function () {
    $.ajax({
        url: get_dashboard_data_url,
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
        },
        dataType: 'json',
        success: function (data) {
            // Process the fetched data and update the data
            $('#monthly-salaries-sum').text(data.data.salaries_sum + ' PKR');
            updatePieChart(data.data.piechart_data);
            updateBarChart(data.data.barchart_data);
        },
        error: function (error) {
            console.error('Error fetching data:', error);
        }
    });
});

function updatePieChart(data) {
    let ctx = document.getElementById('pieChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            // labels: data.labels,
            datasets: [{
                label: 'Count',
                data: data,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(133, 135, 150, 0.6)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(133, 135, 150, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        }
    });
}

function updateBarChart(data) {
    let ctx = document.getElementById('barChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Number of Employees',
                data: data.data,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Salary Range'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Number of Employees'
                    },
                    beginAtZero: true
                }
            }
        }
    });
}