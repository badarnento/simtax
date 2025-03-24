function logout() {
    let token = getCookie("token");

    if (!token) {
        window.location.href = "/login";
        return;
    }

    fetch("/api/v1.0/logout", {
        method: "POST",
        headers: {
            Authorization: "Bearer " + token,
            "Content-Type": "application/json",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            // Hapus cookie token
            document.cookie =
                "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

            toastr.success("Successfully logged out", "Success");

            setTimeout(() => {
                window.location.href = "/login";
            }, 1000);
        })
        .catch((error) => {
            console.error("Logout failed:", error);
            toastr.error("Logout failed", "Error");
        });
}

function getCookie(name) {
    let match = document.cookie.match(new RegExp("(^| )" + name + "=([^;]+)"));
    return match ? match[2] : null;
}

function reloadTable(id = "table_data") {
    let table = $(`#${id}`).DataTable();
    
    if ($.fn.DataTable.isDataTable(`#${id}`)) {
        if (table.ajax) {
            table.ajax.reload(null, false);
        } else {
            table.draw(false);
        }
    }
}


function data_table(url, json) {
    let token = getCookie("token");

    Global.checkToken();

    let table = $("#table_data").DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: url,
            type: "GET",
            headers: {
                Authorization: "Bearer " + token,
            },
            // data: function (d) {},
            data: function (d) {
                d.draw = d.draw || 0; // Tambahkan draw untuk request
            },
            dataSrc: function (json) {
                // Pastikan format response sesuai
                return json.data || [];
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
        scrollCollapse: true,
        scrollX: true,
        pageLength: 10,
        ordering: false,
        bAutoWidth: true,
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

    var typingTimer;
    var doneTypingInterval = 500;

    $("#table_data_filter input")
        .unbind()
        .bind("keyup change", function (e) {
            if (this.value !== "") {
                var searchValue = this.value;
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function () {
                    table.search(searchValue).draw();
                }, doneTypingInterval);
            } else {
                table.search("").draw();
            }
        });

    table.columns.adjust().draw();

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

function initPage() {
    const currentPage = window.location.pathname
        .replace(/^\//, "")
        .replace(/\.html$/, "");
    // Cari script berdasarkan halaman
    const pageData = pages.find((p) => p.page === currentPage);

    console.log(pageData);

    if (pageData && pageData.script) {
        const scriptFile = `/js/${pageData.script}`;
        $.getScript(scriptFile)
            .done(function () {
                // console.log(`Script ${scriptFile} berhasil dimuat.`);
            })
            .fail(function () {
                // console.log(`Gagal memuat script ${scriptFile}, tetapi tidak akan menampilkan error.`);
            });
    } else {
        console.log(`Page ${currentPage} does not have script.`);
    }
}
