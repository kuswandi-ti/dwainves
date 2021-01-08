$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#data-user").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/menu-user/data_user",
            type: "POST",
        },
        'fnCreatedRow': function (row, data, index) {
            $('td', row).eq(0).html(index + 1);
        },
        columns: [
            {
                data: "id",
                name: "id",
                visible: "false",
            }, // 0
            {
                data: "vendor_name",
                name: "vendor_name",
                orderable: true,
                searchable: true,
            }, // 1
            {
                data: "username",
                name: "username",
                orderable: true,
                searchable: true,
            }, // 2
            {
                data: "email",
                name: "email",
                orderable: true,
                searchable: true,
            }, // 3
            {
                data: "jabatan",
                name: "jabatan",
                orderable: true,
                searchable: true,
            }, // 4
            {
                data: "created_at",
                name: "created_at",
                render: function (d) {
                    return moment(d).format("DD-MM-YYYY");
                },
            }, // 5
            {
                data: "action",
                name: "action",
                searchable: true,
                visible: true,
            }, // 6
        ],
        order: [["0", "desc"]],
        columnDefs: [
            {
                className: "text-center",
                targets: [0, 1, 2, 3, 4, 5, 6],
            },
        ],
        bAutoWidth: false,
        responsive: true,
        preDrawCallback: function () {
            $("#data-user tbody td").addClass("blurry");
        },
        language: {
            processing:
                '<i style="color:#4a4a4a" class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only"></span><p><span style="color:#4a4a4a" class="loading-text">Loading Data</span> ',
        },
    });
});
$("body").on("click", "#hapus_user", function (e) {
    //alert('delete');
    var table = $("#data-user").DataTable();
    var data = table.row(this).data();
    var id = $(this).data("id");

    swal({
        title: "Anda Yakin Menghapus Data Ini ?",
        text: "Jika di hapus data akan tergapus permanen !",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya Hapus",
        confirmButtonClass: "btn-danger",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise(function (resolve) {
                $('[data-toggle="tooltip"]').tooltip("hide");
                $.ajax({
                    url: "/menu-user/hapus_data_user/" + id,
                    type: "GET",
                    beforeSend: function () {
                    },
                    complete: function () {
                        loading.out();
                    },
                })
                    .done(function (data) {
                        if (data.success == true) {
                            var oTableScanHdr = $(
                                "#data-user"
                            ).dataTable();
                            oTableScanHdr.fnDraw(false);
                            swal({
                                type: "success",
                                title: "Success!",
                                text: "Proses Hapus Berhasil",
                                timer: 4000,
                                showConfirmButton: true,
                            });
                        }
                    })
                    .fail(function (xhr, status, error) {
                        var errorMessage =
                            xhr.status + ": " + xhr.statusText;
                        Swal.fire({
                            type: "error",
                            title: "<strong>Error</strong>",
                            text: errorMessage,
                        });
                    });
            });
        },
        allowOutsideClick: false,
    });
});

$("body").on("click", "#edit_user", function (e) {
    //alert('delete');
    var table = $("#data-user").DataTable();
    var data = table.row(this).data();
    var id = $(this).data("id");
    window.location = "/menu-user/edit_data_user/" + id;
});