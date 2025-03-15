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

    <script src="{{asset('template')}}/global/js/State.min.js"></script>
    <script src="{{asset('template')}}/global/js/Component.min.js"></script>
    <script src="{{asset('template')}}/global/js/Plugin.min.js"></script>
    <script src="{{asset('template')}}/global/js/Base.min.js"></script>
    <script src="{{asset('template')}}/global/js/Config.min.js"></script>
    <script src="{{asset('template')}}/base/assets/js/Section/Menubar.min.js"></script>
    <script src="{{asset('template')}}/base/assets/js/Section/GridMenu.min.js"></script>
    <script src="{{asset('template')}}/base/assets/js/Section/Sidebar.min.js"></script>
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
    <script src="{{asset('template')}}/global/vendor/datatables.net-buttons/dataTables.buttons.js"></script>
    <script src="{{asset('template')}}/global/vendor/datatables.net-buttons/buttons.html5.js"></script>
    <script src="{{asset('template')}}/global/vendor/datatables.net-buttons/buttons.flash.js"></script>
    <script src="{{asset('template')}}/global/vendor/datatables.net-buttons/buttons.print.js"></script>
    <script src="{{asset('template')}}/global/vendor/datatables.net-buttons/buttons.colVis.js"></script>
    <script src="{{asset('template')}}/global/vendor/datatables.net-buttons-bs4/buttons.bootstrap4.js"></script>

    <script>
        Config.set('assets', "{{asset('template')}}/base/assets");
    </script>
    <!-- Page -->
    <script src="{{asset('template')}}/base/assets/js/Site.js"></script>
    <script src="{{asset('template')}}/global/js/Plugin/asscrollable.js"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{asset('assets/js/')}}/config.js"></script>
    <script src="{{asset('assets/js/')}}/constants.js"></script>
    <script src="{{asset('assets/js/')}}/global.js"></script>
    <script src="{{asset('assets/js/')}}/router.js"></script>
    <script src="{{asset('assets/js/')}}/app.js"></script>
    <script src="{{asset('assets/js/')}}/custom.js"></script>

</body>

</html>