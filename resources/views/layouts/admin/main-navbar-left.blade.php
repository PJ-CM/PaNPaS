                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                            {{--
                                menu-open
                                ***************************************************
                            --}}
                            {{--
                            @php
                                echo 'Estoy en: [' . $_SERVER['REQUEST_URI'] . ']';
                                $pag_actual = $_SERVER['REQUEST_URI'];
                                $class_menu_open = '';
                                if($pag_actual == '/admin/users') { $class_menu_open = ' menu-open'; }
                            @endphp
                            <br>@{{ $route.path }}<br>--}}
                            <li class="nav-item has-treeview menu-open">
                                <a href="#" class="nav-link active" title="Desplegar/replegar secciones">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Gestión de datos
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/admin/users" class="nav-link" title="Ir a Usuarios">
                                            <i class="fas fa-users nav-icon"></i>
                                            <p>Usuarios</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/admin/contacts" class="nav-link" title="Ir a Mensajes">
                                            <i class="fas fa-envelope nav-icon"></i>
                                            <p>Mensajes</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-genderless nav-icon"></i>
                                            <p>Inactive Page</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-th"></i>
                                    <p>
                                        Simple Link
                                        <span class="right badge badge-danger">New</span>
                                    </p>
                                </a>
                            </li>
                            <hr>
                            <li class="nav-item">
                                <a href="{{ route('logout') }}" class="nav-link"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" title="Salir de la sesión">
                                <i class="nav-icon fas fa-power-off"></i>
                                <p>
                                    {{ __('Cerrar sesión') }}
                                </p>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </nav>
