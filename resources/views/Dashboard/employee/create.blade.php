@extends('Dashboard.layout.index')
@php
$route='employees';
$breadcrumb = 'employeecreate';

@endphp
@section('header')
<style>
    .custom-file {
        background-color: ;
        width: 499px;
        height: 34px;
        border: 1px solid #ccc;
        position: relative;
        z-index: 0;
        border-radius: 10px;
    }

    .custom-file input[type="file"] {
        width: 100%;
        height: 100%;
        z-index: 3;
        position: absolute;
        top: 6px;
        left: 0px;
    }
</style>
@endsection
@section('content')
<div class="col-xs-6">
                <form action="{{ route($route.'.store') }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    
                        <div class="box-header">
                            <h3 class="box-title">
                                <i class="fa fa-user-plus"></i>
                                @lang('site.create') @lang('site.employee')</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->


                        <div class="box-body">
                            <div class="form-group">
                             
                                <label for="name">@lang('site.name') :</label>
                                <input type="text" class="form-control" name="name" placeholder=" @lang('site.name')  ">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="age">@lang('site.age') :</label>
                                <input type="text" name="age" class="form-control @error('age') is-invalid @enderror" placeholder="@lang('site.age')">
                                @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">@lang('site.address') :</label>
                                <input type="text" name="address" class="form-control" placeholder=" @lang('site.address') ">
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="idcard">@lang('site.idcard') :</label>
                                <input type="text" name="idcard" class="form-control @error('idcard') is-invalid @enderror"  placeholder="@lang('site.idcard')">
                                @error('idcard')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="profession">@lang('site.profession') :</label>
                                <select name="profession" class="form-control">
                                    <option value="">@lang('site.choose') @lang('site.status')</option>
                                    <option value="1">@lang('site.worker') </option>
                                    <option value="2">@lang('site.marketer')</option>
                                    <option value="3">@lang('site.supplier') </option>
                                </select>
                                @error('profession')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">@lang('site.cv') :</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="cv" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile"></label>
                                    </div>
                                    @error('cv')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary " value="@lang('site.save') ">
                            </div>
                        </div>
                        <!-- /.card-body -->



                  
                </form>
         
</div>
 

@endsection