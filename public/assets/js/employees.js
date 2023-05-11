// Call the functions on page load
const token = localStorage.getItem('token');
$.ajax({
    type: "GET",
    url: get_demployees_url,
    headers: {
        "Authorization": `Bearer ${token}`
    },
    dataType: "json",
    success: function (response) {
        console.log(response);
    },
    error: function (jqXHR, textStatus, errorThrown) {
        if (jqXHR.status === 401) {
            console.log("Unauthorized");
        } else {
            console.log("Something went wrong");
        }
    }
});
