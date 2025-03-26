window.tarifPPh = [];

let pphBulananURL = 'tax/pph21/bulanan';

$(document).on(
    "change",
    "#gaji_pokok, #tunjangan, #uang_makan, #uang_lembur, #penghasilan_lain, #naturan_pph21, #premi_bpjs_kesehatan_percent, #metode_penggajian, [id^=premi_bpjs_tk_][id$=_percent]",
    updatePenghasilan
);
$(document).on(
    "change",
    "#tunjangan_hari_raya, #bonus, #tantiem",
    setJumlahPenghasilanTidakTeratur
);

$(document).on(
    "change",
    "#iuran_zakat, #iuran_bpjs_kesehatan_percent, [id^=iuran_bpjs_tk_][id$=_percent]",
    updatePotonganPenghasilan
);

function updatePenghasilan() {
    setPremiBpjsTk();
    setJumlahPenghasilanTeratur();
    setJumlahPenghasilanBruto();
    setJumlahPph21Terutang();
}

function updatePotonganPenghasilan() {
    setIuranBpjsTk();
    setPPh21Terutang();
}

function setPPh21Terutang() {
    let total = sumValues([
        "#iuran_zakat",
        "#iuran_pensiun_bpjs_tk_jp",
        "#iuran_pensiun_bpjs_tk_jht",
    ]);

    $("#jumlah_pengurang").val(formatNumber(total));
}

function setJumlahPenghasilanBruto() {
    let bruto = sumValues([
        "#jumlah_penghasilan_teratur",
        "#jumlah_penghasilan_tidak_teratur",
    ]);
    $("#jumlah_penghasilan_bruto").val(formatNumber(bruto));
    
}

function setJumlahPenghasilanTidakTeratur() {
    let total = sumValues(["#tunjangan_hari_raya", "#bonus", "#tantiem"]);
    $("#jumlah_penghasilan_tidak_teratur").val(formatNumber(total));
}

function setJumlahPenghasilanTeratur() {
    let total = sumValues([
        "#gaji_pokok",
        "#tunjangan",
        "#uang_makan",
        "#uang_lembur",
        "#penghasilan_lain",
        "#premi_bpjs_jkk",
        "#premi_bpjs_jkm",
        "#premi_bpjs_kesehatan",
        "#naturan_pph21",
    ]);
    let isGross = $("#metode_penggajian").val();
    let hitungTunjanganPph = hitungTunjanganPPh(total);
    let tunjangan_pph = (isGross === "0") ? 0 : hitungTunjanganPph;

    $("#tunjangan_pph").val(formatNumber(tunjangan_pph));
    
    $("#jumlah_penghasilan_teratur").val(formatNumber(total + tunjangan_pph));
}

function setJumlahPph21Terutang(){

    let jumlah_penghasilan_bruto = parseNumber($("#jumlah_penghasilan_bruto").val());
    console.log(jumlah_penghasilan_bruto);
    let tarif = parsePercent($("#tarif_ter").val());
    console.log(tarif);
    let npwp = $("#npwp").val();
    let jumlah_pph21_terutang = calculatePercentage(jumlah_penghasilan_bruto, tarif);
    jumlah_pph21_terutang = (npwp == "-") ? calculatePercentage(jumlah_pph21_terutang, 120) : jumlah_pph21_terutang;
    console.log(jumlah_pph21_terutang);

    $("#jumlah_pph21_terutang").val(formatNumber(jumlah_pph21_terutang));

}

function hitungTunjanganPPh(totalPenghasilan) {

    if (!totalPenghasilan || !window.tarifPPh.length) return 0;

    let tarifData =
        window.tarifPPh.find(
            (t) =>
                totalPenghasilan >= t.PENGHASILAN_MIN &&
                totalPenghasilan <= t.PENGHASILAN_MAX
        ) || {};
    let tarif = (parseFloat(tarifData.TARIF) || 0) / 100;

    $("#id_ter").val(tarifData.ID_TER || "");

    $("#tarif_ter").val(tarifData.TARIF);
    $("#kategori_ter").val(tarifData.LAPISAN);

    return Math.floor((totalPenghasilan * tarif) / (1 - tarif));
}

function setIuranBpjsTk() {
    let gajiPokok = parseNumber($("#gaji_pokok").val());
    ["jht", "jp"].forEach((type) =>
        updateIuran(`iuran_bpjs_tk_${type}`, gajiPokok)
    );
}

function setPremiBpjsTk() {
    let gajiPokok = parseNumber($("#gaji_pokok").val());
    ["jht", "jkk", "jkm", "jp"].forEach((type) =>
        updatePremi(`premi_bpjs_tk_${type}`, gajiPokok)
    );
}

function updatePremi(id, gajiPokok) {
    let percent = parsePercent($(`#${id}_percent`).val());
    let premi = calculatePercentage(gajiPokok, percent);
    $(`#${id}`).val(formatNumber(premi));

    if (id == "premi_bpjs_tk_jkk") {
        $(`#premi_bpjs_jkk`).val(formatNumber(premi));
    } else if (id == "premi_bpjs_tk_jkm") {
        $(`#premi_bpjs_jkm`).val(formatNumber(premi));
    }

    percent = parsePercent($(`#premi_bpjs_kesehatan_percent`).val());
    premi = calculatePercentage(gajiPokok, percent);
    $(`#premi_bpjs_kesehatan`).val(formatNumber(premi));
    $(`#premi_bpjs_kesehatan_info`).val(formatNumber(premi));
}
function updateIuran(id, gajiPokok) {
    let percent = parsePercent($(`#${id}_percent`).val());
    let iuran = calculatePercentage(gajiPokok, percent);
    $(`#${id}`).val(formatNumber(iuran));

    if (id == "iuran_bpjs_tk_jht") {
        $(`#iuran_pensiun_bpjs_tk_jht`).val(formatNumber(iuran));
    } else if (id == "iuran_bpjs_tk_jp") {
        $(`#iuran_pensiun_bpjs_tk_jp`).val(formatNumber(iuran));
    }

    percent = parsePercent($(`#iuran_bpjs_kesehatan_percent`).val());
    iuran = calculatePercentage(gajiPokok, percent);
    $(`#iuran_bpjs_kesehatan`).val(formatNumber(iuran));
}

function calculatePercentage(amount, percent) {
    return (amount * percent) / 100;
}

function sumValues(fields) {
    return fields.reduce((sum, id) => sum + parseNumber($(id).val()), 0);
}

function parseNumber(value) {
    return parseFloat((value || "0").replace(/\./g, "").trim()) || 0;
}

function parsePercent(value) {
    return (
        parseFloat((value || "0").replace(",", ".").replace("%", "").trim()) ||
        0
    );
}

function formatNumber(value) {
    return value.toLocaleString("id-ID", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    });
}

$("#form-premi-bpjs").on("submit", function (e) {
    e.preventDefault();
    $("#modal-premi-bpjs").modal("hide");
});

$("#form-iuran-bpjs").on("submit", function (e) {
    e.preventDefault();
    $("#modal-iuran-bpjs").modal("hide");
});

$("#form-edit").on("submit", function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    Global.ajax("tax/pph21/bulanan", "POST", formData, handleFormResponse);
});

function handleFormResponse(result) {
    if (result.type === "success") {
        reloadTable();
        Global.toastNotif(result.message);
        $("#modal-edit").modal("hide");
        $("#form-edit")[0].reset();
    } else {
        Global.toastNotif(result.message);
    }
}

$(document).ready(function () {
    setupEmployeeSelect();
    setupModalHandlers();
});

function setupEmployeeSelect() {
    $("#employee-select")
        .select2({
            placeholder: "Ketik Nama atau NIK",
            width: "100%",
            ajax: {
                url: "/api/v1.0/master/pegawai",
                dataType: "json",
                delay: 250,
                processResults: (data) => ({
                    results: data.data.map((item) => ({
                        id: item.ID_PEGAWAI,
                        text: `${item.NAMA} - ${item.NIK}`,
                        data: item,
                    })),
                }),
            },
        })
        .on("select2:select", function (e) {
            let data = e.params.data.data;
            $("#id_pegawai").val(data.ID_PEGAWAI);
            $("#nama").val(data.NAMA);
            $("#nik").val(data.NIK);
            $("#npwp").val(data.NPWP || "-");
            $("#status-ptkp").val(data.PTKP);
            Global.ajax(
                `tax/pph21/get-tarif?id_pegawai=${data.ID_PEGAWAI}`,
                "GET",
                null,
                (result) => {
                    if (result.type === "success")
                        window.tarifPPh = result.data;
                }
            );
            $("#modal-select-employee").modal("hide");
            $("#modal-edit").modal("show");
        });
}

function setupModalHandlers() {
    $(".premi-bpjs, .btn-premi-bpjs-edit").on("click", function () {

        $("#modal-edit").modal("hide");
        $("#modal-premi-bpjs").modal("show");
    });
    $("#modal-premi-bpjs").on("hidden.bs.modal", function () {
        $("#modal-edit").modal("show");
    });

    $(".iuran-bpjs, .btn-iuran-bpjs-edit").on("click", function () {
        $("#modal-edit").modal("hide");
        $("#modal-iuran-bpjs").modal("show");
    });
    $("#modal-iuran-bpjs").on("hidden.bs.modal", function () {
        $("#modal-edit").modal("show");
    });
}


function loadListingBulananPPh21(){

    let url = `/api/v1.0/${pphBulananURL}/list`;

    let jsonData = [
        { data: "no", width: "10px", class: "text-center" },
        { data: "MASA_PAJAK" },
        { data: "TAHUN_PAJAK", class: "text-center" },
        { data: "NAMA", width: "100px" },
        { data: "NIK", width: "100px" },
        { data: "NPWP", width: "150px" },
        { data: "KATEGORI_TER", class: "text-center" },
        { data: "GROSS_UP", class: "text-center" },
        { data: "GAJI_POKOK", class: "text-right" },
        { data: "TUNJANGAN_PPH", class: "text-right" },
        { data: "PENGHASILAN_BRUTO", class: "text-right" },
    ];
    data_table(url, jsonData);
}

function viewDetailBulananPPh21(id_masa_pajak) {
    Global.ajax(`${pphBulananURL}/${id_masa_pajak}`, "GET", null, (response) => {
        renderViewBulananDetail(response.data);
    });
}
function renderViewBulananDetail(data) {
    $(".panel-view").removeClass('d-none');

    Object.keys(data).forEach(key => {
        Object.keys(data).forEach(key => {
            if (document.getElementById('view_' + key)) {
                document.getElementById('view_' + key).textContent = data[key];
            }
        });

        $(".breadcrumb_detail").html(data.NAMA);

    });
}

$('#table_data').on('dblclick','tr',function(e){
    e.stopPropagation()                       
    var data = table.row(this).data();
    let redirectUrl = `${CONFIG.webUrl}/${pphBulananURL}?id=${data.ID_MASA_PAJAK}&action=view`;

    window.location.href = redirectUrl;

});