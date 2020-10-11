
@extends('Dashboard.layout.index')

@php 

$breadcrumb = 'dashboard';

@endphp

@section('content')

<div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{ $users->total() }}</h3>

          <p>@lang('site.users')</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
        @if(Auth::user()->haspermission('read-users'))
         <a href="{{ route('users.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        @endif
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ $categories->total() }}<sup style="font-size: 20px">%</sup></h3>

          <p>@lang('site.categories')</p>
        </div>
        <div class="icon">
          <i class="fa fa-th-large"></i>
        </div>
        @if(Auth::user()->haspermission('read-categories'))
         <a href="{{ route('categories.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        @endif
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ $courses->total() }}</h3>

          <p>@lang('site.courses')</p>
        </div>
        <div class="icon">
          <i class="fa fa-book"></i>
        </div>
        @if(Auth::user()->haspermission('read-courses'))
         <a href="{{ route('courses.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        @endif
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{ $revisions->total() }}</h3>

          <p>@lang('site.revisions')</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        @if(Auth::user()->haspermission('read-revisions'))
        <a href="{{ route('revisions.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
       @endif
      </div>
    </div>
    <!-- ./col -->
    
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{ $asks->total() }}</h3>
  
            <p>@lang('site.asks')</p>
          </div>
          <div class="icon">
            <i class="fa fa-question-circle-o"></i>
          </div>
          @if(Auth::user()->haspermission('read-asks'))
          <a href="{{ route('asks.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
         @endif
        </div>
      </div>
      <!-- ./col -->
      
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $students->total() }}</h3>
    
              <p>@lang('site.students')</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            @if(Auth::user()->haspermission('read-students'))
            <a href="{{ route('students.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
           @endif
          </div>
        </div>
        <!-- ./col -->
        
         
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>{{ $exams->total() }}</h3>
    
              <p>@lang('site.exams')</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            @if(Auth::user()->haspermission('read-exams'))
            <a href="{{ route('exams.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
           @endif
          </div>
        </div>
        <!-- ./col -->
</div>

@endsection