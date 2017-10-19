<div class="overlay"></div>
<section>
    <aside id="leftsidebar" class="sidebar">
        <div class="user-info">
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true"
                     aria-expanded="false">{{ Auth::user()->name }}</div>
                <div class="email">{{ Auth::user()->email }}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="#" onclick="event.preventDefault()"><i class="material-icons">account_box</i>Perfil</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                        class="material-icons">exit_to_app</i>Sair</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  class="hidden">{{ csrf_field() }}</form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="menu">
            <ul class="list">
                <li {{ Route::is('admin.dashboard') ? 'class=active' : '' }}>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="material-icons">home</i>
                        <span>Início</span>
                    </a>
                </li>
                <li {{ Route::is('paciente.*') ? 'class=active' : '' }}>
                    <a href="{{ route('paciente.index') }}">
                        <i class="material-icons">supervisor_account</i>
                        <span>Pacientes</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="event.preventDefault()" class="menu-toggle">
                        <i class="material-icons">playlist_add_check</i>
                        <span>Administração</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{ route('convenio.index') }}">Convênios</a>
                        </li>
                        <li>
                            <a href="{{ route('cid.index') }}">CID</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside>
</section>