
<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->
<script src="proses/sumberdana/sumberview.js"></script>
<script src="proses/opd/opdview.js"></script>


<script src="assets/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
<script src="assets/bundles/sparkline.bundle.js"></script> <!-- Sparkline Plugin Js -->
<script src="assets/bundles/c3.bundle.js"></script>

<script src="assets/bundles/mainscripts.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/js/pages/index.js"></script>

<script>
    
    $('#btndeleteopd').on('click', function (e) {
    e.preventDefault();
    Swal.fire({
        title: 'Apakah anda yakin ?',
        text: "Menghapus OPD ini ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: 'proses/opd/deleteopd.php',
                data: {
                    idopd : $("#idopd").val(),
                    // kodeopd : $("#kodeopd").val()
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
</script>

</body>


</html>