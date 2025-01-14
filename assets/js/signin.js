$(document).ready(function () {
     // function to insert data to database

     const liveToast = new bootstrap.Toast(document.querySelector('#liveToast'));
     const kosong = new bootstrap.Toast(document.querySelector('#kosong'));
     const passwrong = new bootstrap.Toast(document.querySelector('#passwrong'));
     const userwong = new bootstrap.Toast(document.querySelector('#userwong'));
     const approve = new bootstrap.Toast(document.querySelector('#approve'));

     function reset() {
        $("#signinSrUsername").val('');
        $("#signinSrPassword").val('');
    }

     $("#logIn").on("submit", function (e) {
        // $("#insertBtn").attr("disabled", "disabled");
        e.preventDefault();
        $.ajax({
            url: "proses/sign-in.proses.php?action=LoginData",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var response = JSON.parse(response);
                if (response.statusCode == 200) {
                    liveToast.show();
                    window.location.href = '/sdbpkad/route4';
                } else if (response.statusCode == 500) {
                    approve.show();
                    reset();
                } else if (response.statusCode == 300) {
                    passwrong.show();
                    reset();
                } else if (response.statusCode == 400) {
                    kosong.show();
                } else if (response.statusCode == 600) {
                    userwong.show();
                    reset();
                }
            }
        });

    });
});