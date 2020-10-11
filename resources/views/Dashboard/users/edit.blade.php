@extends('Dashboard\Layout\index')

@php 
  
  $route = 'users';
 $breadcrumb = 'edituser';
  
 
@endphp  



@section('content')

<div class="col-xs-12">

  <div class="box box-success">
  
    <div class="box-header">
      <h3 class="box-title"> 
         <i class="fa fa-edit"></i>
         @lang('site.update') @lang('site.user')</h3>
    </div>
    
    <div class="box-body">
      <form action="{{ route($route.'.update',$user->id) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field("PUT") }}
    
        <!-- USERNAME -->
        <div class="form-group">
          <label>@lang('site.name') :</label>

          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-user"></i>
            </div>
    
            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" name="name">

              @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
         
          </div>
          <!-- /.input group -->
        </div>
      <!-- /.form group -->

      <!-- EMAIL-->
      <div class="form-group">
        <label>@lang('site.email') :</label>
      
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-google"></i>
          </div>
          
          <input type="email" class="form-control @error('email') is-invalid @enderror " value="{{ $user->email }}" name="email">

          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
    
    
        </div>
        <!-- /.input group -->
      </div>
      <!-- /.form group -->



      <!-- PASSWORD  -->
      <div class="form-group">
        <label>@lang('site.password') :</label>

        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-eye-slash show-pass"></i>
          </div>
            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"  name="password" minlength="8">

            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror

         </div>
        <!-- /.input group -->
      </div>
      <!-- /.form group -->


      <!-- ROLE -->
      <div class="form-group">
        
        <label>@lang('site.role') :</label>

        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-laptop"></i>
          </div>
          
          <select class="form-control @error('role') is-invalid @enderror" name="role">
          @php 
            $roles = ['superadministrator', 'administrator', 'user', 'adminuser', 'admincategories', 'admincourses', 'adminasks','adminrevisions'];
          @endphp
              
            @foreach($roles as $role)
              <option value="{{ $role }}" {{$user->hasRole($roles) ? 'selected' : '' }} >{{ $role }}</option>
            @endforeach
            @error('role')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </select>
  
        </div>
        <!-- /.input group -->
      </div>
      
      
        <!-- IMAGE -->
      
        <div class="form-group">
          <label>@lang('site.image') :</label>
 
         <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-picture-o"></i>
          </div>
          
          <div class="col-xs-6">
            
           <input type="file" name="image" class="form-control @error('image') is-invalid @enderror image" value="{{ $user->image }}">
          
          </div>
         
          <div class="col-sm-6">
            <img src="{{asset($user->image_path)}}" class="image-preview" height="120px" width="250px">
          </div>
           
          @error('image')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
         </div>
         
         
        </div>  
                    
      <!-- /.form group -->
      <button type="submit" class="btn btn-success btn-lg create"> 
        <i class="fa fa-save "></i>
        @lang('site.update') @lang('site.data')
      </button>

     </form>
  
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

</div>
@endsection