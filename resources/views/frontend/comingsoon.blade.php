@extends('layouts_frontend.master_frontend')
@section('title','Under Development')
@section('content')

</div>
</section>

<section>

    <div class="container">
        <div class="row rounded_div_with_shadow">
            <div class="col-md-12">
                <span><b>Coming Soon !</b></span>
            </div>
        </div>
        <br/>

        <div class="row rounded_div_with_shadow">
            <div div class="col-md-12">
                <span><b>This page is under development</b></span>
            </div>
        </div>

</section>

@stop

@section('page_script')
<script>
    function myFunction() {
        $("#frm_item").submit();
    }
</script>
@stop