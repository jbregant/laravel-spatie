
$(document).ready(function () {
    jQuery.validator.addMethod("paymentAmount", function(value, element) {
        console.log('dentro dela funcion');
        return this.optional(element) || /^[1-9]\d*$/.test(value);
    });

    let today = new Date();
    $('.datepicker').datepicker();
    $("#payment-date-txt").datepicker("setDate", today);

    $('[data-toggle="tooltip"]').tooltip()

    $('#searchClientBtn').on('click', function (e) {
        e.preventDefault();
        $('#paymentAmountPaidTxt').prop('disabled', true);
        $('#doPaymentBtn').prop('disabled', true).css('cursor', 'not-allowed');

        let clientId = $('#clientCombo option:selected').val();

        let clientIdForm = $('#clientIdForm');

        //form settings
        clientIdForm.validate({
            highlight: function(element) {
                jQuery(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                jQuery(element).closest('.form-group').removeClass('has-error');
            },
            rules: {
                client_id: "required",
            },
            messages: {
                client_id: "Este campo es requerido",
            },
        });

        if (!clientIdForm.valid())
            return false;

        $.ajax({
            url: "/incomes/getclientinfo",
            type: "POST",
            data: {clientId}
        }).done(function(response) {
            $('#div-table-payments').html(response.data);
            $('#paymentsTable').dataTable({"pageLength": 100});

            $('.paymentActionBtn').on('click', function () {
                $('#paymentAmountPaidTxt').prop('disabled', false);
                $('#doPaymentBtn').prop('disabled', false).css('cursor', 'pointer');

                let data = JSON.parse($(this).closest('tr').attr('data'));
                $('#loanGrantedIdTxt').val(data.loan_id);
                $('#loanTypeIdTxt').val(data.loan_type);
                $('#paymentsTxt').val(data.payments);
                $('#paymentAmountTxt').val(data.payment_amount);
                $('#loanDateTxt').val(data.loan_created_date);
                $('#paymentData').attr('data', $(this).closest('tr').attr('data'));
                if (data.payment_amount_paid != null){
                    let paymentPartialAmount = data.payment_amount - data.payment_amount_paid;
                    $('#remainingDebtTxt').val(paymentPartialAmount);
                    $('#paymentPartialDiv').show();
                    $('#paymentPartialTxt').val(data.payment_amount_paid);
                    $('#remainingDebtDiv').show();
                    $('#paymentAmountPaidTxt').prop('placeholder', paymentPartialAmount);
                } else {
                    $('#paymentAmountPaidTxt').prop('placeholder', data.payment_amount);
                }
                $('#payment-date-txt').attr('disabled', false);
                $('#paymentAmountPaidTxt').focus();
            }).tooltip();
        }).fail(function(response) {
            console.log(response);
            alert('ERROR');
        });
    });

    $('#doPaymentBtn').on('click', function (e) {
        e.preventDefault();

        let paymentAmountPaid = $('#paymentAmountPaidTxt').val();
        let paymentAmount = $('#paymentAmountTxt').val();
        let paymentPartial = $('#partialPaymentTxt').val();
        let paymentForm = $('#paymentForm');
        let paymentData = JSON.parse($('#paymentData').attr('data'));

        //form settings
        paymentForm.validate({
            highlight: function(element) {
                jQuery(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                jQuery(element).closest('.form-group').removeClass('has-error');
            },
            rules: {
                payment_amount_paid: "required",
                paymentAmount: "required"
            },
            messages: {
                payment_amount_paid: "Este campo es requerido",
                paymentAmount: "El importe no puede comenzar con 0"
            },
        });



        if (!paymentForm.valid())
            return false;

        if (paymentAmountPaid > paymentAmount){
            $('#modalMsg').text('El importe ingresado supera el importe de la cuota');
            $('#myModal').modal('toggle');
            return false;
        }


        let data = {
            paymentId: paymentData.payment_id,
            paymentAmountPaid: $('#paymentAmountPaidTxt').val(),
            paymentDate: $('#payment-date-txt').val(),
            loanGrantedId: $('#loanGrantedIdTxt').val()
        }

        $.ajax({
            url: "/incomes/dopayment",
            type: "POST",
            data: data
        }).done(function(response) {
            $('#paymentForm')[0].reset();
            $('#paymentPartialDiv').hide();
            $('#remainingDebtDiv').hide();
            $('#paymentAmountPaidTxt').prop('placeholder', '');
            $('#modalMsg').text(response.message);
            $('#myModal').modal({
                keyboard: true,
                fadeDuration: 100
            });
            $('#searchClientBtn').click();
            let today = new Date();
            $("#payment-date-txt").datepicker("setDate", today);
        }).fail(function(response) {
            console.log(response);
            alert('ERROR');
        });
        console.log('ea');
    })

});
