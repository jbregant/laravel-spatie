jQuery(function($) {
    $.extend( $.fn.dataTable.defaults, {
        language: {
            "url": "/js/jQuery-3.3.1/Spanish.json"
        },
        pagination: true,
    });

    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd-mm-yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };

    $.datepicker.setDefaults($.datepicker.regional['es']);

    $.extend( $.fn.dataTable.defaults, {
        language: {
            "url": "/js/jQuery-3.3.1/Spanish.json"
        },
        pagination: true,
    });
});

function compareDate(str1){
// str1 format should be dd/mm/yyyy. Separator can be anything e.g. / or -. It wont effect
    var dt1   = parseInt(str1.substring(0,2));
    var mon1  = parseInt(str1.substring(3,5));
    var yr1   = parseInt(str1.substring(6,10));
    return new Date(yr1, mon1-1, dt1);
}

function minTwoDigits(n) {
    return (n < 10 ? '0' : '') + n;
}

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
// function toggleModal() {
//     var modal = document.querySelector("#myModal");
//     modal.style.display = "block";
// }
//
//
// $(document).ready(function () {
// // Get the modal
//     var modal = document.getElementById('myModal');
//
// // Get the <span> element that closes the modal
//     var span = document.getElementsByClassName("close-modal")[0];
// // When the user clicks on <span> (x), close the modal
//     span.onclick = function() {
//         modal.style.display = "none";
//         $('#modal-msg').text('');
//     };
// // When the user clicks anywhere outside of the modal, close it
//     window.onclick = function(event) {
//         if (event.target === modal) {
//             modal.style.display = "none";
//             $('#modal-msg').text('');
//         }
//     }
// });
