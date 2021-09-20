$('#submit').on('click', function(e) {
    e.preventDefault();

    var height = $('#inputHeight').val();
    var width = $('#inputWidth').val();
    var tds = '<td>'.repeat(height);
    var trs = ('<tr>'+tds).repeat(width);
    var table = '<table id="pixelCanvas">' + trs + '</table>';

    $('#pixelCanvas').replaceWith(table);
});

$('body').on('click','#pixelCanvas td', function() {
    var color = $('#colorPicker').val();
    $(this).css('background-color', color);
});