<!DOCTYPE html>
<html lang="pt-br">
    <!-- Head -->
    @includeIf('sistema/layout/head')

    <body>
        <!-- Preloader -->
        @includeIf('sistema/layout/preloader')

        <!--**********************************
            Main wrapper start
        ***********************************-->
        <div id="main-wrapper">
            <!-- header -->
            @includeIf('sistema/layout/header')

            <!-- Sidebar -->
            @includeIf('sistema/layout/sidebar')
            
            <!--**********************************
            Content body start
            ***********************************-->
            <div class="content-body">

                <!-- Conteudo da pagina -->
                @yield('conteudo')
                
            </div>
            <!--**********************************
                Content body end
            ***********************************-->
        
                <!-- Footer -->
            @includeIf('sistema/layout/footer')
        
        </div>
        <!--**********************************
            Main wrapper end
        ***********************************-->

        <!-- Scripts -->
        @includeIf('sistema/layout/js')
        

    </body>

</html>