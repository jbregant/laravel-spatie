
$(document).ready(function () {
    jQuery.validator.addMethod("paymentAmount", function(value, element) {
        console.log('dentro dela funcion');
        return this.optional(element) || /^[1-9]\d*$/.test(value);
    });
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
            $('#paymentsTable').dataTable();

            $('.paymentActionBtn').on('click', function () {
                $('#paymentAmountPaidTxt').prop('disabled', false);
                $('#doPaymentBtn').prop('disabled', false).css('cursor', 'pointer');

                let data = JSON.parse($(this).closest('tr').attr('data'));
                $('#loanGrantedIdTxt').val(data.loan_id);
                $('#loanTypeIdTxt').val(data.loan_type);
                $('#paymentNumberTxt').val(data.payment_number);
                $('#paymentAmountTxt').val(data.payment_amount);
                $('#dueDateTxt').val(data.due_date);
                $('#paymentAmountPaidTxt').val('');
                $('#paymentData').attr('data', $(this).closest('tr').attr('data'));


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
        console.log(paymentData);
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

        // due_date: "11-11-2018"
        // loan_id: 6
        // loan_type: "Semanal"
        // payment_amount: 3818.43
        // payment_id: 17
        // payment_number: 1
        // payments: 4
        // status: "pendiente"
        // total_amount: 15274
        // updated_amount: null
        let data = {
            paymentId: paymentData.payment_id,
            paymentAmountPaid: $('#paymentAmountPaidTxt').val()
        }

        // if ()
        $.ajax({
            url: "/incomes/dopayment",
            type: "POST",
            data: data
        }).done(function(response) {
            $('#div-table-payments').html(response.data);
            $('#paymentsTable').dataTable();

            $('.paymentActionBtn').on('click', function () {
                $('#paymentAmountPaidTxt').prop('disabled', false);
                $('#doPaymentBtn').prop('disabled', false).css('cursor', 'pointer');
                let data = JSON.parse($(this).closest('tr').attr('data'));
                $('#loanGrantedIdTxt').val(data.loan_id);
                $('#loanTypeIdTxt').val(data.loan_type);
                $('#paymentNumberTxt').val(data.payment_number);
                $('#paymentAmountTxt').val(data.payment_amount);
                $('#dueDateTxt').val(data.due_date);
                $('#paymentData').attr('data', $(this).closest('tr').attr('data'));
            }).tooltip();


        }).fail(function(response) {
            console.log(response);
            alert('ERROR');
        });
        console.log('ea');
    })

});
