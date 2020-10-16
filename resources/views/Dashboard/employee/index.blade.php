@extends('Dashboard.layout.index')
@php
$route='employees';
$breadcrumb = 'employeeindex';

@endphp
@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title">@lang('site.indexemployee')</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
                <div class="col-sm-6">
                    <div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select> entries</label></div>
                </div>
                <div class="col-sm-6">
                    <div id="example1_filter" class="dataTables_filter"><label>@lang('site.search')  <input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 177px;">@lang('site.name')</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;">@lang('site.age')</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 206px;">@lang('site.idcard')</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 153px;">@lang('site.profession')</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 113px;">@lang('site.control')</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($employees as $employee)
                            <tr role="row" class="odd">
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

                        {{ $employees->links() }}
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
</div>

@endsection