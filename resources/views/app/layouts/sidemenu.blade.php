<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="my-4 aside-menu" data-menu-vertical="1" data-menu-scroll="1"
        data-menu-dropdown-timeout="500">
        @canany(['super_admin', 'admin'])
            <ul class="menu-nav">
                <li class="menu-item {{ $isActive == 'dashboard' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                    <a href="{{ route('dashboard') }}" class="menu-link">
                        <i class="menu-icon flaticon-home"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu {{ $isActive == 'profil' ? 'menu-item-open menu-item-here' : '' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <i class="menu-icon flaticon-web"></i>
                        <span class="menu-text">Profil</span>
                        <i class="menu-arrow"></i>
                        {{-- <span class="menu-text">General</span>
                        <i class="menu-arrow"></i> --}}
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Profil</span>
                                </span>
                            </li>
                            <li class="menu-item {{ $isActiveSub == 'kategori_profil' ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('profils.kategori') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Kategori Profil</span>
                                </a>
                            </li>
                            @foreach($listProfil as $info)
                                <li class="menu-item {{ $isActiveSub == $info->slug ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('profils', ['slug' => $info->slug, 'uuid' => $info->uuid]) }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{ucfirst($info->nama)}}</span>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu {{ $isActive == 'postingan' ? 'menu-item-open menu-item-here' : '' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <i class="menu-icon flaticon-web"></i>
                        <span class="menu-text">Postingan</span>
                        <i class="menu-arrow"></i>
                        {{-- <span class="menu-text">General</span>
                        <i class="menu-arrow"></i> --}}
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Postingan</span>
                                </span>
                            </li>
                            <li class="menu-item {{ $isActiveSub == 'kategori_postingan' ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('postingans.kategori') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Kategori Postingan</span>
                                </a>
                            </li>
                            @foreach($listInformasi as $info)
                                <li class="menu-item {{ $isActiveSub == $info->slug ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('postingans', ['slug' => $info->slug, 'uuid' => $info->uuid]) }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{ucfirst($info->nama)}}</span>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu {{ $isActive == 'dokumen' ? 'menu-item-open menu-item-here' : '' }}"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <i class="menu-icon flaticon-web"></i>
                        <span class="menu-text">Dokumen</span>
                        <i class="menu-arrow"></i>
                        {{-- <span class="menu-text">General</span>
                        <i class="menu-arrow"></i> --}}
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Dokumen</span>
                                </span>
                            </li>
                            <li class="menu-item {{ $isActiveSub == 'kategori_dokumen' ? 'menu-item-active' : '' }}"
                                aria-haspopup="true">
                                <a href="{{ route('dokumens.kategori') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Kategori Dokumen</span>
                                </a>
                            </li>
                            @foreach($listDokumen as $info)
                                <li class="menu-item {{ $isActiveSub == $info->slug ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true">
                                    <a href="{{ route('dokumens', ['slug' => $info->slug, 'uuid' => $info->uuid]) }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{ucfirst($info->nama)}}</span>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </li>
                <li class="menu-item {{ $isActive == 'aduans' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('aduans') }}" class="menu-link">
                            <i class="menu-icon flaticon-users"></i>
                            <span class="menu-text">Aduan</span>
                        </a>
                </li>
                
                @can('super_admin')
                    <li class="menu-item {{ $isActive == 'users' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('users') }}" class="menu-link">
                            <i class="menu-icon flaticon-users"></i>
                            <span class="menu-text">Admin</span>
                        </a>
                    </li>
                    {{-- <li class="menu-item {{ $isActive == 'tesusers' ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('tesusers') }}" class="menu-link">
                            <i class="menu-icon flaticon-users"></i>
                            <span class="menu-text">Test Admin</span>
                        </a>
                    </li> --}}
                @endcan
            </ul>
        @endcanany

    </div>
    <!--end::Menu Container-->
</div>
