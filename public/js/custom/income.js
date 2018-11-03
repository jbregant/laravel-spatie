$(document).ready(function () {
    $('#searchClientBtn').on('click', function () {

        let clientId = $('#clientIdTxt').val();
        let dni = $('#dniTxt').val();
        if( !clientId ) {
            $('#modalMsg').text(response.message);
            $("#myModal").modal('show');

        }

        $.ajax({
            // url: "/incomes/getclientinfo/" + clientId,
            url: "/incomes/getclientinfo",
            type: "POST",
            data: {clientId}
        }).done(function(response) {
            switch (response.status) {
                case 200:
                    $('#tbodyPayments').html(response.data);
                    break;
                case 201:
                    $('#modalMsg').text(response.message);
                    $("#myModal").modal('show');
                    break;
                default:
                    break;
            }
        }).fail(function(response) {
            console.log(response);
            alert('ERROR');
        });
    })
});
