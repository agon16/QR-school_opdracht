$(document).ready(function () {
  var trigger = $('.hamburger'),
      overlay = $('.overlay'),
     isClosed = false;

    trigger.click(function () {
      hamburger_cross();      
    });

    function hamburger_cross() {

      if (isClosed == true) {          
        overlay.hide();
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        isClosed = false;
      } else {   
        overlay.show();
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        isClosed = true;
      }
  }
  
  $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
  });

  //Initialize QR Scanner
  $('#scan_init').click(function() {
    $('#scanner').html5_qrcode(function(qrData) {
        // console.log(qrData);
        $.post('backend/api.php', {id: qrData}, function(data) {
          data = JSON.parse(data);
          if(data.result == "true") {
            $('[name="username"]').val(data.username);
            $('[name="username"]').attr('type', 'password');

            $('[data-dismiss="modal"]').click(); //Close modal if QR-Code successfully validated
            $('#scanner').html5_qrcode_stop(); //Stop/Halt the scanner
          }
        });
      },
      function(error){
        console.log('Error: '+error);
      }, function(videoError){
        console.log("Video error: "+videoError);
        $('#videoError').html('<div class="alert alert-danger" role="alert">'
                  +'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>'
                  +'<span class="sr-only">Error:</span>'
                  +'Er is een fout opgetreden met het scannen van uw QR-Code'
                +'</div>')
      }
    );
  });

  var qrUploadTriggerIndex = 0;

  //Trigger upload
  $('#qr_upload').click(function() {
    //Validate if Upload button has been pressed twice
    if(qrUploadTriggerIndex == 1) {
      $('[name="submit"]').click();
    }

    $('[name="qr_image"]').attr('style', ''); //Show the browse button
    $('#spacer').attr('style', ''); //Unhide breaks
    qrUploadTriggerIndex = 1;
  });

});
