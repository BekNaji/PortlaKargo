<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html">
                        {{ Auth::user()->company->name ?? '' }}
                        {{-- <img src="assets/images/logo/logo.png" alt="Logo" srcset=""> --}}
                    </a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                {{-- <li class="sidebar-title">Menu</li> --}}
                @if (Permission::check('cargo-index'))
                <li class="sidebar-item {{ request()->is('dashboard/index') || request()->is('dashboard/index/*') ? 'active' : '' }} ">
                    <a href="{{ route('dashboard.index') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Anasayfa</span>
                    </a>
                </li>
                @endif
                @if (Permission::check('cargo-index'))
                <li class="sidebar-item {{ request()->is('dashboard/cargo/*') ? 'active' : '' }} ">
                    <a href="{{ route('cargo.index') }}" class='sidebar-link'>
                        <svg class="bi" width="1em" height="1em" fill="currentColor">
                            <use
                                xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#truck-flatbed" />
                        </svg>
                        <span>Kargo</span>
                    </a>
                </li>
                @endif

                @if (Permission::check('delivery-index'))
                <li class="sidebar-item  ">
                    <a href="{{ route('delivery.index') }}" class='sidebar-link'>
                        <svg class="bi" width="1em" height="1em" fill="currentColor">
                            <use
                                xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#hash" />
                        </svg>
                        <span>Teslimat</span>
                    </a>
                </li>
                @endif
                @if (Permission::check('sender-index'))
                <li class="sidebar-item {{ request()->is('dashboard/customer/*') ? 'active' : '' }}  ">
                    <a href="{{ route('customer.index') }}" class='sidebar-link'>
                        <svg class="bi" width="1em" height="1em" fill="currentColor">
                            <use
                                xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#arrow-right-circle-fill" />
                        </svg>
                        <span>Göndericiler</span>
                    </a>
                </li>
                @endif
                @if(Permission::check('receiver-index'))
                <li class="sidebar-item {{ request()->is('dashboard/receiver/*') ? 'active' : '' }} ">
                    <a href="{{ route('receiver.index') }}" class='sidebar-link'>
                        <svg class="bi" width="1em" height="1em" fill="currentColor">
                            <use
                                xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#arrow-right-circle-fill" />
                        </svg>
                        <span>Alıcılar</span>
                    </a>
                </li>
                @endif
                @if (Permission::check('profile-index'))
                <li class="sidebar-item {{ request()->is('dashboard/profile/*') ? 'active' : '' }} ">
                    <a href="{{ route('profile.index') }}" class='sidebar-link'>
                        <svg class="bi" width="1em" height="1em" fill="currentColor">
                            <use
                                xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#file-person-fill" />
                        </svg>
                        <span>Profil ayarları</span>
                    </a>
                </li>
                @endif
                @if (Permission::check('user-index'))
                <li class="sidebar-item  {{ request()->is('dashboard/user/*') ? 'active' : '' }}">
                    <a href="{{ route('user.index') }}" class='sidebar-link'>
                        <svg class="bi" width="1em" height="1em" fill="currentColor">
                            <use
                                xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#person-lines-fill" />
                        </svg>
                        <span>Kullanıcılar</span>
                    </a>
                </li>
                @endif
                @if (Permission::check('settings-index'))
                <li class="sidebar-item {{ request()->is('dashboard/settings/*') ? 'active' : '' }}  has-sub">
                    <a href="#" class='sidebar-link'>
                        <svg class="bi" width="1em" height="1em" fill="currentColor">
                            <use
                                xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#gear" />
                        </svg>
                        <span>Genel Ayarlar</span>
                    </a>
                    <ul class="submenu {{ request()->is('dashboard/settings/*') ? 'active' : '' }}">
                        @if (Permission::check('cargo-status-index'))
                        <li class="submenu-item {{ request()->is('dashboard/settings/status/cargo*') ? 'active' : '' }}">
                            <a href="{{ route('status.cargo.index') }}">Kargo Status Ayarları</a>
                        </li>
                        @endif
                        @if (Permission::check('sms-settings-index'))
                        <li class="submenu-item {{ request()->is('dashboard/settings/sms/*') ? 'active' : '' }}">
                            <a href="{{ route('sms.index') }}">SMS Ayarlar</a>
                        </li>
                        @endif
                        <li class="submenu-item {{ request()->is('dashboard/settings/city*') ? 'active' : '' }}">
                            <a href="{{ route('city.index') }}">Şehir Ayarları</a>
                        </li>
                        
                        <li class="submenu-item {{ request()->is('dashboard/settings/company/*') ? 'active' : '' }}">
                            <a href="{{ route('settings.index') }}">Fırma Ayarları</a>
                        </li>

                        <li class="submenu-item {{ request()->is('dashboard/settings/web/header*') ? 'active' : '' }}">
                            <a href="{{ route('web.header') }}">Header</a>
                        </li>

                        <li class="submenu-item {{ request()->is('dashboard/settings/web/about*') ? 'active' : '' }}">
                            <a href="{{ route('web.about') }}">Hakkında ayarlari</a>
                        </li>

                        <li class="submenu-item {{ request()->is('dashboard/settings/service*') ? 'active' : '' }}">
                            <a href="{{ route('service.index') }}">Hizmet ayarlari</a>
                        </li>

                        <li class="submenu-item {{ request()->is('dashboard/settings/faq*') ? 'active' : '' }}">
                            <a href="{{ route('faq.index') }}">Soru ve Cevap ayarlari</a>
                        </li>

                        <li class="submenu-item {{ request()->is('dashboard/settings/address*') ? 'active' : '' }}">
                            <a href="{{ route('address.index') }}">Address ayarlari</a>
                        </li>
                    </ul>
                </li>
                @endif

                <li class="sidebar-item">
                    <a href="javascript:void" onclick="$('#logout-form').submit();" class='sidebar-link'>
                        <svg class="bi" width="1em" height="1em" fill="currentColor">
                            <use
                                xlink:href="{{asset('admin')}}/assets/vendors/bootstrap-icons/bootstrap-icons.svg#power" />
                        </svg>
                        <span>Çıkış</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                        @csrf  
                    </form>
                </li>
            </ul>

        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>