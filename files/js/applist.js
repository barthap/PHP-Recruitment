/**
 * @NOTE!!! This code IS NOT the same as app.js code!
 */

$('.edit-note').click(function () {
    var obj = $(this);
    var id = obj.data('id');
    var name = getFullName($(this));

    $('#full-name').text(name);

    getNote(id, function(note) {
        $('#note-val').val(note);
    });


    $('#note-save').click(function () {
        var val = $('#note-val').val();
        postNote(id, val, function (err) {
            if(err.success) {
                obj.parents('td').prev().html(val);
                $('#note-modal').modal('hide');
            }
        });
    });

    $('#note-modal').modal();
});



function getFullName(obj) {
    var first = obj.parents('tr').children('td').first();   //pierwsze dziecko td rodzica tr elementu obj
    var second = first.next('td');  //nastepne td po first

    return first.html() + ' ' + second.html();
}
