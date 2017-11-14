/**
 * Created by Barthap on 10.05.2017.
 */


function setAccepted(id, value, callback) {

    var data = {
        accepted: value,
    };

    $.ajax({
        url: acceptUrlBase+id,
        type: 'put',
        data: JSON.stringify(data),
        contentType: 'application/json; charset=uft-8',    //send type
        dataType: 'json',   //return-type
        success: function(data_result, status) {
            console.log(data_result);
            if(callback)callback(data_result);
            //unfortunately data cannot be just returned using return so we need a callback to get result
        },
        error: function(xhr, desc, err) {
            console.log(xhr);
            console.log("Details: " + desc + "\nError:" + err);
        }
    }); // end ajax call
}

//GET full note value
function getAccepted(id, callback) {
    $.ajax({
        url: acceptUrlBase+id,
        type: 'get',
        dataType: 'json',
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

function countAccepted(callback) {
    $.ajax({
        url: acceptUrlBase,
        type: 'get',
        dataType: 'json',
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