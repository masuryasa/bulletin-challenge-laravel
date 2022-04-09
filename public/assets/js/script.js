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
    $('#rowAlert').fadeTo(7000, 500).fadeOut();

    $('#resend-verification').on('click', function() {
        setTimeout(() => {
            $('#sentMessage').empty();
            $('#sentMessage').text("Verification link sent, check your email!")
        }, 2000);
    });

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
        $('#formEdit')[0].reset();
        const id = $(this).data('id');
        let password = $('#inputPassword'+id).val();

        password = (password === "") ? null : ((isNaN(password) || (password.length < 4 || password.length > 4)) ? null : password);

        const modalEdit = $('.modal-edit');

        if ($(this).data('user-id')){
            modalEdit.attr('id','editModal');
            modalEdit.modal('show');

            $.ajax({
                url: 'message/get',
                data: {
                    id: id
                },
                method: 'post',
                success: (response) => {
                    $('#idEdit').val(response.id);
                    $('#nameEdit').val(response.name);
                    $('#titleEdit').val(response.title);
                    $('#bodyEdit').val(response.body);
                    $('#oldImagePath').val(response.image_path ? 'public/images/'+(response.image_path).split('/')[2] : null);
                    $('#imageDisplay').attr('src',response.image_path ? 'storage/images/'+(response.image_path).split('/')[2] : null);
                    $('#imageNameEdit').val(response.image_name ? response.image_name : null);
                }
            });
        } else {
            $.ajax({
                url: 'password-validation',
                data: {
                    id: id,
                    password: password
                },
                method: 'post',
                success: (valid) => {
                    if (valid){
                        modalEdit.attr('id','editModal');
                        modalEdit.modal('show');

                        $.ajax({
                            url: 'message/get',
                            data: {
                                id: id
                            },
                            method: 'post',
                            success: (response) => {
                                $('#idEdit').val(response.id);
                                $('#nameEdit').val(response.name);
                                $('#titleEdit').val(response.title);
                                $('#bodyEdit').val(response.body);
                                $('#oldImagePath').val(response.image_path ? 'public/images/'+(response.image_path).split('/')[2] : null);
                                $('#imageDisplay').attr('src',response.image_path ? 'storage/images/'+(response.image_path).split('/')[2] : null);
                                $('#imageNameEdit').val(response.image_name ? response.image_name : null);
                            }
                        });
                    }
                },
            });
        }

        $('#inputPassword'+id).val('');
        modalEdit.removeAttr('id');
    });

    $('#formEdit').submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
        const updateAlert = $('#updateAlert');

        $.ajax({
           method:'post',
           url: 'message/update',
           data: formData,
           contentType: false,
           processData: false,
           cache: false,
           success: (response) => {
               $('#alertStatus').text('Success to updated message!');
               updateAlert.addClass('alert-success');
               updateAlert.css('display','block');
               setTimeout(()=>location.reload(),2000);
            },
            error: (response) => {
                $('#alertStatus').text('Failed to update message.');
                $('#alertMessage').text('Fill the form input correctly!');
                updateAlert.addClass('alert-danger');
                updateAlert.css('display','block');
                updateAlert.fadeTo(3000, 500).fadeOut();
            }
        });
    });

    $('.delete-message').on('click', function(){
        const id = $(this).data('id');
        let password = $('#inputPassword'+id).val();

        password = (password === "") ? null : ((isNaN(password) || (password.length < 4 || password.length > 4)) ? null : password);

        const modalDelete = $('.modal-delete');

        if ($(this).data('user-id')){
            modalDelete.attr('id','deleteModal');
            modalDelete.modal('show');

            $.ajax({
                url: 'message/get',
                data: {id: id},
                method: 'post',
                success: (response) => {
                    $('#idDelete').val(response.id);
                    $('#oldImagePathDelete').val('public/images/'+(response.image_path).split('/')[2]);
                }
            });
        } else {
            $.ajax({
                url: 'password-validation',
                data: {
                    id: id,
                    password: password
                },
                method: 'post',
                success: (valid) => {
                    if (valid){
                        modalDelete.attr('id','deleteModal');
                        modalDelete.modal('show');

                        $.ajax({
                            url: 'message/get',
                            data: {id: id},
                            method: 'post',
                            success: (response) => {
                                $('#idDelete').val(response.id);
                                $('#oldImagePathDelete').val('public/images/'+(response.image_path).split('/')[2]);
                            }
                        });
                    }
                }
            });
        }

        $('#inputPassword'+id).val('');
        modalDelete.removeAttr('id');
    });
});

function previewImage(){
    const image = document.querySelector('#imageEdit');
    const imgPreview = document.querySelector('#imageDisplay');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = (oFEvent) => {
        imgPreview.src = oFEvent.target.result;
    }
}
