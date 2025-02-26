@extends('layouts.master')


@section('content')
<div class="container">
    <h2>Jenis Pajak</h2>
    <table class="table table-bordered table-striped table-responsive w-full" cellspacing="0" id="table_data">
        <thead>
            <tr>
              <th>No.</th>
              <th class ="text-center">Name</th>
              <th class ="text-center">Description</th>
              <th class ="text-center">Rate</th>
            </tr>
          </thead>
    </table>
</div>
@endsection


@section('scripts')

@yield('scripts')

<!-- jQuery dan DataTables -->
<script>


    url = "{{ route('tax-types.listing') }}";
    jsonData = [
                { "data": "no", "width":"10px", "class":"text-center"},
                { "data": "name", "width":"200px", "class":"text-left"},
                { "data": "description", "width":"100px"},
                { "data": "rate", "width":"100px", "class":"text-center"}
            ];

    data_table(url,jsonData);
</script>
@endsection