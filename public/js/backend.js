$(document).ready(function() {
  $.ajaxSetup({
                headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
   });

    // image preview

    $(".image").change(function() {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.image-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }

    });

    // END of image preview


    /* password show */

    $(".show-pass").hover(function() {

        $(this).removeClass('fa-eye-slash').addClass('fa-eye');

        $('#password').attr("type", "text");

    }, function() {
        $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        $('#password').attr("type", "password");

    });

    /* end password show */




      //___________________START CREATE COUNTRY AND CITY ___________________
            $(document).on('change', '#createCountry', function (e) {
                var country = e.target.value;
                var url = $(this).data('url');
               // alert(url);
               // alert(url+'?country='+country);
               
                 $.ajax({
                  method:'GET',
                  url:url+'?country='+country,
                  data:'',
                  success: function (data) { 
                    
                   $('#createCity').html(data);
                  }, error: function (error, jqXHR, status) {
                        console.log(error);
                     }
                }); 
                
                
            });
      //_____________________END OF CREATE COUNTRY AND CITY_________________



      //___________________START EDIT COUNTRY AND CITY ___________________
      $(document).on('change', '#editCountry', function (e) {
        var country = e.target.value;
        var url = $(this).data('url');
        
         //alert(url +" "+ country +" "+id );
        //alert(url+'?country='+country);
          $.ajax({
          method:'GET',
          url:url+'?country='+country,
          data:'',
          success: function (data) { 
            
           $('#editCity').html(data);
           
          }, error: function (error, jqXHR, status) {
                console.log(error);
             }
        }); 
        
        
    });
//_____________________END OF EDit COUNTRY AND CITY_________________

     // ______________________DELETE BY SWEETALERT______________________


      //___________________START COUNT USER AGE___________________
      $(document).on('keyup', '#birth', function () {

        var value = $(this).val(),

            year = new Date(),

            birth = value.slice(0,4),

            age  = year.getFullYear() - birth;

        if(birth >= year.getFullYear())
        {
            console.log('no');

             $('#erroryear').show(100);

        } else {

         console.log("BIRTH  => " + birth +" " + " YEAR => "+ year.getFullYear() + " AGE => " + age);
         $('#erroryear').hide(100);
         $('input[name=age]').val(age);
        }


    });

   /*END OF COUNT USER AGE */


     // ______________________DELETE BY SWEETALERT______________________

      $(document).on('click', '.delete', function() {


        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed)
        {
            swalWithBootstrapButtons.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
        } else if (result.dismiss === Swal.DismissReason.cancel)
            /* Read more about handling dismissals below */
        {
            swalWithBootstrapButtons.fire(
              'Cancelled',
              'Your imaginary file is safe :)',
              'error'
            )
          }
        })
      });

    // ______________________ END OF DELETE BY SWEETALERT______________________

    // ___________________________CREATE BY SWEET ALERT__________________________________

      $(document).on('click', '.create', function() {
          Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Your work has been saved',
                  showConfirmButton: false,
                  timer: 1500
                  });
      });

    // ___________________________END OF CREATE BY SWEET ALERT__________________________________

    // ___________________________Update BY SWEET ALERT__________________________________

        $(document).on('click', '.update', function() {
                    Swal.fire({
                      title: 'Do you want to update the changes?',
                      showDenyButton: true,
                      showCancelButton: true,
                      confirmButtonText: `Update`,
                      denyButtonText: `Don't Update`,
                    }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                      if (result.isConfirmed) {
                        Swal.fire('Saved!', '', 'success')
                      } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                      }
                    })
        });

    // ___________________________END OF Update BY SWEET ALERT__________________________________



}); // End OF Document

  //duration => timezone [60]

function startTimer(duration) {

  var timer = duration, minutes, seconds; // hour, minutes, seconds
  
  var url = $('#time').data('id');
  // timer show
  
  var interval = setInterval(function () {

      minutes = parseInt(timer / 60);  // 60 / 60   =>  1
      seconds = parseInt(timer % 60); // reminder =>  0
      
      minutes = minutes < 10 ? "0" + minutes : minutes; // newminutes = 1 < 10 true => 01 false => 1
      seconds = seconds < 10 ? "0" + seconds : seconds; // newseconds = 0 < 10 true => 00 false => 0


      //display.textContent = minutes + ":" + seconds; // show in blade

      $('#time').text(minutes + ":" + seconds);

      timer--;

  
      if (timer == 0) 
        {
          
          clearInterval(interval); // stop time
          $('#time').text('Finsih Time');
          
            // when stop time then redirection
            //window.location = url;
             //setTimeout(window.location.href = url,1000); 
          
          timer = 0;
        } 
       
        }, 1000);



}
     // show in blade when  page onload
 window.onload = function () {
  var oneMinutes = 10;
  
$("#time").text(oneMinutes);
  startTimer(oneMinutes);
};
//console.log(startTimer(oneMinutes));
