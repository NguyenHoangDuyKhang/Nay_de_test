<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="?action=dashboard" class="brand-link">
    <img src="https://icon-library.com/images/admin-icon/admin-icon-13.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="https://icon-library.com/images/admin-icon/admin-icon-13.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="http://asm/admin/?action=dashboard" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v1</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Quản lý Sản Phẩm
              <i class="fas fa-angle-left right"></i>

            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?action=oder&add=danhsachsanpham" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh sách sản phẩm</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="?action=oder&add=add-sanpham" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm sản phẩm</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="?action=statistical_tb" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thống kê</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Quản lý Bài Viết
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?action=post&add=danhsachbaiviet" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh sách bài viết</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?action=post&add=add-baiviet" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm bài viết</p>
              </a>
            </li>
          </ul>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Quản lý Người Dùng
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?action=user" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Người Dùng</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?action=add_user" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm Người Dùng</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?action=order_detail" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Đơn Hàng</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?action=comment" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Bình Luận</p>
              </a>
            </li>
          </ul>


          <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Quản lý Mã
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?action=discount" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm Mã</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="?action=danhsach_discount" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh Sách Mã</p>
              </a>
            </li>
          </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
</aside>