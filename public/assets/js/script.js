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

    $('.editMessage').on('click', function(){
        // bermasalah pada bagian update, pembacaan input password tidak sesuai sehingga ID dan password selalu tidak match
        const id = $(this).data('id');
        const password = $('#inputPassword2').val();
        // console.log("password: ",password);
        // console.log("id: ",id);
        // $('.formPassword').map(i => console.log($('.formPassword')[i]));

        $.ajax({
            url: 'password-validation',
            data: {
                id: id,
                password: password
            },
            method: 'post',
            success: (response) => {
                if (response.length > 0) {
                    // console.log("resp if: ", response);
                    $('#idEdit').val(response[0].id);
                    $('#nameEdit').val(response[0].name);
                    $('#titleEdit').val(response[0].title);
                    $('#bodyEdit').val(response[0].body);
                    $('#imageDisplay').attr('src',response[0].image_path ? 'storage/images/'+(response[0].image_path).split('/')[2] : null);
                    $('#imageNameEdit').val(response[0].image_name ? response[0].image_name : null);
                } else {
                    console.log("resp else: ", response);
                    $('.modal').modal('hide');
                }

                // $.ajax({
                //     url: 'message/get-message',
                //     data: {id:id},
                //     method: 'post',
                //     success: function(data){
                //         $('#idEdit').val(data.id);
                //         $('#nameEdit').val(data.name);
                //         $('#titleEdit').val(data.title);
                //         $('#bodyEdit').val(data.body);
                //         $('#imageDisplay').attr('src',data.image_path ? 'storage/images/'+(data.image_path).split('/')[2] : null);
                //         $('#imageNameEdit').val(data.image_name ? data.image_name : null);
                //         $('#passwordEdit').val(data.pass);
                //     }
                // });
            },
            error: (response) => {
                // $('.modal').modal('hide');
                console.log("response: ",response);
            }
        });

        // $('.formPassword').map(i => $('.formPassword')[i].reset());
    });

    $('#formEdit').submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
           method:'post',
           url: 'edit-message',
           data: formData,
           contentType: false,
           processData: false,
           success: (response) => {
               response ? location.reload() : null;
            },
            error: (response) => {
                // console.log("err: ",response);
                alert("Fill the form input correctly!");
            }
        });
    });

    $('.deleteMessage').on('click', function(){
        const id = $(this).data('id');

        $.ajax({
            url: 'message/get-message',
            data: {id:id},
            method: 'post',
            success: function(data){
                $('#idDelete').val(data.id);
                console.log(data.id);
            }
        });
    });

    $('#rowAlert').fadeTo(3000, 500).fadeOut();
});
