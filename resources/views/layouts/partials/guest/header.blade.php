<section id="Home" class="section">
        <div class="w-layout-blockcontainer container w-container">
            <div class="navbar-logo-left">
                <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease"
                    data-easing2="ease" role="banner" class="navbar-logo-left-container shadow-three w-nav">
                    <div class="container-2">
                        <div class="navbar-wrapper">
                            <a href="#" class="navbar-brand w-nav-brand"><img
                                    src="/frontend/assets/images/Logo-ST.png" loading="lazy" alt=""
                                    class="image"></a>
                            <nav role="navigation" class="nav-menu-wrapper w-nav-menu">
                                <ul role="list" class="nav-menu-two w-list-unstyled">
                                    <li>
                                        <a href="/" class="nav-link">Home</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('about') }}" class="nav-link">About Us</a>
                                    </li>
                                    <li>
                                        <div data-hover="false" data-delay="0" class="nav-dropdown w-dropdown">
                                            <div class="nav-dropdown-toggle w-dropdown-toggle">
                                                <div class="nav-dropdown-icon w-icon-dropdown-toggle"></div>
                                                <div class="text-block">Courses</div>
                                            </div>
                                            <nav
                                                class="nav-dropdown-list shadow-three mobile-shadow-hide w-dropdown-list">
                                                <a href="{{ route('courses') }}"
                                                    class="nav-dropdown-link w-dropdown-link">Online Classes</a>
                                                <a href="{{ route('handson') }}"
                                                    class="nav-dropdown-link w-dropdown-link">Hands-On Classes</a>
                                            </nav>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="{{ route('contacts') }}" class="nav-link">Contacts</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('faqs') }}" class="nav-link">FAQs</a>
                                    </li>
                                    <li>
                                        <div class="nav-divider"></div>
                                    </li>
                                    @guest
                                        <li class="mobile-margin-top-10">
                                            <a href="{{ route('login-first') }}" class="button-primary w-button">LOG IN</a>
                                        </li>
                                    @endguest

                                    @auth
                                        <li class="nav-item dropdown">
                                            <a href="#" class="dropdown-toggle button-primary w-button">
                                                {{ Auth::user()->name }} ▾
                                            </a>

                                            <ul class="dropdown-menu">
                                                @if (Auth::user()->role === 'admin')
                                                <li>
                                                    <a href="{{ route('admin.dashboard') }}">CMS</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.users.index') }}">Users Lists</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.transactions.index') }}">Transactions Lists</a>
                                                </li>
                                                @endif
                                                <li>
                                                    <a href="{{ route('troopers.profile.edit') }}">Account Setting</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('troopers.my-course') }}">My Classes</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <a href="{{ route('logout') }}"
                                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                                            Log Out
                                                        </a>
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                    @endauth                                    
                                </ul>
                            </nav>
                            <div class="menu-button w-nav-button">
                                <div class="w-icon-nav-menu"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>