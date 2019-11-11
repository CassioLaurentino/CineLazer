$(document).ready(function(){
    populateScream(sessions[0]);
    
    $('#sessao_id').on('change',function(){
        populateScream(sessions.find(x => x.id == $('#sessao_id').val()));
    }); 
});

function populateScream(session) {
    var poltronas = new Array()
    $max_columns = 15;

    $('.grid-container div').remove();
    
    if (session.numero_de_poltronas.length > $max_columns) {
        $numero_de_filas = session.numero_de_poltronas.length / $max_columns;
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
        $numero_de_colunas = session.numero_de_poltronas.length
        $columns = '';
        
        for (let i = 0; i < $numero_de_colunas; i++) {
            $columns += '1fr ';
        };   

        $('.grid-container').css("grid-template-columns", $columns.slice(0,-1));
        $('.grid-container').css("grid-template-rows", '1fr');
    }

    $.each(session.numero_de_poltronas, function( index, value ) {
        $poltrona = index+1;

        if (session.numero_de_poltronas.length == $poltrona) {
            if (value != "") {
                $('.'+index).attr('id', 'ocupado');
            }
            
            return;
        }

        $div = '<div class="'.concat($poltrona).concat('"></div>');
        $('.grid-container').append($div);

        // $('.'+$poltrona).css("grid-area", $poltrona);
        $('.'+$poltrona).attr('id', 'livre');

        if (value != null && value != "") {
            $('.'+index).attr('id', 'ocupado');
        }
    });

    $('div#livre').click(function() {
        if (this.id == 'selecionado') {
            $('.'+this.className).attr('id', 'livre');
            delete poltronas[this.className];
            $('#poltronas').attr('value', poltronas);
            return;
        }

        $('.'+this.className).attr('id', 'selecionado');
        poltronas[this.className] = userId;
        $('#poltronas').attr('value', poltronas);
    });
}