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

    // $('#unverified_submit').on('click', function() {
    //     $('#rowAlert2').fadeTo(5000, 500).fadeOut();
    // });

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

    var passwordValidation = (id, password) => {
        let res = false;

        $.ajax({
            url: 'messages/password-validation',
            method: 'post',
            async: false,
            data: {
                id: id,
                password: password
            },
            success: (response) => {
                if (response) {
                    res = true;
                }
            },
            error: (response) => {
                alert("Failed to get message! Error: ",response);
            }
        });

        return res;
    }

    var invalidPasswordMessage = (id) => {
        $('#invalidPassword'+id).text("You entered wrong password!");
    }

    var resetInvalidPasswordMessage = (id, modal) => {
        $('#inputPassword'+id).val('');
        modal.removeAttr('id');
    }

    $('.edit-message').on('click', function() {
        $('#formEdit')[0].reset();
        const id = $(this).data('id');
        let password = $('#inputPassword'+id).val();

        password = (password === "") ? null : ((isNaN(password) || (password.length < 4 || password.length > 4)) ? null : password);

        const modalEdit = $('.modal-edit');

        let fillFormEdit = (response) => {
            $('#idEdit').val(response.id);
            $('#nameEdit').val(response.name);
            $('#titleEdit').val(response.title);
            $('#bodyEdit').val(response.body);
            $('#oldImagePath').val(response.image_name ? 'public/images/'+response.image_name : null);
            $('#imageDisplay').attr('src',response.image_name ? 'storage/images/'+response.image_name : 'storage/images/placeholder-500x500.png');
            $('#imageNameEdit').val(response.image_name ?? null);
        }

        if ($(this).data('user-id')) {
            modalEdit.attr('id','editModal');

            $.ajax({
                url: 'messages/'+id,
                method: 'get',
                data: {id: id},
                success: (response) => {
                    modalEdit.modal('show');
                    fillFormEdit(response)
                },
                error: (response) => {
                    alert("Failed to show detail message! Error: ",response);
                }
            });
        } else {
            const isPasswordValid = passwordValidation(id, password);

            if (!isPasswordValid) {
                invalidPasswordMessage(id);
            } else {
                $.ajax({
                    url: 'messages/'+id,
                    method: 'get',
                    success: (response) => {
                        $('#invalidPassword'+id).text('');
                        modalEdit.attr('id','editModal');
                        modalEdit.modal('show');

                        fillFormEdit(response)
                    },
                    error: (response) => {
                        alert("Failed to show detail message! Error: ",response);
                    }
                });
            }
        }

        resetInvalidPasswordMessage(id, modalEdit);
    });

    $('#formEdit').submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const updateAlert = $('#updateAlert');
        updateAlert.removeClass('alert-danger');

        $.ajax({
            url: 'messages/'+formData.get('id'),
            method:'post',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: (response) => {
                $('#alertStatus').text('Success to updated message!');
                $('#alertMessage').text('');
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

    $('.delete-message').on('click', function() {
        const id = $(this).data('id');
        let password = $('#inputPassword'+id).val();

        password = (password === "") ? null : ((isNaN(password) || (password.length < 4 || password.length > 4)) ? null : password);

        const modalDelete = $('.modal-delete');

        if ($(this).data('user-id')) {
            modalDelete.attr('id','deleteModal');
            modalDelete.modal('show');

            $.ajax({
                url: 'messages/'+id,
                method: 'get',
                data: {id: id},
                success: (response) => {
                    $('#idDelete').val(response.id);
                    $('#oldImagePathDelete').val('public/images/'+response.image_name);
                },
                error: (response) => {
                    alert("Failed to get message! Error: ",response);
                }
            });
        } else {
            const isPasswordValid = passwordValidation(id, password);

            if (!isPasswordValid) {
                invalidPasswordMessage(id);
            } else {
                modalDelete.attr('id','deleteModal');
                modalDelete.modal('show');

                $.ajax({
                    url: 'messages/'+id,
                    method: 'get',
                    success: (response) => {
                        $('#invalidPassword'+id).text('');
                        $('#idDelete').val(response.id);
                        $('#passwordDelete').val(password);
                        $('#oldImagePathDelete').val('public/images/'+response.image_name);
                    },
                    error: (response) => {
                        alert("Failed to show detail message! Error: ",response);
                    }
                });
            }
        }

        resetInvalidPasswordMessage(id, modalDelete);
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
