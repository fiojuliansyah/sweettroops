<aside class="sidebar">
    <!-- sidebar close btn -->
     <button type="button" class="sidebar-close-btn text-gray-500 hover-text-white hover-bg-main-600 text-md w-24 h-24 border border-gray-100 hover-border-main-600 d-xl-none d-flex flex-center rounded-circle position-absolute"><i class="ph ph-x"></i></button>
    <!-- sidebar close btn -->
    
    <a href="{{ route('troopers.dashboard') }}" class="sidebar__logo text-center p-20 position-sticky inset-block-start-0 bg-white w-100 z-1 pb-10">
        <img src="/pages/assets/img/logo.png" alt="Logo" width="20%">
    </a>

    <div class="sidebar-menu-wrapper overflow-y-auto scroll-sm">
        <div class="p-20 pt-10">
            <ul class="sidebar-menu">
                <li class="sidebar-menu__item {{ Route::is('troopers.dashboard') ? 'activePage' : '' }}">
                    <a href="{{ route('troopers.dashboard') }}" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-squares-four"></i></span>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-menu__item has-dropdown {{ Route::is(['troopers.all-course','troopers.my-course']) ? 'activePage' : '' }}">
                    <a href="javascript:void(0)" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-graduation-cap"></i></span>
                        <span class="text">kursus</span>
                    </a>
                    <!-- Submenu start -->
                    <ul class="sidebar-submenu">
                        <li class="sidebar-submenu__item {{ Route::is(['troopers.all-course']) ? 'activePage' : '' }}">
                            <a href="{{ route('troopers.all-course') }}" class="sidebar-submenu__link"> Semua Kurus </a>
                        </li>
                        <li class="sidebar-submenu__item {{ Route::is(['troopers.my-course']) ? 'activePage' : '' }}">
                            <a href="{{ route('troopers.my-course') }}" class="sidebar-submenu__link"> Kursus Saya </a>
                        </li>
                    </ul>
                    <!-- Submenu End -->
                </li>
                <li class="sidebar-menu__item {{ Route::is(['troopers.my-transactions']) ? 'activePage' : '' }}">
                    <a href="{{ route('troopers.my-transactions') }}" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-coins"></i></span>
                        <span class="text">Transaksi Saya</span>
                    </a>
                </li>   
                @auth 
                    @if (Auth::user()->role == 'admin')  
                        <li><span>Manage</span></li>
                        <br>
                        <li class="sidebar-menu__item {{ Route::is(['admin.discuss-course']) ? 'activePage' : '' }}">
                            <a href="{{ route('admin.discuss-course') }}" class="sidebar-menu__link">
                                <span class="icon"><i class="ph ph-chats-teardrop"></i></span>
                                <span class="text">Admin Discuss</span>
                            </a>
                        </li>                
                        <li class="sidebar-menu__item {{ Route::is(['admin.transactions.index']) ? 'activePage' : '' }}">
                            <a href="{{ route('admin.transactions.index') }}" class="sidebar-menu__link">
                                <span class="icon"><i class="ph ph-coins"></i></span>
                                <span class="text">Transaksi</span>
                            </a>
                        </li>
                        <li class="sidebar-menu__item has-dropdown {{ Route::is(['admin.types.index','admin.types.create'.'admin.types.edit','admin.categories.index','admin.categories.create','admin.categories.edit','admin.courses.index','admin.videos.index','admin.videos.create','admin.videos.edit']) ? 'activePage' : '' }}">
                            <a href="javascript:void(0)" class="sidebar-menu__link">
                                <span class="icon"><i class="ph ph-graduation-cap"></i></span>
                                <span class="text">Kursus</span>
                            </a>
                            <!-- Submenu start -->
                            <ul class="sidebar-submenu">
                                <li class="sidebar-submenu__item {{ Route::is(['admin.types.index','admin.types.create'.'admin.types.edit']) ? 'activePage' : '' }}">
                                    <a href="{{ route('admin.types.index') }}" class="sidebar-submenu__link"> Tipe </a>
                                </li>
                                <li class="sidebar-submenu__item {{ Route::is(['admin.categories.index','admin.categories.create','admin.categories.edit']) ? 'activePage' : '' }}">
                                    <a href="{{ route('admin.categories.index') }}" class="sidebar-submenu__link"> Kategori </a>
                                </li>
                                <li class="sidebar-submenu__item {{ Route::is(['admin.courses.index','admin.videos.index','admin.videos.create','admin.videos.edit']) ? 'activePage' : '' }}">
                                    <a href="{{ route('admin.courses.index') }}" class="sidebar-submenu__link"> Buat Kursus </a>
                                </li>
                            </ul>
                            <!-- Submenu End -->
                        </li>
                        <li class="sidebar-menu__item {{ Route::is(['admin.users.index']) ? 'activePage' : '' }}">
                            <a href="{{ route('admin.users.index') }}" class="sidebar-menu__link">
                                <span class="icon"><i class="ph ph-users-three"></i></span>
                                <span class="text">User</span>
                            </a>
                        </li>
                        <li class="sidebar-menu__item">
                            <a href="{{ route('admin.homepages.index') }}" class="sidebar-menu__link">
                                <span class="icon"><i class="ph ph-squares-four"></i></span>
                                <span class="text">Home Setting</span>
                            </a>
                        </li>
                        <li class="sidebar-menu__item">
                            <a href="{{ route('admin.sliders.index') }}" class="sidebar-menu__link">
                                <span class="icon"><i class="ph ph-books"></i></span>
                                <span class="text">Slider</span>
                            </a>
                        </li>
                    @endif        
                @endauth
            </ul>
        </div>
        <div class="p-20 pt-80">
            <div class="bg-main-50 p-20 pt-0 rounded-16 text-center mt-74">
                <span class="border border-5 bg-white mx-auto border-primary-50 w-114 h-114 rounded-circle flex-center text-success-600 text-2xl translate-n74">
                    <img src="/pages/assets/img/logo.png" alt="" class="centerised-img">
                </span>
                <div class="mt-n74">
                    <h5 class="mb-4 mt-22">Dapatkan Kursus</h5>
                    <p class="">Explore 400+ kursus dengan akses selamanya</p>
                    <a href="{{ route('troopers.all-course') }}" class="btn btn-main mt-16 rounded-pill">Ambil</a>
                </div>
            </div>
        </div>
    </div>

</aside>  