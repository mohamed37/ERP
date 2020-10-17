@php
$route='employees';
$breadcrumb = 'employeeindex';

@endphp
 <table class="table">
                 @if($employees->count() > 0)
                        <tbody id="cont-data">

                            @foreach($employees as $index=>$employee)
                            <tr id="{{ $employee->id }}">
                                <td class="sorting_1">{{ $index+1 }}</td>
                                <td>{{$employee->name}}</td>
                                <td>{{$employee->age}}</td>
                                <td>{{$employee->idcard}}</td>
                                <td><?php 
                                        if($employee->profession==1) echo __('site.worker');
                                        elseif($employee->profession==2) echo __('site.marketer');
                                        else
                                            echo __('site.supplier');
                                        ?></td>
                                <td>
                                    <a href="{{ route($route.'.edit',[$employee->id]) }}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <button type="button" class="btn btn-danger btn-xs" ; data-toggle="modal" data-target="#del_employee{{$employee->id}}"><span class="glyphicon glyphicon-trash"></span></button>

                                    <!-- Modal -->
                                    <div id="del_employee{{$employee->id}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">

                                                <form action="{{ route($route.'.destroy', [$employee->id]) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}



                                                    <div class="modal-body">
                                                        <h4>@lang('site.confirm_delete') </h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-info" data-dismiss="modal">@lang('site.no')</button>
                                                        <input type="submit" value="@lang('site.yes')" class="btn btn-primary">
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                        @else
                        <h2> <i class="fa fa-frown-o"></i> @lang('site.sorry_not_found_data')</h2>
                        @endif

                        {{ $employees->links() }}
                    </table>