@extends('layouts.master')
@section('title','Permission')
@section('content')
<!-- <h1 class="page-header">{{isset($permission) ?  __('setup_permission.title-edit') : __('setup_permission.title-entry') }}</h1> -->
<h1>{{isset($permission) ?'Permission Edit':'Permission Entry'}}</h1>
    @if(isset($permission))
        {!! Form::open(array('url' => 'backend_app/permission/update', 'class'=> 'form-horizontal user-form-border')) !!}
    @else
        {!! Form::open(array('url' => 'backend_app/permission/store', 'class'=> 'form-horizontal user-form-border')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($permission)? $permission->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <!-- <label for="name">{{__('setup_permission.name')}}<span class="require">*</span></label> -->
            <label for="name">Name<span class="require">*</span></label>

        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="name" name="name" placeholder="Enter Permission Name" value="{{ isset($permission)? $permission->name:Request::old('name') }}"/>
            <p class="text-danger">{{$errors->first('name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <!-- <label for="module">{{__('setup_permission.mod')}}<span class="require">*</span></label> -->
            <label for="module">Module<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="module" name="module" placeholder="Enter Module" value="{{ isset($permission)? $permission->module:Request::old('module') }}"/>
            <p class="text-danger">{{$errors->first('module')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <!-- <label for="url">{{__('setup_permission.url')}}</label> -->
            <label for="url">URL</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="url" name="url" placeholder="Enter Url" value="{{ isset($permission)? $permission->url:Request::old('url') }}"/>
            <p class="text-danger">{{$errors->first('url')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="url">Menu Group</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($permission))
            <select class="form-control" name="permission_group_id" id="permission_group_id">
              <option value="" selected disabled>Select Menu Group</option>
              <option value="">None</option>
              @foreach($permission_groups as $permission_group)
                  @if($permission->permission_group_id == $permission_group->id)
                  <option value="{{$permission_group->id}}" selected>{{$permission_group->name}}</option>
                  @else
                  <option value="{{$permission_group->id}}">{{$permission_group->name}}</option>
                  @endif
              @endforeach
            </select>
            @else
            <select class="form-control" name="permission_group_id" id="permission_group_id">
              <option value="" selected disabled>Select Menu Group</option>
              <option value="">None</option>
              @foreach($permission_groups as $permission_group)
                  <option value="{{$permission_group->id}}">{{$permission_group->name}}</option>
              @endforeach
            </select>
            @endif
            <p class="text-danger">{{$errors->first('url')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <!-- <label for="description">{{__('setup_permission.desc')}}</label> -->
            <label for="description">Description</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <!-- <input type="text" class="form-control" id="description" name="description" placeholder="Enter Role Description" value="{{ isset($permission)? $permission->description:Request::old('description') }}"/>
            <p class="text-danger">{{$errors->first('description')}}</p> -->
            <textarea rows="4" cols="50"class="form-control" id="description" name="description" placeholder="Enter Description">{{ isset($permission)? $permission->description:Request::old('description') }}</textarea>
            <p class="text-danger">{{$errors->first('description')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <!-- <input type="submit" name="submit" value="{{isset($permission)? __('setup_permission.btn-update') : __('setup_permission.btn-add')}}" class="form-control btn-primary"> -->
            <input type="submit" name="submit" value="{{isset($permission)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <!-- <input type="button" value="{{__('setup_permission.btn-cancel')}}" class="form-control cancel_btn" onclick="cancel_setup('permission')"> -->
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('permission')">
        </div>
    </div>
    {!! Form::close() !!}
@stop