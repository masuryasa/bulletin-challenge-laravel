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

    $('#unverified_submit').on('click', function(){
        $('#rowAlert2').fadeTo(5000, 500).fadeOut();
    });

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
                    $('#oldImagePath').val(response.image_name ? 'public/images/'+response.image_name : null);
                    $('#imageDisplay').attr('src',response.image_name ? 'storage/images/'+response.image_name : 'http://via.placeholder.com/500x500');
                    $('#imageNameEdit').val(response.image_name ? (response.image_name).split('+')[1] : null);
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
                                $('#oldImagePath').val(response.image_name ? 'public/images/'+response.image_name : null);
                                $('#imageDisplay').attr('src',response.image_name ? 'storage/images/'+response.image_name : 'http://via.placeholder.com/500x500');
                                $('#imageNameEdit').val(response.image_name ? (response.image_name).split('+')[1] : null);
                            }
                        });
                    } else {
                        $('#invalidPassword'+id).text("You entered wrong password!");
                    }
                },
            });
        }

        $('#inputPassword'+id).val('');
        modalEdit.removeAttr('id');
        $('#invalidPassword'+id).text('');
    });

    $('#formEdit').submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
        const updateAlert = $('#updateAlert');
        updateAlert.removeClass('alert-danger');

        $.ajax({
           method:'post',
           url: 'message/update',
           data: formData,
           contentType: false,
           processData: false,
           cache: false,
           success: (response) => {
               if (response) {
                $('#alertStatus').text('Success to updated message!');
                updateAlert.addClass('alert-success');
                updateAlert.css('display','block');
                setTimeout(()=>location.reload(),2000);
               } else {
                $('#alertStatus').text('Failed to update message.');
                $('#alertMessage').text('Fill the form input correctly!');
                updateAlert.addClass('alert-danger');
                updateAlert.css('display','block');
                updateAlert.fadeTo(3000, 500).fadeOut();
               }

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
                    $('#oldImagePathDelete').val('public/images/'+response.image_name);
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
                                $('#passwordDelete').val(password);
                                $('#oldImagePathDelete').val('public/images/'+response.image_name);
                            }
                        });
                    } else {
                        $('#invalidPassword'+id).text("You entered wrong password!");
                    }
                }
            });
        }

        $('#inputPassword'+id).val('');
        modalDelete.removeAttr('id');
        $('#invalidPassword'+id).text('');
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
