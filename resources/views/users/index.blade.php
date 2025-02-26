@extends('layouts.master')


@section('content')
<div class="container">
    <h2>Users List</h2>
    <table class="table table-bordered table-striped table-responsive w-full" cellspacing="0" id="table_data">
        <thead>
            <tr>
              <th>No.</th>
              <th class ="text-center"> Name</th>
              <th class ="text-center">Email</th>
              <th class ="text-center">Created At</th>
            </tr>
          </thead>
    </table>
</div>
@endsection


@section('scripts')

@yield('scripts')

<!-- jQuery dan DataTables -->
<script>


    url = "{{ route('users.listing') }}";
    jsonData = [
                { "data": "no", "width":"10px", "class":"text-center"},
                { "data": "name", "width":"200px", "class":"text-left"},
                { "data": "email", "width":"100px"},
                { "data": "created_at", "width":"100px", "class":"text-center"}
            ];

    data_table(url,jsonData);
</script>
@endsection