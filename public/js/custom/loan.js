$(document).ready(function () {
    //disable the first option of the comboboxs
    $('#clientCombo option:first').attr('disabled', true);
    $('#loanTypeCombo option:first').attr('disabled', true);

    //fills inputs with loan type info
    $('#loanTypeCombo').on('change', function (e) {
        let id = $(this).val();
        $.ajax({
            url: "/feecheck/" + id,
            context: document.body
        }).done(function(response) {
            let maxPayments = response.max_loan_payments;
            let paymentsCombo;

            for (let i = 0; i <= maxPayments; i++){
                if(i === 0)
                    paymentsCombo = '<option value="' + i + '" disabled>' + i + '</option>';
                else
                    paymentsCombo += '<option value="' + i + '">' + i + '</option>';
            }
            $('#paymentsCombo').html(paymentsCombo);

            $('#loanFee').val(response.loan_fee);
        }).fail(function() {
            alert( "error" );
        });
    });

    $('#paymentsSimulatorBtn').on('click', function (e) {
        e.preventDefault();
        let loanForm = $('#loanForm');

        //form settings
        loanForm.validate({
            highlight: function(element) {
                jQuery(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                jQuery(element).closest('.form-group').removeClass('has-error');
            },
            rules: {
                client_id: "required",
                loan_type_id: "required",
                loan_fee: "required",
                amount: "required",
                payments: "required"
            },
            messages: {
                client_id: "Este campo es requerido",
                loan_type_id: "Este campo es requerido",
                loan_fee: "Este campo es requerido",
                amount: "Este campo es requerido",
                payments: "Este campo es requerido"
            },
        });

        //form validation
        if(loanForm.valid()){
            let loanFee = parseInt($('#loanFee').val());
            let loanType = $('#loanTypeCombo option:selected').val();
            let amount = parseInt($('#amount').val());
            let payments = $('#paymentsCombo option:selected').val();
            let paymentsTable;

            // let totalFinalAmount = Math.floor(totalAmount*loanFee)/100;
            let totalAmount = (amount  / 100 * loanFee) + amount ;
            let payment = totalAmount/payments;

            // let today = new Date();
            let paymentDate = new Date();
            paymentsTable = '';
            for (let i = 1; i <= payments; i++){
                if(loanType === '1'){
                    paymentDate.setDate(paymentDate.getDate() + (7*i));
                } else {
                    paymentDate.setDate(paymentDate.getDate() + 28);
                }
                paymentsTable += '<tr>' +
                    '<td align="center">' + i + '</td>' +
                    '<td class="payment_amount">$ ' + payment.toFixed(2) + '</td>' +
                    '<td><input type="text" class="datepicker date-picker-payments" value="' + minTwoDigits(paymentDate.getDate()) + '-' + minTwoDigits((paymentDate.getMonth()+1)) + '-'  + paymentDate.getFullYear() + '"></input</td>' +
                    '</tr>';
            }

            $('#tbodyPayments').html(paymentsTable);
            $('#totalAmount').val(totalAmount.toFixed(2));
            $('#tableFooterTotalPaymentsAmount').attr('hidden', false);
            $('#tableTotalPaymentsAmountTxt').text('$ '+totalAmount.toFixed(2)).datepicker();
            $('#paymentAmount').val(payment.toFixed(2));
            $('.datepicker').datepicker();
            $('#dateConfirmation').css('cursor', 'pointer').prop('disabled', false);
        }
    });

    //checkbox for confirm due dates
    $('#dateConfirmation').change(function () {
        if($(this).prop('checked')){
            $('#addLoanBtn').css('cursor', 'pointer').prop('disabled', false);
            $('#paymentsSimulatorTable .date-picker-payments').each(function () {
                $(this).prop('disabled', true);
            });
        } else {
            $('#addLoanBtn').css('cursor', 'not-allowed').prop('disabled', true);
        }
    });

    //button to send data to server
    $('#addLoanBtn').on('click', function (e) {
        e.preventDefault();
        let dueDates = [];
        let paymentsAmount = $('#paymentsCombo option:selected').val();
        $('#paymentsSimulatorTable .date-picker-payments').each(function () {
            dueDates.push($(this).val());
        });

        if(!(paymentsAmount == dueDates.length)){
            $('#modal-msg').text('Vuelva a calcular el importe de las cuotas');
            toggleModal();
            return false;
        }
        console.log($('.payment_amount').val());
        $('#loanForm').append('<input type="hidden" name="due_dates" value="' + JSON.parse(JSON.stringify(dueDates)) + '" />');
        $('#loanForm').submit();
    })

});