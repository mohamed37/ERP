
 
 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
     
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     
     
   <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p></p>
          <a href="#"><i class="fa fa-circle text-success"></i> </a>
        </div>
      </div>
      
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="">
          <span class="input-group-btn">
                <button type="submit" name="search"  class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li class="header">@lang('site.MAIN NAVIGATION')</li>
        
        <li class="{{ is_active('Dashboard') }} ">
          <a href="{{ route('dashboardHome') }}">
            <i class="fa fa-dashboard"></i> <span>@lang('site.dashboard')</span>
          </a> 
        </li>
          
          <li class="treeview {{ is_active('revisions') }}">
          <a href="#">
            <i class="fa fa-bookmark-o"></i>
            <span>@lang('site.workers')</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="{{route('employees.index')}}"><i class="fa fa-circle-o"></i> @lang('site.index')</a></li>
          
            <li><a href="{{route('employees.create')}}"><i class="fa fa-circle-o"></i> @lang('site.create') </a></li>
            
          </ul>
          
        </li>
     
        <li class="treeview {{ is_active('revisions') }}">
          <a href="#">
            <i class="fa fa-bookmark-o"></i>
            <span>@lang('site.revisions')</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                <small class="label pull-right bg-yellow">New</small>
              </span>
          </a>
          <ul class="treeview-menu">

            <li><a href=""><i class="fa fa-circle-o"></i> @lang('site.index')</a></li>
          
            <li><a href=""><i class="fa fa-circle-o"></i> @lang('site.create') </a></li>
            
          </ul>
          
        </li>
  
        
    
   
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
          </ul>
        </li>
        
      </ul>
      
    
   
   </section>
   <!-- /.sidebar -->
  </aside>
   
  