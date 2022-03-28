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
        const id = $(this).data('id');

        $.ajax({
            url: 'message/get-message',
            data: {id:id},
            method: 'post',
            success: function(data){
                $('#idEdit').val(data.id);
                $('#nameEdit').val(data.name);
                $('#titleEdit').val(data.title);
                $('#bodyEdit').val(data.body);
                $('#imageDisplay').attr('src',data.image_path ? 'storage/images/'+(data.image_path).split('/')[2] : null);
                $('#imageNameEdit').val(data.image_name ? data.image_name : null);
                $('#passwordEdit').val(data.pass);
            }
        });
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
               if (response) {
                //    $('.modal').modal('hide');
                   location.reload();
                }
            },
            error: function(response){
                alert("Fill the form input correctly!");
            }
        });
    });

    $('.deleteMessage').on('click', function(){
        const id = $(this).data('id');
        const site_url = window.location.href;

        $.ajax({
            url: site_url+'message/get-message',
            data: {id:id},
            method: 'post',
            success: function(data){
                $('#idDelete').val(data.id);
                console.log(data.id);
            }
        });
    });
});
