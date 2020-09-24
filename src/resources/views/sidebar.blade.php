<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('index') }}" class="site_title">
                <i class="fa fa-tasks"></i>
                <span>{{ config('app.name') }}</span>
            </a>
        </div>

        <div class="clearfix"></div>

        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ asset('images/fotoperfil.jpg') }}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Bem-vindo,</span>
                <h2>Fulano</h2>
            </div>
        </div>

        <br />

        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-edit"></i> Cadastro <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('projetos.create') }}">Projetos</a></li>
                            <li><a href="{{ route('atividades.create') }}">Atividades</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-table"></i> Consulta <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('projetos.index') }}">Projetos</a></li>
                            <li><a href="{{ route('atividades.index') }}">Atividade</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
