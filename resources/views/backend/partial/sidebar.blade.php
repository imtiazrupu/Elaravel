<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->first_name}} {{Auth::user()->last_name}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            @if(Request::is('admin*'))
            <li class="{{Request::is('admin/dashboard')? 'active' : ''}}">
                <a href="{{route('admin.dashboard')}}">
                    <i class="fa fa-home "></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="{{Request::is('admin/category*')? 'active' : ''}}">
                 <a href="{{route('admin.category.index')}}">
                    <i class="fa fa-user"></i>
                    <span>Category</span>
                 </a>
            </li>

            <li class="{{Request::is('admin/subcategory*')? 'active' : ''}}">
                <a href="{{route('admin.subcategory.index')}}">
                    <i class="fa fa-book "></i>
                   <span>SubCategory</span>
                </a>
           </li>

           <li class="{{Request::is('admin/product*')? 'active' : ''}}">
            <a href="{{route('admin.product.index')}}">
                <i class="fa fa-shopping-cart"></i>
               <span>Product</span>
            </a>
           </li>

           <li class="{{Request::is('admin/slide*')? 'active' : ''}}">
            <a href="{{route('admin.slide.index')}}">
                <i class="fa fa-shopping-cart"></i>
               <span>Slide</span>
            </a>
           </li>

           <li class="header">SYSTEM</li>

           <li>
               <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                  <i class="fa fa-users"></i><span>Log Out</span>
               </a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
               </form>

           </li>
            @endif
          </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
