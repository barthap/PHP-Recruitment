/**
 * Created by Barthap on 19.04.2017.
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
//POST note
function postNote(id, value, callback) {

    $.ajax({
            url: '<?php echo URL::site('api/note'); ?>/'+id,
        type: 'post',
        data: value,   //dont use for GET
        contentType: 'text/plain; charset=uft-8',    //send type
        dataType: 'json',   //return-type
        success: function(data_result, status) {
        console.log(data_result);
        callback(data_result);

    },
    error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
    }
}); // end ajax call
}

//GET full note value
function getNote(id, callback) {
    $.ajax({
            url: '<?php echo URL::site('api/note'); ?>/'+id,
        type: 'get',
        contentType: 'text/plain',
        success: function(data, status) {
        callback(data);
    },
    error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
    }
}); // end ajax call

}