
@extends('Dashboard.layout.index')

@php 

 $route = 'users';
 $breadcrumb = 'showuser';
@endphp

@section('content')
<div class="box-header">
  <h3 class="box-title">
   <i class="fa fa-user-secret"></i>   @lang('site.profile') 
  </h3>
</div>
<!-- /.box-header -->

<div class="box-body">
 
  <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
  
    <div class="row">
     <div class="col-sm-12">
      <div class="box box-widget widget-user">
        
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-black" style="background: url({{ asset('uploads/photo1.png') }}) center center;">
          <h3 class="widget-user-username">{{ strtoupper($user->name) }}</h3>
        
        </div>
        
        <div class="widget-user-image">
          <img class="img-circle" src="{{ asset($user->image_path) }}" alt="User Avatar">
        </div>
        
        <div class="box-footer">
          <div class="row">
            <div class="col-sm-6 border-right">
              <div class="description-block">
                <h3 class="description-text">@lang('site.role')</h3>
                @foreach($user->roles as $role)
                <h5 class="widget-user-desc">{{strtoupper($role->name)}}</h5>
                @endforeach
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-6 border-right">
              <div class="description-block">
              <br>
                <h3 class="description-header">@lang('site.email')</h3>
                <br>
                <span class="description-text">{{ strtoupper($user->email) }}</span>
              </div>
              <!-- /.description-block -->
            </div>
          
          </div>
          <!-- /.row -->
        </div>
      </div>
        
    </div>
  </div>


</div>

</div>
<!-- /.box-body -->

@endsection