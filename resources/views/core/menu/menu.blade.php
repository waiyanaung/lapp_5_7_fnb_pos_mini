@extends('layouts.master')
@section('title','Permission')
@section('content')

    <!-- <h1 class="page-header">{{isset($menu) ?  __('setup_menu.title-edit') : __('setup_menu.title-entry') }}</h1> -->
    <h1>{{isset($menu)? 'Menu Edit':'Menu Entry'}}</h1>

    @if(isset($menu))
        {!! Form::open(array('url' => 'backend_app/menu/update', 'class'=> 'form-horizontal')) !!}

    @else
        {!! Form::open(array('url' => 'backend_app/menu/store', 'class'=> 'form-horizontal')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($menu)? $menu->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <!-- <label for="name">{{__('setup_menu.name')}}<span class="require">*</span></label> -->
            <label for="name">Name<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="name" name="name" placeholder="Enter Permission Name" value="{{ isset($menu)? $menu->name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <!-- <label for="module">{{__('setup_menu.level')}}<span class="require">*</span></label> -->
            <label for="module">Level<span class="require">*</span></label>

        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($menu))
            <select class="form-control" name="level" id="level">
                @if($menu->level == 1)
                <option value="{{$menu->level}}" selected>{{$menu->level}}</option>
                <option value="2">2</option>
                @else
                <option value="1">1</option>
                <option value="{{$menu->level}}" selected>{{$menu->level}}</option>
                @endif
            </select>
            @else
            <select class="form-control" name="level" id="level">
                <option value="" selected disabled>Select Level</option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
            @endif

            <p class="text-danger">{{$errors->first('level')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="group_code">Group Code</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="group_code" name="group_code" placeholder="Enter Group Code" value="{{ isset($menu)? $menu->group_code:Request::old('group_code') }}"/>
            <p class="text-danger">{{$errors->first('group_code')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <!-- <input type="submit" name="submit" value="{{isset($menu)? __('setup_menu.btn-update') : __('setup_menu.btn-add')}}" class="form-control btn-primary"> -->
            <input type="submit" value="{{isset($menu)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">

        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <!-- <input type="button" value="{{__('setup_menu.btn-cancel')}}" class="form-control cancel_btn" onclick="cancel_setup('menu')"> -->
            <input type="button" value="CANCEL" class="form-control" onclick="cancel_setup('menu')">

        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop
