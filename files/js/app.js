/**
 * @NOTE!!! This code IS NOT the same as applist.js code!
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
                $('#note-content').html(val);
                $('#note-modal').modal('hide');
            }
        });
    });

    $('#note-modal').modal();
});
