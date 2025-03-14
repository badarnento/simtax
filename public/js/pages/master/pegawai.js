
url = "/api/master/pegawai/list";
jsonData = [
    { "data": "no", "width":"10px", "class":"text-center"},
    { "data": "ID_KODE_OBJEK_PPH21"},
    { "data": "NAMA"},
    { "data": "JENIS_KELAMIN"},
    { "data": "JABATAN"},
    { "data": "NIK"},
    { "data": "TKU_PENERIMA_PENGHASILAN"},
    { "data": "PTKP"},
    { "data": "ALAMAT"},
    { "data": "STATUS_KARYAWAN_RESIDENCE"},
    { "data": "NO_PASSPORT"},
    { "data": "NEGARA"},
    { "data": "KODE_NEGARA"},
    { "data": "BULAN_AWAL_PENGHASILAN"},
    { "data": "BULAN_AKHIR_PENGHASILAN"},
    { "data": "LAMA_BEKERJA"},
    { "data": "STATUS_PEGAWAI"},
    { "data": "DESKRIPSI_STATUS_PEGWAI"},
    { "data": "KODE_FASILITAS"},
    { "data": "NAMA_FASILITAS"},
    { "data": "KODE_DOKUMEN"},
    { "data": "NAMA_DOKUMEN_REFERENSI"},
    { "data": "NOMOR_DOKUMEN_REFERENSI"},
    { "data": "TGL_DOKUMEN_REFERENSI"},
];
data_table(url, jsonData);

