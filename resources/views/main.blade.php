@include('layouts.header')

<body class="animsition">
    <!-- Topbar -->
    @include('layouts.navbar')
    <!-- End of Topbar -->

    <!-- Sidebar -->
    @include('layouts.sidebar')
    <!-- End of Sidebar -->

    <!-- Page -->
    <div class="page">
        <div class="loading-overlay" id="loading">
            <div class="example-loading example-well h-150 vertical-align text-center">
                <div class="loader vertical-align-middle loader-grill"></div>
            </div>
        </div>
        <div class="page-content">
            <main>
                <div id="app"></div>
            </main>
        </div>
    </div>
    <!-- End Page -->

    <!-- Footer -->
    @include('layouts.footer')
    <!-- End of Footer -->

    <!-- Core  -->
    <script src="{{asset('template')}}/global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
    <script src="{{asset('template')}}/global/vendor/jquery/jquery.min.js"></script>
    <script src="{{asset('template')}}/global/vendor/tether/tether.min.js"></script>
    <script src="{{asset('template')}}/global/vendor/bootstrap/bootstrap.min.js"></script>
    <script src="{{asset('template')}}/global/vendor/animsition/animsition.min.js"></script>
    <script src="{{asset('template')}}/global/vendor/asscrollbar/jquery-asScrollbar.min.js"></script>
    <script src="{{asset('template')}}/global/vendor/asscrollable/jquery-asScrollable.min.js"></script>
    <script src="{{asset('template')}}/global/vendor/ashoverscroll/jquery-asHoverScroll.min.js"></script>
    <script src="{{asset('template')}}/global/vendor/waves/waves.js"></script>

    <script src="{{asset('template')}}/global/vendor/select2/select2.full.min.js"></script>


    <script src="{{asset('template')}}/global/js/State.js"></script>
    <script src="{{asset('template')}}/global/js/Component.js"></script>
    <script src="{{asset('template')}}/global/js/Plugin.js"></script>
    <script src="{{asset('template')}}/global/js/Base.js"></script>
    <script src="{{asset('template')}}/global/js/Config.js"></script>
    <script src="{{asset('template')}}/base/assets/js/Section/Menubar.js"></script>
    <script src="{{asset('template')}}/base/assets/js/Section/GridMenu.js"></script>
    <script src="{{asset('template')}}/base/assets/js/Section/Sidebar.js"></script>
    <script src="{{asset('template')}}/base/assets/js/Plugin/menu.js"></script>

    <script src="{{asset('js')}}/PACE/pace.min.js"></script>
    <script src="{{asset('template')}}/global/vendor/datatables.net/jquery.dataTables.js"></script>
    <script src="{{asset('template')}}/global/vendor/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="{{asset('template')}}/global/vendor/datatables.net-fixedheader/dataTables.fixedHeader.js"></script>
    <script src="{{asset('template')}}/global/vendor/datatables.net-fixedcolumns/dataTables.fixedColumns.js"></script>
    <script src="{{asset('template')}}/global/vendor/datatables.net-rowgroup/dataTables.rowGroup.js"></script>
    <script src="{{asset('template')}}/global/vendor/datatables.net-scroller/dataTables.scroller.js"></script>
    <script src="{{asset('template')}}/global/vendor/datatables.net-select-bs4/dataTables.select.js"></script>
    <script src="{{asset('template')}}/global/vendor/datatables.net-responsive/dataTables.responsive.js"></script>
    <script src="{{asset('template')}}/global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.js"></script>
    
    <script>
        Config.set('assets', "{{asset('template')}}/base/assets");
    </script>
    <!-- Page -->
    <script src="{{asset('template')}}/base/assets/js/Site.js"></script>
    <script src="{{asset('template')}}/global/js/Plugin/asscrollable.js"></script>
    <script src="{{asset('template')}}/global/js/Plugin/select2.js"></script>

    <script>
        (function(document, window, $) {
            'use strict';
            var Site = window.Site;
            $(document).ready(function() {
                Site.run();
            });
        })(document, window, jQuery);
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{asset('assets/js/')}}/config.js"></script>
    <script src="{{asset('assets/js/')}}/constants.js"></script>
    <script src="{{asset('assets/js/')}}/global.js"></script>
    <script src="{{asset('assets/js/')}}/router.js"></script>
    <script src="{{asset('assets/js/')}}/app.js"></script>
    <script src="{{asset('assets/js/')}}/custom.js"></script>

<script src="{{asset('js')}}/formatter.js"></script>


</body>

</html>