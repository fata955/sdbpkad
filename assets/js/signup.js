$(document).ready(function () {
    // Mendapatkan tanggal sekarang 

    const liveToast = new bootstrap.Toast(document.querySelector('#liveToast'));
    const pass = new bootstrap.Toast(document.querySelector('#pass'));
    const kosong = new bootstrap.Toast(document.querySelector('#kosong'));
    const error = new bootstrap.Toast(document.querySelector('#error'));
    const sama = new bootstrap.Toast(document.querySelector('#sama'));
    var today = new Date();
    var day = today.getDate().toString().padStart(2, '0'); // Menambahkan nol di depan jika perlu 
    var month = (today.getMonth() + 1).toString().padStart(2, '0'); // Januari adalah 0 
    var year = today.getFullYear(); // Format tanggal 
    var formattedDate = year + '-' + month + '-' + day; // Mengisi input dengan tanggal sekarang 
    $('#currentDate').val(formattedDate);
    // reset();
    function reset() {
        $("#fullName").val('');
        $("#signupSrUsername").val('');
        $("#signupSrPassword").val('');
        $("#signupSrConfirmPassword").val('');
    }

    // function to insert data to database
    $("#reg").on("submit", function (e) {
        // $("#insertBtn").attr("disabled", "disabled");
        e.preventDefault();
        $.ajax({
            url: "proses/sign-up.proses.php?action=insertData",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var response = JSON.parse(response);
                if (response.statusCode == 200) {
                    liveToast.show();
                    reset();
                } else if (response.statusCode == 500) {
                    error.show();
                    reset();
                } else if (response.statusCode == 300) {
                    pass.show();
                    reset();
                } else if (response.statusCode == 400) {
                    kosong.show();
                } else if (response.statusCode == 600) {
                    sama.show();
                    reset();
                }
            }
        });

    });

})