$.ajaxSetup({
    headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

$(document).ready(function() {
    $('.admin-delete-message').on('click', function () {
        const id = $(this).data('id');
        const button = $(this).data('button');

        $.ajax({
            url: 'message/get',
            data: {id: id},
            method: 'post',
            success: (response) => {
                $('#idMessage').val(response.id);
                $('#buttonType').val(button);
            },
            error: (response) => {
                alert("Failed to get message! Error: ",response);
            }
        });
     });

     $('#checkboxAll').on('click', function () {
         $('input:checkbox').not(this).prop('checked',this.checked);
     });

    var checkboxIds = null;
    $('input[type=checkbox]').on('change', function(){
        checkboxIds = [];
        const checked = $('input.checkboxItem[type=checkbox]:checked')
        checked.each(function(){
            checkboxIds.push($(this).data('id'));
        });
    });

    $('#deleteAllButton').on('click', function(){
        $('#buttonType').val('messages');
        const idMessage = $('#idMessage');
        checkboxIds.length > 0 ? idMessage.val(checkboxIds.join()) : idMessage.val('');
    });

     $('.btn-recover').on('click', function(){
        const id = $(this).data('id');

        $.ajax({
            url: 'admin/recover',
            data: {id:id},
            method: 'post',
            success: (response) => {
                location.reload();
            },
            error: (response) => {
                alert("Failed to recover message! Error: ",response);
            }
        });
     });
});
