

$(document).ready(function () {
    $('#searchClientBtn').on('click', function () {
        let clientId = $('#clientIdTxt').val();

        $.ajax({
            url: "/incomes/getclientinfo/" + clientId,
        }).done(function(response) {
            alert('OK');
            // let maxPayments = response.max_loan_payments;
            // let paymentsCombo;
            //
            // for (let i = 0; i <= maxPayments; i++){
            //     if(i === 0)
            //         paymentsCombo = '<option value="' + i + '" disabled>' + i + '</option>';
            //     else
            //         paymentsCombo += '<option value="' + i + '">' + i + '</option>';
            // }
            $('#tbodyPayments').html(response);

            $('#loanFee').val(response.loan_fee);
        }).fail(function(response) {
            console.log(response);
            alert('ERROR');
        });
    })
});
