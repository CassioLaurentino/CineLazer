$(document).ready(function(){
    $('#colunas').focusout(function() {
        updateNumOfPoltronas();
    });

    $('#fileiras').focusout(function() {
        updateNumOfPoltronas();
    });
});

function updateNumOfPoltronas() {
    var colunas = $('#colunas').val();
    var fileiras = $('#fileiras').val();
    var num_pol = null;

    if (colunas != "" && fileiras != "") {
        num_pol = colunas * fileiras;
    } else if (colunas != "") {
        num_pol = colunas;
    } else if (fileiras != "") {
        num_pol = fileiras;
    }

    document.getElementById("numero_de_poltronas").value = num_pol;
}