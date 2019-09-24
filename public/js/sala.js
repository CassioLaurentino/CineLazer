$('.grid-container').append('<div>', {
    "class": '1'
});

$(document).ready(function(){
    $max_columns = 15;

    // grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
    // grid-template-rows: 1fr 1fr 1fr 1fr 1fr;
    // grid-template-areas: ". . \31  . . \31 1 . ." ". . . \31 2 . . . ." ". . . . . . . ." ". . . . . . . ." ". . . . . . . .";

    // .\31  { grid-area: \31 ; }

    // .\31 1 { grid-area: \31 1; }

    // .\31 2 { grid-area: \31 2; }

    if (sessions.numero_de_poltronas.length > $max_columns) {
        $numero_de_filas = sessions.numero_de_poltronas.length / $max_columns;
        $rows = '';

        for (let i = 0; i < $numero_de_filas; i++) {
            $rows += '1fr ';
        };
        
        $columns = '';
        for (let i = 0; i < $max_columns; i++) {
            $columns += '1fr ';
        };

        $('.grid-container').css("grid-template-columns", $columns.slice(0,-1));
        $('.grid-container').css("grid-template-rows", $rows.slice(0,-1));
    } else {
        $numero_de_colunas = sessions.numero_de_poltronas.length
        $columns = '';
        
        for (let i = 0; i < $numero_de_colunas; i++) {
            $columns += '1fr ';
        };   

        $('.grid-container').css("grid-template-columns", $columns.slice(0,-1));
        $('.grid-container').css("grid-template-rows", '1fr');
    }

    $.each(sessions.numero_de_poltronas, function( index, value ) {
        $poltrona = index+1;
        $div = '<div class="'.concat($poltrona).concat('"></div>');
        $('.grid-container').append($div);

        // $('.'+$poltrona).css("grid-area", $poltrona);
        $('.'+$poltrona).attr('id', 'livre');

        if (value != "") {
            $('.'+$poltrona).attr('id', 'ocupado');
        }
    });

    $('div#livre').click(function() {
        if (this.id == 'selecionado') {
            console.log('dsfadfasdfa')
            $('.'+this.className).attr('id', 'livre');
            return;
        }

        // TODO calcular esforço para ter mais de uma poltrona por reserva
        // $('div#selecionado').attr('id', 'livre');
        $('.'+this.className).attr('id', 'selecionado');
    });
});