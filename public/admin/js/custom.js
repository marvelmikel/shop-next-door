$(document).ready(function() {
    // check Admin password is correct or not
    $('#current_password').keyup(function() {
      var current_password = $('#current_password').val();
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        type: 'POST',
        url: '/admin/check-admin-password',
        data: { current_password: current_password },
        success: function(resp) {
          if (resp === 'true') {
            $('#check_password').html(
              '<font style="color:green">Current Password is Correct!</font>'
            );
          } else if (resp === 'false') {
            $('#check_password').html(
              '<font style="color:red">Current Password is Incorrect!</font>'
            );
          }
        },
        error: function(error) {
          console.error(error);
          alert('Error');
        },
      });
    });
  });
