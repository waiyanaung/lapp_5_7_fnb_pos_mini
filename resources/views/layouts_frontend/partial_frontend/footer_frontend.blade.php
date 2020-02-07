<?php
$terms_and_condition_text    = \App\Core\Utility::getTermsAndCondition();
//$terms_and_condition_text    = "testing";
?>
<hr>
<section id="footer_section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="titles">
                    <!-- <p>{!! $terms_and_condition_text !!}</p> -->
                    <p><a class="font_white" href="/terms_and_conditions">Terms and conditions</a></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="title">

                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="title">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                    <i class="fa fa-youtube fa-stack-1x"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                    <i class="fa fa-instagram fa-stack-1x"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <div>
                                <span class="fa-stack fa-lg">
                                    <a href="https://www.facebook.com/digitaltreemyanmar">
                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x"></i>
                                    </a>
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.section -->
<hr>


<!-- Footer -->
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p>Copyright © <?php echo date("Y"); ?> Digital Order. All Right Reserved.<br>
                <span class="footer_font_small">Developed by </span> <a class="footer_font_small" href="http://digitaltreemyanmar.com">Digital Tree Myanmar</a>
                <a href="#" class="scrollToTop btn btn-icon btn-circle"><i class="fa fa-angle-double-up"></i></a>
                </p>
            </div>
        </div>
    </div>
</footer>

<script>
    $(document).ready(function() {
        //for scroll to top
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('.scrollToTop').fadeIn();
            } else {
                $('.scrollToTop').fadeOut();
            }
        });

        //Click event to scroll to top
        $('.scrollToTop').click(function() {
            $('html, body').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        // $(".session-alert-message").fadeTo(2000, 500).slideUp(500, function(){
        //         $(".session-alert-message").slideUp(500);
        //     });

    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name=_token]').attr('content')
        }
    });
</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html> 