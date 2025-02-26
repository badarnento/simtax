@extends('layouts.master')
@section('content')
<div class="container">
    <h2>Data Karyawan</h2>
    <table class="table table-bordered table-striped table-responsive w-full" cellspacing="0" id="table_data">
        <thead>
            <tr>
                <th>No.</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Email</th>
                <th class="text-center">Telepon</th>
                <th class="text-center">Jabatan</th>
                <th class="text-center">Departemen</th>
                <th class="text-center">Gaji</th>
                <th class="text-center">Tanggal Masuk</th>
            </tr>
        </thead>
    </table>
</div>
@endsection


@section('scripts')

@yield('scripts')

<!-- jQuery dan DataTables -->
<script>
    url = "{{ route('employees.listing') }}";
    jsonData = [{
            "data": "no",
            "width": "10px",
            "class": "text-center"
        },
        {
            "data": "name",
            "width": "200px",
            "class": "text-left"
        },
        {
            "data": "email",
            "width": "100px"
        },
        {
            "data": "phone",
            "width": "100px"
        },
        {
            "data": "position",
            "width": "100px"
        },
        {
            "data": "department",
            "width": "100px"
        },
        {
            "data": "salary",
            "width": "100px"
        },
        {
            "data": "hire_date",
            "width": "100px",
            "class": "text-center"
        }
    ];

    data_table(url, jsonData);
</script>
@endsection