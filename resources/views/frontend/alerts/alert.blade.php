@if (Session::has('message'))

    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success session-alert-message">
                <strong>Success!</strong> <br>
                <p>{{Session::get('message')}}</p>
            </div>
        </div>
    </div>

@elseif (Session::has('error'))

    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger session-alert-message" role="alert">
                <strong>Error !</strong> 
                <p>{{Session::get('error')}}</p>
            </div>
        </div>
    </div>

@endif

<script type="text/javascript" language="javascript" class="init">
    // for Success / Error Alert Message Animation 
    
        $(document).ready(function() {
            $(".session-alert-message").fadeTo(4000, 500).slideUp(500, function(){
                $(".session-alert-message").slideUp(500);
            }); 
        });
</script>