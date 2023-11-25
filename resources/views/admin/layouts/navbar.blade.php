<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/admin/images/logo-sm.png" alt="" height="22">
                    </span>
            <span class="logo-lg">
                        <img src="assets/admin/images/logo-dark.png" alt="" height="17">
                    </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/admin/images/logo-sm.png" alt="" height="22">
                    </span>
            <span class="logo-lg">
                        <img src="assets/admin/images/logo-light.png" alt="" height="17">
                    </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.home') }}" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Anasayfa</span>
                    </a>
                </li> <!-- end Dashboard Menu -->


                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Kullanıcı İşlemleri</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Kullanıcılar</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.user.index') }}" class="nav-link"> Kullanıcılar</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Depo İşlemleri</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarWarehpuse" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Depo Yönetimi</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarWarehpuse">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.warehouse.index') }}" class="nav-link"> Depolar</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.warehouseShelf.index') }}" class="nav-link"> Raflar</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.shelfGroup.index') }}" class="nav-link"> Grup EKle</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Ürün İşlemleri</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarWarehouseProduct" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Ürün Yönetimi</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarWarehouseProduct">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.product.index') }}" class="nav-link"> Ürünler</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.warehouseShelf.index') }}" class="nav-link"> Stoklar</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.warehouseShelf.index') }}" class="nav-link">Mal Kabul</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.warehouseShelf.index') }}" class="nav-link">Depo Sayım</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Entegrasyon İşlemleri</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.api.index') }}">
                        <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Kargo Entegrasyonu</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.store.index') }}">
                        <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Mağaza Entegrasyonu</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

</div>
