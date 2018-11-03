$(document).ready(function () {
    $('#searchClientBtn').on('click', function () {
        // $("#test").leanModal()();
        $("#test").modal();
        let clientId = $('#clientIdTxt').val();

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
                    //mostrar mensaje de que no se encontraron datos

            }
            // console.log(response.data);
            // let maxPayments = response.max_loan_payments;
            // let paymentsCombo;
            //
            // for (let i = 0; i <= maxPayments; i++){
            //     if(i === 0)
            //         paymentsCombo = '<option value="' + i + '" disabled>' + i + '</option>';
            //     else
            //         paymentsCombo += '<option value="' + i + '">' + i + '</option>';
            // }

        }).fail(function(response) {
            console.log(response);
            alert('ERROR');
        });
    })
});
