<!--**********************************
    Nav header start
***********************************-->
<div class="nav-header">
    <div class="brand-logo">
        <a href="{{route('dashboard')}}">
            <b class="logo-abbr"><i class="fa fa-shopping-cart text-white "></i></b> <!--<img src="{{asset('imagens/logoCarrinho.png')}}" width="25px" height="25px" alt=""> </b> -->
            <span class="logo-compact"><i class="fa fa-shopping-cart text-white"></i></span>  <!-- <img src="{{asset('imagens/logoCarrinho.png')}}" width="25px" height="25px" alt=""></span> -->
            <span class="brand-title">
                <!-- <img src="{{asset('imagens/logoEscrito.png')}}" width="150px" height="150px" alt=""> --> 
                <h4 class="text-white">&nbsp; <i class="fa fa-shopping-cart text-white"></i> Lista de Compras</h4>
            </span>
        </a>
    </div>
</div>
<!--**********************************
    Nav header end
***********************************-->

<!--**********************************
    Header start
***********************************-->
<div class="header">    
    <div class="header-content clearfix">
        
        <div class="nav-control">
            <div class="hamburger">
                <span class="toggle-icon"><i class="icon-menu"></i></span>
            </div>
        </div>
        
        <div class="header-right">
            <ul class="clearfix">
                <li class="icons dropdown">
                    <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                        <i class="icon-user"></i> {{$user->name }}
                    </div>
                    <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                        <div class="dropdown-content-body">
                            <ul>
                                <li>
                                    <a href="#"><i class="icon-user"></i> <span>Perfil</span></a> 
                                </li>
                                
                                <hr class="my-2">
                                
                                <li><a href="#" onclick="event.preventDefault; document.getElementById('logout-form').submit();"><i class="icon-key"></i> <span>Sair</span></a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                                        @csrf
                                    </form>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--**********************************
    Header end ti-comment-alt
***********************************-->