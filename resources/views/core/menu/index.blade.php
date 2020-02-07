@extends('layouts.master')
@section('title','Menu')
@section('content')
<!-- <h1 class="page-header">{{__('setup_role.title-list')}}</h1> -->
<h1>Menu List</h1>

<div class="row">
    <div class="col-md-10"></div>
    <div class="col-md-2 pull-right">
        <div class="buttons pull-right">
            <button type="button" onclick='create_setup("menu");' class="btn btn-default btn-md first_btn">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Create
            </button>
            <button type="button" onclick='edit_setup("menu");' class="btn btn-default btn-md second_btn">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Edit
            </button>
            <button type="button" onclick="delete_setup('menu');" class="btn btn-default btn-md third_btn">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Delete
            </button>
        </div>
    </div>
</div>

{!! Form::open(array('id'=> 'frm_menu' ,'url' => '/backend_app/menu/destroy', 'class'=> 'form-horizontal')) !!}
{{ csrf_field() }}
<input type="hidden" id="selected_checkboxes" name="selected_checkboxes" value="">

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="listing">
            <input type="hidden" id="pageSearchedValue" name="pageSearchedValue" value="">
            <table class="table table-striped list-table" id="list-table">

                <thead>
                <tr>
                    <th><input type='checkbox' name='check' id='check_all'/></th>
                    <!--
                    <th>{{__('setup_permission.tb-col-name')}}</th>
                    <th>{{__('setup_permission.tb-col-mod')}}</th>
                    <th>{{__('setup_permission.tb-col-desc')}}</th>
                    <th>{{__('setup_permission.tb-col-url')}}</th>-->
                    <th>Name</th>
                    <th>Level</th>
                    <th>Group Code</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th></th>
                    <th class="search-col" con-id="name">{{__('setup_permission.tb-col-name')}}</th>
                    <th class="search-col" con-id="level">{{__('setup_permission.tb-col-mod')}}</th>
                    <th class="search-col" con-id="group_code">{{__('setup_permission.tb-col-desc')}}</th>
                </tr>
                </tfoot>
                <tbody>
                @foreach($menus as $menu)
                    <tr>
                        <td><input type="checkbox" class="check_source" name="edit_check" value="{{ $menu->id }}" id="all"></td>
                        <td><a href="/backend_app/menu/edit/{{$menu->id}}">{{$menu->name}}</a></td>
                        <td>{{$menu->level}}</td>
                        <td>{{$menu->group_code}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop
