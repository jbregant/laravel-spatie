$(document).ready(function () {
    $('.datepicker').datepicker();
    // $.fn.printThis.defaults = {
    //     debug: false,               // show the iframe for debugging
    //     importCSS: true,            // import parent page css
    //     importStyle: true,         // import style tags
    //     printContainer: true,       // print outer container/$.selector
    //     loadCSS: "",                // path to additional css file - use an array [] for multiple
    //     pageTitle: "Financiera Guille",              // add title to print page
    //     removeInline: false,        // remove inline styles from print elements
    //     removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
    //     printDelay: 333,            // variable print delay
    //     header: null,               // prefix to html
    //     footer: null,               // postfix to html
    //     base: false,                // preserve the BASE tag or accept a string for the URL
    //     formValues: true,           // preserve input/form values
    //     canvas: false,              // copy canvas content
    //     doctypeString: '<!DOCTYPE html>', // enter a different doctype for older markup
    //     removeScripts: false,       // remove script tags from print content
    //     copyTagClasses: false,      // copy classes from the html & body tag
    //     beforePrintEvent: null,     // callback function for printEvent in iframe
    //     beforePrint: null,          // function called before iframe is filled
    //     afterPrint: null            // function called before iframe is removed
    // };


    $('#search-btn').on('click', function (e) {
        e.preventDefault();
        let inputForm = $('#input-report-form');

        inputForm.validate({
            highlight: function (element) {
                jQuery(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
                jQuery(element).closest('.form-group').removeClass('has-error');
            },
            rules: {
                input_report: "required"
            },
            messages: {
                input_report: "Este campo es requerido"
            },
        });

        let url;
        switch (window.location.pathname) {
            case '/reports/daily':
                url = '/reports/daily/report';
                break;
            case '/reports/dailyz':
                url = '/reports/dailyz/report';
                break;
            case '/reports/payment_schedule':
                url = '/reports/payment_schedule/report';
                break;
            default:
                break;

        }
        if (inputForm.valid()) {
            let collector = parseInt($('#collectorCombo option:selected').val());
            console.log(typeof(collector));
            let data = {
                inputData: $('#input-report').val(),
                collector: (collector) ? collector : 0
            };
            $.ajax({
                url: url,
                type: "POST",
                data: data
            }).done(function (response) {
                $('#report-table').html(response);
            }).fail(function (response) {
                alert('ERROR');
            });
        }
    });

    $('#printBtn').on('click', function (e) {
        e.preventDefault();
        $('#report-table').printThis({title: 'Reporte Diario'})
    });
});