@include('layouts.header')

<body class="animsition">
    <!--    
<style>
        body {
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: #222;
            padding: 10px;
            color: white;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-right: 10px;
        }
    </style> -->

    <!-- Topbar -->
    @include('layouts.navbar')
    <!-- End of Topbar -->

    <!-- Sidebar -->
    @include('layouts.sidebar')
    <!-- End of Sidebar -->

    <!-- Page -->
    <div class="page">
        <div id="content" class="page-content">
            @include('pages.' . $page) {{-- Menambahkan "pages." sebelum nama halaman --}}
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
    <!-- Plugins -->
    <!-- <script src="{{asset('template')}}/global/vendor/screenfull/screenfull.min.js"></script> -->
    <!-- Scripts -->
    <script src="{{asset('template')}}/global/js/State.min.js"></script>
    <script src="{{asset('template')}}/global/js/Component.min.js"></script>
    <script src="{{asset('template')}}/global/js/Plugin.min.js"></script>
    <script src="{{asset('template')}}/global/js/Base.min.js"></script>
    <script src="{{asset('template')}}/global/js/Config.min.js"></script>
    <script src="{{asset('template')}}/base/assets/js/Section/Menubar.min.js"></script>
    <script src="{{asset('template')}}/base/assets/js/Section/GridMenu.min.js"></script>
    <script src="{{asset('template')}}/base/assets/js/Section/Sidebar.min.js"></script>
    <script src="{{asset('template')}}/base/assets/js/Plugin/menu.min.js"></script>
    <!-- <script src="{{asset('template')}}/global/js/config/colors.min.js"></script> -->

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

    <script>
        const BASE_URL = window.location.origin;
        console.log("Base URL:", BASE_URL);

        $(document).ready(function() {
            checkToken();
            initPage();

            // Tambahkan loading screen & spinner ke dalam body
            $(".page").append('<div id="loading-screen"><div class="spinner"></div></div>');

            // Pastikan history state pertama sudah diatur
            history.replaceState({
                page: "{{ $page ?? 'home' }}"
            }, "", BASE_URL + "/{{ $page ?? 'home' }}");

            $(".nav-link").click(function(e) {
                e.preventDefault();

                checkToken();
                let url = $(this).data("url");

                if (!url) {
                    console.log("URL undefined");
                    return;
                }

                const currentPage = window.location.pathname.replace(/^\//, '');
                if (url === currentPage) {
                    return;
                }

                // Tampilkan loading screen
                $("#loading-screen").css("display", "flex").hide().fadeIn(200);

                // Tutup menu navigasi jika ada
                $("#close-btn").trigger("click");

                // Tunggu animasi sebelum memuat konten baru
                setTimeout(function() {
                    $.get(`${BASE_URL}/${url}`, function(data) {
                        $("#content").html(data);
                        history.pushState({
                            page: url
                        }, "", BASE_URL + "/" + url);
                        initPage(url);

                        // Sembunyikan loading screen
                        $("#loading-screen").fadeOut(200, function() {
                            $(this).css("display", "none");
                        });
                    }).fail(function() {
                        console.error(`Halaman ${BASE_URL}/${url} tidak ditemukan.`);
                        $("#loading-screen").fadeOut(200);
                    });
                }, 300);
            });

            window.onpopstate = function(event) {
                let url = location.pathname.replace(BASE_URL, "").substring(1); // Hapus leading "/"
                if (url === "") url = "home"; // Default ke home jika kosong

                // Tampilkan loading screen
                $("#loading-screen").css("display", "flex").hide().fadeIn(200);

                $.get(`${BASE_URL}/${url}`, function(data) {
                    $("#content").html(data);

                    // Hilangkan loading screen
                    $("#loading-screen").fadeOut(200, function() {
                        $(this).css("display", "none");
                    });

                    initPage(url);
                }).fail(function() {
                    console.error(`Halaman ${BASE_URL}/${url} tidak ditemukan.`);
                    $("#loading-screen").fadeOut(200);
                });
            };
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script src="{{asset('js')}}/custom.js"></script>
    <script src="{{asset('js')}}/global.js"></script>

    @yield('scripts')

</body>

</html>