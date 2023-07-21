<header class="main-nav">
    <div class="sidebar-user text-center">
        <img class="img-90 rounded-circle" src="/assets/images/dashboard/1.png" alt="">
        <a href="user-profile.html">
            <h6 class="mt-3 f-14 f-w-600">{{ Auth::user()->name }}</h6>
        </a>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Меню</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="{{route('dashboard.slider.index')}}" class="nav-link menu-title link-nav" >
                            <i data-feather="file-text"></i><span>Слайдеры</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="{{route('dashboard.brend.index')}}" class="nav-link menu-title link-nav" >
                            <i data-feather="file-text"></i><span>Бренды</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="{{route('dashboard.category.index')}}" class="nav-link menu-title link-nav" >
                            <i data-feather="file-text"></i><span>Категория</span>
                        </a>
                    </li>
                    
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="home"></i>
                        <span>Продукты</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{route('dashboard.product.index')}}">Лист</a></li>
                            <li><a href="{{route('dashboard.product.create')}}">Создать</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="{{route('dashboard.sixstep.index')}}" class="nav-link menu-title link-nav" >
                            <i data-feather="file-text"></i><span>Шесть шагов</span>
                        </a>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="home"></i>
                        <span>О компании</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{route('dashboard.aboutdiscription.index')}}">О описании</a></li>
                            <li><a href="{{route('dashboard.about.index')}}">О компании</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="{{route('dashboard.homeselect.index')}}" class="nav-link menu-title link-nav" >
                            <i data-feather="file-text"></i><span>Главная Выберите</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{route('dashboard.feedback.index')}}"><i data-feather="file-text"></i>
                            <span>Обратная связь</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{route('dashboard.words.index')}}"><i data-feather="file-text"></i>
                            <span>Словарь</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>