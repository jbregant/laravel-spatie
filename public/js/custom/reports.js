$(document).ready(function () {
    $('.datepicker').datepicker();


    $('#search-btn').on('click', function (e) {
        e.preventDefault();
        let dateInput = $('#date-form');

        dateInput.validate({
            highlight: function(element) {
                jQuery(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                jQuery(element).closest('.form-group').removeClass('has-error');
            },
            rules: {
                date: "required"
            },
            messages: {
                date: "Este campo es requerido"
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
            default:
                break;

        }
        if (dateInput.valid()){
            let data = {
                date: $('#daily-date').val()
            };
            $.ajax({
                url: url,
                type: "POST",
                data: data
            }).done(function(response) {
                $('#daily-report-table').html(response);
            }).fail(function(response) {
                alert('ERROR');
            });
        }
    });

    $('#printBtn').on('click', function (e) {
        e.preventDefault();
        $('#daily-report-table').printThis();
    })
});