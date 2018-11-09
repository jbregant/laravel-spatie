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

    $('#paymentsCombo, #loanTypeCombo').change(function () {
        $('#dateConfirmation').css('cursor', 'not-allowed').prop('disabled', true).prop('checked', false);
        $('#addLoanBtn').css('cursor', 'not-allowed').prop('disabled', true).addClass('btn-outline-primary').removeClass('btn-primary');
    });

    $('#paymentsSimulatorBtn').on('click', function (e) {
        e.preventDefault();
        $('#addLoanBtn').css('cursor', 'not-allowed').prop('disabled', true).addClass('btn-outline-primary').removeClass('btn-primary');
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
            let paymentsTable = '';
            let totalAmount = (amount  / 100 * loanFee) + amount ;
            let payment = (totalAmount/payments);

            paymentsCounter = 0;
            let dueDates = [];
            let paymentsLength = $('#paymentsCombo option:selected').val();
            for (let i = 1; i <= paymentsLength; i++){
                let paymentDate = new Date();
                let paymentDateAux = new Date();
                switch (loanType) {
                    case '1':
                    case '2':
                        if (paymentDate.getDay(paymentDate.setDate(paymentDate.getDate() + i)) === 0){
                            paymentsLength++;
                            continue;
                        }
                        dueDates.push(minTwoDigits(paymentDate.getDate()) + '-' + minTwoDigits((paymentDate.getMonth()+1)) + '-'  + paymentDate.getFullYear());
                        break;
                    case '3'://semanal
                        paymentDate.setDate(paymentDate.getDate() + (7*i));
                        dueDates.push(minTwoDigits(paymentDate.getDate()) + '-' + minTwoDigits((paymentDate.getMonth()+1)) + '-'  + paymentDate.getFullYear());
                        break;
                    case '4'://quincenal
                        paymentDate.setDate(paymentDate.getDate() + (14*i));
                        dueDates.push(minTwoDigits(paymentDate.getDate()) + '-' + minTwoDigits((paymentDate.getMonth()+1)) + '-'  + paymentDate.getFullYear());
                        break;
                    case '5'://quincenal
                        paymentDate.setDate(paymentDate.getDate() + 28);
                        dueDates.push(minTwoDigits(paymentDate.getDate()) + '-' + minTwoDigits((paymentDate.getMonth()+1)) + '-'  + paymentDate.getFullYear());
                        break;
                    default:
                        break;
                }
            }
            let dueDateIndex = 0;
            for (let i = 1; i <= payments; i++){
                paymentsTable += '<tr>' +
                    '<td align="center">' + i + '</td>' +
                    // '<td class="payment_amount">$ ' + payment.toFixed(2) + '</td>' +
                    '<td><input type="text" class="datepicker date-picker-payments" value="' + dueDates[dueDateIndex] + '"></input</td>' +
                    '</tr>';
                dueDateIndex++;
            }
            $('#tbodyPayments').html(paymentsTable);
            $('#totalAmount').val(totalAmount.toFixed(2));
            $('#tableFooterTotalPaymentsAmount').attr('hidden', false);
            $('#tableTotalPaymentsAmountTxt').text('$ '+totalAmount.toFixed(2)).datepicker();
            $('#paymentAmount').val(payment.toFixed(2));
            $('.datepicker').datepicker();
            let dateConfirmation = $('#dateConfirmation');
            dateConfirmation.css('cursor', 'pointer').prop('disabled', false);
            if(dateConfirmation.is(':checked')){
                dateConfirmation.prop('checked', false);
            }

        }
    });

    //checkbox for confirm due dates
    $('#dateConfirmation').change(function () {
        if($(this).prop('checked')){
            $('#addLoanBtn').css('cursor', 'pointer').prop('disabled', false).addClass('btn-primary').removeClass('btn-outline-primary');
            $('#paymentsSimulatorTable .date-picker-payments').each(function () {
                $(this).prop('disabled', true);
            });
        } else {
            $('#addLoanBtn').css('cursor', 'not-allowed').prop('disabled', true).addClass('btn-outline-primary').removeClass('btn-primary');
            $('#paymentsSimulatorTable .date-picker-payments').each(function () {
                $(this).prop('disabled', false);
            });
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

        let formData = $('#loanForm').serialize();
        $.ajax({
            url: "/loans",
            type: "POST",
            data: formData
        }).done(function(response) {
            $('#addLoanBtn').css('cursor', 'not-allowed').prop('disabled', true).addClass('btn-outline-primary').removeClass('btn-primary');
            $('#printBtn').attr('loanid', response.loanGrantedId);
            $('#printBtnDiv').show();
            $('#alertDiv').show();
        }).fail(function(response) {
            console.log(response);
            alert('ERROR');
        });
        // $('#loanForm').submit();
    })

    //button to print the loan
    $('#printBtn').on('click', function (e) {
        // e.preventDefault();
        // let dueDates = [];
        // let paymentsAmount = $('#paymentsCombo option:selected').val();
        // $('#paymentsSimulatorTable .date-picker-payments').each(function () {
        //     dueDates.push($(this).val());
        // });
        //
        // if(!(paymentsAmount == dueDates.length)){
        //     $('#modal-msg').text('Vuelva a calcular el importe de las cuotas');
        //     toggleModal();
        //     return false;
        // }
        // console.log($('.payment_amount').val());
        // $('#loanForm').append('<input type="hidden" name="due_dates" value="' + JSON.parse(JSON.stringify(dueDates)) + '" />');
        //
        // let formData = $('#loanForm').serialize();
        let data = {
            id: $(this).attr('loanid')
        }
        $.ajax({
            url: "/loans/loanPrinter",
            type: "POST",
            data: data
        }).done(function(response) {
            $('#printTable').html(response);
            $('#loan-detail').printThis();
            // $('#addLoanBtn').css('cursor', 'not-allowed').prop('disabled', true).addClass('btn-outline-primary').removeClass('btn-primary');
            // $('#printBtn').attr('loanid', response.loanGrantedId);
            // $('#printBtnDiv').show();
            // $('#alertDiv').show();
        }).fail(function(response) {
            console.log(response);
            alert('ERROR');
        });
        // $('#loanForm').submit();
    })

});