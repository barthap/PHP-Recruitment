/**
 * Created by Barthap on 27.04.2017.
 */

//POST note
function postNote(id, value, callback) {

    $.ajax({
        url: noteUrlBase+id,
        type: 'put',
        data: value,
        contentType: 'text/plain; charset=uft-8',    //send type
        dataType: 'json',   //return-type
        success: function(data_result, status) {
            console.log(data_result);
            callback(data_result);
            //unfortunately data cannot be just returned using return so we need a callback to get result
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
        url: noteUrlBase+id,
        type: 'get',
        //contentType: 'text/plain',
        success: function(data, status) {
            callback(data); //unfortunately data cannot be just returned using return so we need a callback to get result
        },
        error: function(xhr, desc, err) {
            console.log(xhr);
            console.log("Details: " + desc + "\nError:" + err);
        }
    }); // end ajax call

}