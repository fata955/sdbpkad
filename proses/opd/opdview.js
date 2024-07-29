$(document).ready(function () {

    // list opd

$("#listopd").load("views/table/opd.php");
var refreshId = setInterval(function () {
    $("#listopd").load('views/table/opd.php');
}, 7000);
$.ajaxSetup({ cache: true });

$('#btnsaveopd').on('click', function (e) {
    e.preventDefault();
    Swal.fire({
        title: 'Apakah anda yakin ?',
        text: "Menyimpan OPD Baru ini ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: 'proses/opd/saveopd.php',
                data: {
                    nama : $("#namaopd").val(),
                    kodeopd : $("#kodeopd").val()
                },
                success: function () {
                    Swal.fire(
                        '!',
                        'No antrian sukses dipilih',
                        'success'
                        // console.log(nama);
                    )
                }
            });

        }
    })
});


});

// end list opd