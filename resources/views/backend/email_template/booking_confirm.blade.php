@extends('layouts.master')
@section('title','Room')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{trans('setup_email_template.booking-confirm-edit') }}</h1>
        {!! Form::open(array('url' => '/backend_app/email_template_booking_confirm/update','id'=>'booking-cancel', 'class'=> 'form-horizontal user-form-border')) !!}
    <input type="hidden" name="id" value="{{ $booking->code }}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="content">{{trans('setup_email_template.content')}}</label>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
            <textarea id="summernote" name="description">{{ $booking->description }}</textarea>
            <p class="text-danger">{{$errors->first('content')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{trans('setup_email_template.btn-update') }}" class="form-control btn-primary">
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
                    'content'              : 'required',
                },
                messages: {
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
