
 
 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
     
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     
     
   <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset(auth()->user()->image_path)}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ strtoupper(auth()->user()->name) }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> @lang('auth.online')</a>
        </div>
      </div>
      
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder=@lang("site.search")>
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
       
       @if(Auth::user()->haspermission('read-users')) 
        <li class="treeview  {{ is_active('users') }} ">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>@lang('site.users')</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                <small class="label pull-right bg-green">New</small>
              </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i> @lang('site.index')</a></li>
          
            <li><a href="{{ route('users.create') }}"><i class="fa fa-circle-o"></i> @lang('site.create') </a></li>
            
          </ul>
          
        </li>
       @endif
       
       @if(Auth::user()->haspermission('read-categories')) 
        <li class=" treeview {{is_active('categories')}}" >
         <a href="#">
           <i class="fa fa-th"></i>
           <span>@lang('site.categories')</span>
           <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
               <small class="label pull-right bg-green">New</small>
             </span>
         </a>
         <ul class="treeview-menu ">

           <li><a href="{{ route('categories.index') }}"><i class="fa fa-circle-o"></i> @lang('site.index')</a></li>
         
           <li><a href="{{ route('categories.create') }}"><i class="fa fa-circle-o"></i> @lang('site.create') </a></li>
           
         </ul>
         
        </li>
       @endif
        
       @if(Auth::user()->haspermission('read-courses')) 
        <li class="treeview  {{ is_active('courses') }}">
          <a href="#">
            <i class="fa fa-flag-o"></i>
            <span>@lang('site.courses')</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                <small class="label pull-right bg-yellow">New</small>
              </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="{{ route('courses.index') }}"><i class="fa fa-circle-o"></i> @lang('site.index')</a></li>
          
            <li><a href="{{ route('courses.create') }}"><i class="fa fa-circle-o"></i> @lang('site.create') </a></li>
            
          </ul>
          
        </li>
       @endif
       
       @if(Auth::user()->haspermission('read-asks')) 
        <li class="treeview {{ is_active('asks') }}">
          <a href="#">
            <i class="fa fa-question"></i>
            <span>@lang('site.asks')</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                <small class="label pull-right bg-yellow">New</small>
              </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="{{ route('asks.index') }}"><i class="fa fa-circle-o"></i> @lang('site.index')</a></li>
          
            <li><a href="{{ route('asks.create') }}"><i class="fa fa-circle-o"></i> @lang('site.create') </a></li>
            
          </ul>
          
        </li>
       @endif
        
    
       @if(Auth::user()->haspermission('read-revisions')) 
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

            <li><a href="{{ route('revisions.index') }}"><i class="fa fa-circle-o"></i> @lang('site.index')</a></li>
          
            <li><a href="{{ route('revisions.create') }}"><i class="fa fa-circle-o"></i> @lang('site.create') </a></li>
            
          </ul>
          
        </li>
       @endif
        
    
       @if(Auth::user()->haspermission('read-students')) 
        <li class="treeview {{ is_active('students') }}">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>@lang('site.students')</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                <small class="label pull-right bg-red">New</small>
              </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="{{ route('students.index') }}"><i class="fa fa-circle-o"></i> @lang('site.index')</a></li>
          
            <li><a href="{{ route('students.create') }}"><i class="fa fa-circle-o"></i> @lang('site.create') </a></li>
     
            <li><a href="{{ route('students.trash') }}"><i class="fa fa-recycle"></i> @lang('site.trash') </a></li>
           
             
          </ul>
          
        </li>
       @endif
    
    
    
       @if(Auth::user()->haspermission('read-levels')) 
        <li class="treeview {{ is_active('levels') }}">
          <a href="#">
            <i class="fa fa-level-up"></i>
            <span>@lang('site.levels')</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                <small class="label pull-right bg-red">New</small>
              </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="{{ route('levels.index') }}"><i class="fa fa-circle-o"></i> @lang('site.index')</a></li>
          
            <li><a href="{{ route('levels.create') }}"><i class="fa fa-circle-o"></i> @lang('site.create') </a></li>
      
             
          </ul>
          
        </li>
       @endif
    
    
       @if(Auth::user()->haspermission('read-exams')) 
       <li class="treeview {{ is_active('exams') }}">
         <a href="#">
           <i class="fa fa-book"></i>
           <span>@lang('site.exams')</span>
           <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
               <small class="label pull-right bg-orange">New</small>
             </span>
         </a>
         <ul class="treeview-menu">

           <li><a href="{{ route('exams.index') }}"><i class="fa fa-circle-o"></i> @lang('site.index')</a></li>
         
           <li><a href="{{ route('exams.create') }}"><i class="fa fa-circle-o"></i> @lang('site.create') </a></li>
     
            
         </ul>
         
       </li>
       @endif
       
       @if(Auth::user()->haspermission('read-countries')) 
       <li class="treeview {{ is_active('countries') }}">
         <a href="#">
           <i class="fa fa-book"></i>
           <span>@lang('site.countries')</span>
           <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
               <small class="label pull-right bg-orange">New</small>
             </span>
         </a>
         <ul class="treeview-menu">

           <li><a href="{{ route('countries.index') }}"><i class="fa fa-circle-o"></i> @lang('site.index')</a></li>
         
           <li><a href="{{ route('countries.create') }}"><i class="fa fa-circle-o"></i> @lang('site.create') </a></li>
     
            
         </ul>
         
       </li>
       @endif
       
       
       @if(Auth::user()->haspermission('read-cities')) 
       <li class="treeview {{ is_active('cities') }}">
         <a href="#">
           <i class="fa fa-book"></i>
           <span>@lang('site.cities')</span>
           <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
               <small class="label pull-right bg-orange">New</small>
             </span>
         </a>
         <ul class="treeview-menu">

           <li><a href="{{ route('cities.index') }}"><i class="fa fa-circle-o"></i> @lang('site.index')</a></li>
         
           <li><a href="{{ route('cities.create') }}"><i class="fa fa-circle-o"></i> @lang('site.create') </a></li>
     
            
         </ul>
         
       </li>
       @endif
   
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
   
  