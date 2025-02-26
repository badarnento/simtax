@extends('layouts.master')


@section('content')
<div class="container">
    <h2>Recon PPH 21</h2>
    <table class="table table-bordered table-striped table-responsive w-full" cellspacing="0" id="table_data">
        <thead>
            <tr>
                <th>No.</th>
                <th class="text-center">Masa Pajak</th>
                <th class="text-center">Tahun Pajak</th>
                <th class="text-center">Organization Id</th>
                <th class="text-center">Nama Wp</th>
                <th class="text-center">Alamat</th>
                <th class="text-center">NPWP</th>
                <th class="text-center">Jenis Pajak</th>
                <th class="text-center">Invoice Number</th>
                <th class="text-center">Nomor Faktur Pajak</th>
                <th class="text-center">Tanggal Faktur Pajak</th>
                <th class="text-center">No Bukti Potong</th>
                <th class="text-center">Tgl Bukti Potong</th>
                <th class="text-center">Gl Account</th>
                <th class="text-center">Kode Pajak</th>
                <th class="text-center">Dpp</th>
                <th class="text-center">Tarif</th>
                <th class="text-center">Jumlah Potong</th>
                <th class="text-center">NPWP Pemotong</th>
                <th class="text-center">Nama Pemotong</th>
                <th class="text-center">WP Luar Negeri</th>
                <th class="text-center">Kode Negara</th>
            </tr>
        </thead>
    </table>
</div>
@endsection


@section('scripts')

@yield('scripts')

<!-- jQuery dan DataTables -->
<script>
    url = "{{ route('tax_line.listing') }}";
    jsonData = [
        { "data": "no", "width": "10px", "class": "text-center" },
        { "data": "masa_pajak", "width": "50px", "class": "text-left" },
        { "data": "tahun_pajak", "width": "100px" },
        { "data": "organization_id", "width": "100px" },
        { "data": "nama_wp", "width": "250px" },
        { "data": "alamat", "width": "3000px" },
        { "data": "npwp", "width": "2000px" },
        { "data": "jenis_pajak", "width": "100px" },
        { "data": "invoice_number", "width": "100px" },
        { "data": "nomor_faktur_pajak", "width": "150px" },
        { "data": "tanggal_faktur_pajak", "width": "100px" },
        { "data": "no_bukti_potong", "width": "150px" },
        { "data": "tgl_bukti_potong", "width": "100px" },
        { "data": "gl_account", "width": "100px" },
        { "data": "kode_pajak", "width": "100px" },
        { "data": "dpp", "width": "100px" },
        { "data": "tarif", "width": "100px" },
        { "data": "jumlah_potong", "width": "150px" },
        { "data": "npwp_pemotong", "width": "150px" },
        { "data": "nama_pemotong", "width": "150px" },
        { "data": "wp_luar_negeri", "width": "100px" },
        { "data": "kode_negara", "width": "100px" },
    ];

    data_table(url, jsonData);
</script>
@endsection