$(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});

$.ajaxSetup({
    headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

$(document).ready(function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;

        if (input.length) {
            input.val(log);
        } else {
            if (log) alert(log);
        }
    });

    $('.edit-message').on('click', function(){
        // ALERT!!! password salah tetap dibaca true
        // Tombol EDIT tidak berfungsi saat auth/login karena password tidak ditentukan
        $('#formEdit')[0].reset();
        const id = $(this).data('id');
        let password = $('#inputPassword'+id).val();

        password = (password === "") ? null : ((isNaN(password) || (password.length < 4)) ? null : password);

        const modal = $('.modal');
        password === null ? modal.removeAttr('id') : modal.attr('id','editModal');

        $.ajax({
            url: 'password-validation',
            data: {
                id: id,
                password: password
            },
            method: 'post',
            success: (response) => {
                // console.log(response);
                $('#idEdit').val(response[0].id);
                $('#nameEdit').val(response[0].name);
                $('#titleEdit').val(response[0].title);
                $('#bodyEdit').val(response[0].body);
                $('#imageDisplay').attr('src',response[0].image_path ? 'storage/images/'+(response[0].image_path).split('/')[2] : null);
                $('#imageNameEdit').val(response[0].image_name ? response[0].image_name : null);
            },
            error: (response) => {
                console.log("err: ",response);
            }
        });
    });

    $('#formEdit').submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
           method:'post',
           url: 'message/update',
           data: formData,
           contentType: false,
           processData: false,
           cache: false,
           success: (response) => {
                $('#alertStatus').text('Success to updated message!');
                $('#updateAlert').addClass('alert-success');
                $('#updateAlert').css('display','block');
                setTimeout(()=>location.reload(),2000);
            },
            error: (response) => {
                $('#alertStatus').text('Failed to update message.');
                $('#alertMessage').text('Fill the form input correctly!');
                $('#updateAlert').addClass('alert-danger');
                $('#updateAlert').css('display','block');
                $('#updateAlert').fadeTo(3000, 500).fadeOut();
            }
        });
    });

    $('.delete-message').on('click', function(){
        const id = $(this).data('id');

        $.ajax({
            url: 'message/get',
            data: {id:id},
            method: 'post',
            success: function(data){
                $('#idDelete').val(data.id);
            }
        });
    });

    $('#rowAlert').fadeTo(3000, 500).fadeOut();
});
