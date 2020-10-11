
@extends('Dashboard.layout.index')

@php 

 $route = 'users';
 $breadcrumb = 'indexuser';
@endphp

@section('content')
<div class="box-header">
  <h3 class="box-title">
   <i class="fa fa-users"></i>   @lang('site.table')  @lang('site.users')
  </h3>
</div>
<!-- /.box-header -->

<div class="box-body">
 
  <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
  
   <div class="row">
     <div class="col-sm-4">         
        <!-- search form -->
        
          <div class="input-group">
          
            <input type="text" 
            name="search" 
            class="form-control" 
             value="{{request()->search}}" 
             placeholder=@lang("site.search")
             data-route="{{ route('rows') }}">
          
          </div>
        
        <!-- /.search form -->
                  
     </div>
     
     <div class="col-sm-2">
      @if(auth()->user()->haspermission('create-users'))
        <a href="{{ route($route.'.create') }}" class="btn btn-primary">
          <i class= 'fa fa-user-plus'></i> @lang('site.create')</a>
      @endif   
     </div>
    
    
     <div class="col-sm-2">
      @if(auth()->user()->haspermission('delete-users'))
       <form action="{{ route('multidelete') }}" method="get" >
         {{ csrf_field() }}
         {{ method_field('delete') }}
         
         <input type="hidden" name="ids" id="multi-ID" value="">
         
         <button type="submit" class="btn btn-danger" id="multidelete">
          <i class= 'fa fa-trash-o'></i> @lang('site.multiDelete')
           
         </button>
       </form>
      
      
          
      @endif   
     </div>
    
     
   </div>
  
    <br>
      
    <div class="row">
     <div class="col-sm-12">
      
         
      <table id="table" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
           <thead>
            <tr role="row">
              <th>
                 @lang('site.multiDelete')
                
              </th>
              <th> @lang('site.number')</th>
              <th>@lang('site.name')</th>
              <th>@lang('site.image')</th>
              <th>@lang('site.email')</th>
              <th>@lang('site.role')</th>
              <th>@lang('site.control')</th>
            </tr>
           </thead>
          @if($users->count() > 0) 
           <tbody id="cont-data" >
            @foreach($users as $index=>$user)
              <tr  id="{{ $user->id }}">
              
                <td><input type="checkbox" name="multidelete[]" id="check" class="form-control-checkbox" value="{{ $user->id }}"></td>  
              
                <td class="sorting_1">{{ $index+1 }}</td>
                <td>{{ $user->name }}</td>
                <td><img src='{{asset($user->image_path)}}' class="photo-user"></td>
                <td>{{ $user->email }}</td>
                @foreach($user->roles as $role)
                 <td class="btn btn-dropbox">{{strtoupper($role->name) }}</td>
                @endforeach
                <td>
                  <div class="row">
                  
                    @if(Auth::user()->haspermission('update-users'))
                    <div class="col-xs-3">
                      <a href="{{ route($route.'.edit',[$user->id]) }}" class="btn btn-warning">
                        <i class="fa fa-edit"></i> @lang('site.edit') 
                      </a>   
                  
                      </div>
                    @endif
                    
                    @if(Auth::user()->haspermission('read-users'))
                    <div class="col-xs-3">
                      <a href="{{ route($route.'.show',[$user->id]) }}" class="btn btn-success">
                        <i class="fa fa-user"></i> @lang('site.show') 
                      </a>   
                  
                      </div>
                    @endif
                
                    @if(Auth::user()->haspermission('delete-users'))
                
                    <div class="col-xs-3">
                      <form action="{{ route($route.'.destroy', [$user->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                      
                        <button type="submit" class="btn btn-danger delete">
                          <i class="fa fa-trash-o"></i> @lang('site.delete')
                        </button>
                      </form>
                    
                    </div>
                    @endif 
                  </div>
               </td>
              </tr>
            @endforeach 
           </tbody>
       
           @else
            <h2> <i class="fa fa-frown-o"></i> @lang('site.sorry_not_found_data')</h2> 
           @endif 
      </table>
      
      {!! $users->appends(request()->query())->links() !!}

    </div>
  
  </div>


</div>


<!-- /.box-body -->

@endsection
