function setNoteRowEvents(row) {
    var element = row.getElement();

    var data = row.getData();

    var getFullName = function () {
        return data.first_name + " " + data.last_name;
    };

    element.find('.edit-note').click(function () {
        var obj = $(this);
        var id = obj.data('id');
        var name = getFullName();

        $('#full-name').text(name);

        getNote(id, function(note) {
            $('#note-val').val(note);
        });


        $('#note-save').click(function () {
            var val = $('#note-val').val();
            postNote(id, val, function (err) {
                if(err.success) {

                    row.update({"note":val});
                    $('#note-modal').modal('hide');
                }
            });
        });

        $('#note-modal').modal();
    });
}

localePl = {
    "pl":{
        "ajax":{
            "loading":"Wczytywanie...", //ajax loader text
            "error":"Błąd", //ajax error text
        },
        "pagination":{
            "first":"Pierwsza", //text for the first page button
            "first_title":"Pierwsza Strona", //tooltip text for the first page button
            "last":"Ostatnia",
            "last_title":"Ostatnia Strona",
            "prev":"Poprzednia",
            "prev_title":"Poprzednia Strona",
            "next":"Następna",
            "next_title":"Następna Strona",
        },
        "headerFilters":{
            "default":"Filtruj...", //default header filter placeholder text
            "columns":{
                //"first_spec":"filter name...", //replace default header filter text for column name
            }
        }
    }
};

defaultVals = {
    pagination: "local",
    paginationSize:6,
    resizableColumns: true,
    fitColumns:true,
    placeholder:"Brak wyników",
    virtualDom:true,
    groupStartOpen:false,
    columns:[
        {title: "Imię", field: "first_name", sortable:true, width:130},
        {title: "Nazwisko", field: "last_name", sortable:true, width:130},
        {title: "1. Kierunek", field: "first_spec", sortable:true, formatter: "textarea", width:150, headerFilter:"input"},
        {title: "2. Kierunek", field: "sec_spec", sortable:true, formatter: "textarea", width:150, headerFilter:"input"},
        {title: "Języki", field: "languages", sortable:true, formatter: "html", width:110, headerFilter:"input"},
        {title: "Opcje", field: "options", sortable:false, formatter: "html", width:100},
        {title: "Notatka", field: "note", sortable:false, formatter: "textarea"},
    ],
    rowFormatter:function(row){
        setNoteRowEvents(row);
    },
    dataFiltered:function (filters, rows) {
        $('#count').text(rows.length);
    },
    dataLoaded:function (data) {
        $('#count').text(data.length);
    },
    langs:localePl,
};

function initTabulator(opts)
{
    var table = $('<table id="applist"></table>');
    table.addClass('table').addClass('table-striped').addClass('app-list');

    $('#applist-div').children().remove();
    table.appendTo('#applist-div');

    $('#applist').tabulator(defaultVals);
    $('#applist').tabulator("setLocale", "pl"); //set locale to french
    $('#applist').tabulator("setData", ajaxUrl);
}