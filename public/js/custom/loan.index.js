$('.btn-table-delete').on('click', function (e) {
    e.preventDefault();
    console.log('ea');
    let dis = $(this);
    $.confirm({
        title: '',
        content: 'Confirma la eliminacion del credito?',
        buttons: {
            Si: {
                text: 'Si',
                action: function () {
                    dis.parent('form').submit();
                }
            },
            No: {
                text: 'No', // With spaces and symbols
                action: function () {
                    //
                }
            }
        }
    });
});