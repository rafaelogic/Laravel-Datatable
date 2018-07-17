$(function() {
  'use strict'

  $(document).on('click', '[id^=edit-user]', function(){
    var id = $(this).data('id');
    var name = $(this).data('name');
    var email = $(this).data('email');
    
    $('#edit').modal('show');
    $('.modal-title').html(`Edit ${name}`);
    $('input#id').val(id);
    $('input#name').val(name);
    $('input#email').val(email);
  });

  $('#save-edit').on('click', function(e){
    e.preventDefault();
    var id = $('input#id').val();
    var name = $('input#name').val();
    var email = $('input#email').val();
    var token = $(this).data('token');

    $.ajax({
      url: '/edit',
      type: 'POST',
      data:{
        _token:token, id:id, name:name, email:email
      }
    })
    .done(function(){
      var table = $('#users-table').DataTable();
      table.ajax.reload(null, false);
      
      $('#edit').modal('hide');
      // $('.modal-title').html();
      // $('input#id').val();
      // $('input#name').val();
      // $('input#email').val();
    });

    
  });
  
  
});