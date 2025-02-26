function data_table(url, json) {
    let table = $("#table_data").DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: url,
            type: "GET",
            data: function (d) {
                // Bisa tambahkan filter atau sorting jika perlu
            },
        },
        language: {
            emptyTable:
                "<span class ='label label-danger'>Data not found!</span>",
            infoEmpty: "Data Empty",
            processing:
                '<div class="loader vertical-align-middle loader-circle"></div>',
            search: "_INPUT_",
        },
        columns: json,
        scrollY: 500,
        scrollX: 1500,
        scrollCollapse: true,
        scrollX: true,
        pageLength: 10,
        ordering: false,
        bAutoWidth: false,
        autoWidth: true,
    });

    // Fungsi debounce untuk pencarian
    /*     $('#table_data_filter input').on('input', function () {
        let searchValue = this.value;
      
        if (!searchValue || searchValue.length < 3) {
            table.search('').draw();
            console.log(searchValue.length)
            console.log('goblog')
        }
    }); */

    var typingTimer; // Timer identifier
    var doneTypingInterval = 500; // Jeda 1 detik setelah ketik

    $("#table_data_filter input")
        .unbind()
        .bind("keyup change", function (e) {
            if (this.value !== "") {
                var searchValue = this.value;
                // table.search(this.value).draw();
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function () {
                    // Lakukan pencarian setelah 1 detik dan nilai sudah lebih dari 3 karakter
                    table.search(searchValue).draw();
                }, doneTypingInterval);
            } else {
                table.search("").draw();
            }
        });

        table.columns.adjust().draw();

        /* setTimeout(function () {
            table.columns.adjust().draw();
            
        }, 1000); */

    // Konfigurasi lainnya
    $("#table_data_wrapper .row div")
        .first()
        .removeClass("col-md-6")
        .addClass("col-md-3");
    $("#table_data_wrapper .row div.col-md-6")
        .first()
        .removeClass("col-md-6")
        .addClass("col-md-9");
    $("#table_data_filter").addClass("text-md-right");
    $("#table_data_info").removeAttr("aria-live");
    $('input[type="search"]')
        .attr("placeholder", "Search here...")
        .addClass("form-control input-sm ml-0");
}
