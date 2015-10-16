$(document).ready(function(){
    $('#litEditFile').on('shown.bs.modal', function (event) {
        var modal = $(this);
        var button = $(event.relatedTarget);
        var alias = button.data('alias');

        modal.find('#litFileTitle').text('Файл "' + alias + '"');
        modal.find('#litFileAlias').val(alias);
        modal.find('#litFileNewAlias').val(alias);

        $('#litFileNewAlias').focus();
    });

    $('#litEditFileForm').submit(function (e) {
        e.preventDefault();
        var alias = $(this).find('#litFileAlias').val();

        $('#litEditFile').modal('hide');
        jQuery.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'editFile',
                data: $(this).serializeArray()
            },
            success: function (data) {
                if (data.error) {
                    console.log(data.message);
                } else {
                    $('a[data-alias="' + alias + '"]').attr('data-alias', data.newAlias)
                        .data('alias', data.newAlias)
                        .parents('.file-box').find('.litFileLink').attr('href', '/' + data.newAlias)
                        .find('.file-name').text(data.newAlias);
                    $('a[data-filealias="' + alias + '"]').attr('data-filealias', data.newAlias).data('filealias', data.newAlias);

                    swal("Выполнено", data.message, "success");
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
        $(this).find('input').val('');
    });

    $('.litFileDeleteButton').click(function (e) {
        e.preventDefault();

        var alias = $(this).data('filealias');
        swal({
            title: "Вы уверенны?",
            text: "После удаления файл будет невозможно восстановить!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: 'Нет, не удалять.',
            confirmButtonText: "Да, удалить!",
            closeOnConfirm: false
        }, function () {
            jQuery.ajax({
                url: $('#litEditFileForm').attr('action'),
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'deleteFile',
                    data: alias
                },
                success: function (data) {
                    if (data.error) {
                        console.log(data.message);
                    } else {
                        $('a[data-filealias="' + alias + '"]').parents('.file-box').fadeOut('slow', function(){
                            $(this).remove();
                        });
                        swal("Удалено!", data.message, "success");;
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });
    })
});