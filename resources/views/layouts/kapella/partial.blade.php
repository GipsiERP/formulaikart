<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
        <div class="content-wrapper">
            @yield('content')
        </div>
                     
        @guest
        @else        
        <footer class="footer">
            <div class="footer-wrap">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © Gipsi ERP</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Gestão para seu negócio, tudo de forma simples, rápida e sem complicações ! </span>
                </div>
            </div>
        </footer>
        @endguest
				<!-- partial -->
    </div>
        <!-- main-panel ends -->
</div>