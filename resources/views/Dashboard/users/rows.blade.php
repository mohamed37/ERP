
@php 

 $route = 'users';
 $breadcrumb = 'indexuser';
@endphp
<table class="table">

@if($users->count() > 0) 
<tbody id="cont-data" >
 @foreach($users as $index=>$user)
   <tr  id="{{ $user->id }}">
     <td><input type="checkbox" name="usercheck[]" class="form-control-checkbox" value="{{ $user->id }}"></td>  
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
