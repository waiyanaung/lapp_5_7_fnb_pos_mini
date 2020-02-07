@extends('layouts.master')
@section('title','Room')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($page) ? trans('setup_page.title-edit') : trans('setup_page.title-entry') }}</h1>

    @if(isset($page))
        {!! Form::open(array('url' => '/backend_app/page/update','id'=>'page', 'class'=> 'form-horizontal user-form-border')) !!}

    @else
        {!! Form::open(array('url' => '/backend_app/page/store','id'=>'page', 'class'=> 'form-horizontal user-form-border')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($page)? $page->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="name">
                {{trans('setup_page.name')}}
                <span class="require">*</span>
            </label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 multi_name">
            @if(isset($page) && count($page) > 0)
                <input type="text" class="form-control" name="page_name" class="multi" placeholder="{{trans('setup_page.place-name')}}"
                       value="{{isset($page)?$page->name:Request::old('page_name')}}"/>
            @else
                <input type="text" class="form-control" name="page_name" class="multi" placeholder="{{trans('setup_page.place-name')}}"
                       value="{{ Request::old('page_name') }}"/>
            @endif
            <p class="text-danger">{{$errors->first('page_name')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="content">{{trans('setup_page.content')}}</label>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
            <textarea id="summernote" name="content">{{ isset($page)?$page->content:'' }}</textarea>
            <p class="text-danger">{{$errors->first('content')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($page)? trans('setup_page.btn-update') : trans('setup_page.btn-add')}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="{{trans('setup_room.btn-cancel')}}" class="form-control cancel_btn" onclick="cancel_setup('room')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
    <script type="text/javascript">
        $(document).ready(function(){
            //Start Validation for Entry and Edit Form

            $('#room').validate({
                rules: {
                    'page_name'            : 'required',
                    'content'              : 'required',
                },
                messages: {
                    'page_name'           : 'Page Name is required!',
                    'content'             : 'Content is required!',
                },
                submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
                }
            });

            //End Validation for Entry and Edit Form

            $('#summernote').summernote({
                height: 300,

                toolbar: [
                    ['style', ['style']],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['picture', ['picture']],
                    ['link', ['link']],
                    ['table', ['table']],
                    ['hr', ['hr']],
                    ['codeview', ['codeview']],
                    ['undo', ['undo']],
                    ['redo', ['redo']],
                ],
            });
        });
    </script>
@stop