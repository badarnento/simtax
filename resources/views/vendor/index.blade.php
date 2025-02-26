@extends('layouts.master')


@section('content')
<div class="container">
    <h2>Vendor List</h2>
    <table class="table table-bordered table-striped table-responsive w-full" cellspacing="0" id="table_data">
        <thead>
            <tr>
              <th>No.</th>
              <th class="text-center">Vendor ID</th>
              <th class="text-center">Name</th>
              <th class="text-center">Email</th>
              <th class="text-center">Address</th>
              <th class="text-center">Jenis Pajak</th>
              <th class="text-center">Phone</th>
              <th class="text-center">Contact Person</th>
            </tr>
          </thead>
    </table>
</div>
@endsection


@section('scripts')

@yield('scripts')

<!-- jQuery dan DataTables -->
<script>

    url = "{{ route('vendor.listing') }}";
    jsonData = [
                { "data": "no", "width":"10px", "class":"text-center"},
                { "data": "vendor_id", "width":"50px", "class":"text-left"},
                { "data": "vendor_name", "width":"150px"},
                { "data": "vendor_email", "width":"100px"},
                { "data": "vendor_address", "width":"100px"},
                { "data": "tax_type", "width":"100px"},
                { "data": "phone", "width":"100px"},
                { "data": "contact_person", "width":"100px"},
            ];

    data_table(url,jsonData);
</script>
@endsection