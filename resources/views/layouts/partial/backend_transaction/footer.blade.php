            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                <!-- All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>. -->
                All Rights Reserved by Digital Order. <br>
                 Developed by <a href="http://digitaltreemyanmar.com">Digital Tree Myanmar</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    
            
@yield('page_script_footer')
    

</body>

<!-- my css and js file-->
<script src="/backend/mine/js/crud.js"></script>

<script type="text/javascript">
     $(document).ready(function() {
            $('.text-area').summernote({
                height:300,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['style']],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ["fontname", ["fontname"]],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['picture', ['picture']],
                    ['link', ['link']],
                    ['table', ['table']],
                    ['hr', ['hr']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                    ['undo', ['undo']],
                    ['redo', ['redo']],
                    ["style", ["style"]],
                    
                
//                ['help', ['help']],
              ],
              placeholder: 'Enter text here...'
            });
        });

        // For the store, update sccess and fail flash messsage to show mostly at index.blade.php
        //Where fadeTo parameters are fadeTo(speed, opacity)
        $(".alert").delay(6000).fadeTo(100, 500).slideUp(500, function(){
            $(this).alert('close');
        });
</script>

</html>