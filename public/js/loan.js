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
    })

    $('#simulatePayments').on('click', function (e) {
        e.preventDefault();
        let loanForm = $('#loanForm');

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
                total_amount: "required",
                payments: "required"
            },
            messages: {
                client_id: "Este campo es requerido",
                loan_type_id: "Este campo es requerido",
                loan_fee: "Este campo es requerido",
                total_amount: "Este campo es requerido",
                payments: "Este campo es requerido"
            },
        });

        if(loanForm.valid()){
            let loanFee = parseInt($('#loanFee').val());
            let totalAmount = parseInt($('#totalAmount').val());
            let payments = $('#paymentsCombo option:selected').val();
            let paymentsTable;

            // let totalFinalAmount = Math.floor(totalAmount*loanFee)/100;
            let totalFinalAmount = (totalAmount / 100 * loanFee) + totalAmount;
            let payment = (totalFinalAmount/payments);

            // let today = new Date();
            let paymentDate = new Date();
            paymentsTable = '';
            for (let i = 1; i <= payments; i++){
                paymentDate.setDate(paymentDate.getDate() + (7*i));
                paymentsTable += '<tr>' +
                    '<td align="center">' + i + '</td>' +
                    '<td align="center">$ ' + parseInt(payment) + '</td>' +
                    '<td><input type="text" class="datepicker" value="' + minTwoDigits(paymentDate.getDate()) + '-' + minTwoDigits((paymentDate.getMonth()+1)) + '-'  + paymentDate.getFullYear() + '"></input</td>' +
                    '</tr>';
            }
            // ' + minTwoDigits(paymentDate.getDate()) + '-' + minTwoDigits((paymentDate.getMonth()+1)) + '-'  + paymentDate.getFullYear() + '

            $('#tbodyPayments').html(paymentsTable);
            $('#tableFooterTotalPaymentsAmount').attr('hidden', false);
            $('#tableTotalPaymentsAmountTxt').text('$ '+totalFinalAmount);
            $('#tableTotalPaymentsAmountTxt').datepicker();
            $('.datepicker').datepicker();
            // $.datepicker.regional['es'] = {
            //     closeText: 'Cerrar',
            //     prevText: '< Ant',
            //     nextText: 'Sig >',
            //     currentText: 'Hoy',
            //     monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            //     monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
            //     dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            //     dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
            //     dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
            //     weekHeader: 'Sm',
            //     dateFormat: 'dd-mm-yy',
            //     firstDay: 1,
            //     isRTL: false,
            //     showMonthAfterYear: false,
            //     yearSuffix: ''
            // };
            // $.datepicker.setDefaults($.datepicker.regional['es']);
        }
    });
});