

<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>@lang('site.version')</b> 2.4.18
    </div>
    <strong>@lang('site.copyright') &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong>  @lang('site.rights')
  </footer>

  
<!-- jQuery 3 -->
<script src="{{ asset('js/bower_components/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('js/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('js/bower_components/bootstrap/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('js/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{ asset('js/bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('js/bower_components/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{ asset('js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{ asset('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('js/bower_components/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('js/bower_components/moment/moment.min.js')}}"></script>
<script src="{{ asset('js/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{ asset('js/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('js/plugins/bs-custom-file-input.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{ asset('js/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('js/bower_components/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/dist/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('js/dist/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('js/dist/demo.js')}}"></script>

<script src="{{ asset('js/backend.js')}}"></script>

 {{--ckeditor standard--}}
 <script src="{{ asset('js/plugins/ckeditor/ckeditor.js') }}"></script>

{{-- SWEET ALERT --}}
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 -->
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

 <script src="{{asset('js/sweetalert/sweetalert2.js') }}"></script>
 <script src="{{asset('js/sweetalert/sweetalert2.all.min.js') }}"></script>
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
<script>
    

$(document).ready(function() {

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


   // ________________SEARCH BY AJAX_________________
  
     $('input[name=search]').keyup(function() {
      var search = $(this).val(),
          url    = $(this).data('route');

          //alert(url);
  
      $.ajax({
        url:url,
        method:"get",
        data: {search:search},
        success: function(data)
        {
           // data = data.data;
          // console.log(typeof(data));
          //data = JSON.parse(data.data);
           console.log(data);
           //alert(data);
          $('#cont-data').html(data);
          
        },
        error: function (err,status,jqXHR) { alert(err, status, jqXHR);
                                             }
      }); 
      
      

    });  
   // ________________END OF SEARCH BY AJAX_________________
   
   // ________________MULTIPLEDELETE BY AJAX_________________
      
      $(document).on('click', '#multidelete', function () { 
                var ids = [];
                var form = $(this).parent();
                
                $('#cont-data :checkbox:checked').each(function(i){
                  
                    ids[i] = $(this).val();   
                });
                
                $('#multi-ID').val(ids);
                
                 // confirm convert alertSweet when am create composer update
                
                if (confirm('Are You Sure Delete These ?' )) {
                        form.submit();
                        
                        //alert("OK", "Your ", "success");
                        
                    } else {
                        alert("Cancelled", "Your imaginary file is safe", "error");
                    }
                //alert(form);
                
                
                                   
                                         
      });
      
      //____________________________END OF MULTIDELETE_______________________________
           
     
     

  CKEDITOR.config.language = "{{ app()->getLocale() }}";
  
}); //end of document
</script>

@yield('script')

</body>
</html>
