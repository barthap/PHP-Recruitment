/**
 * Created by Barthap on 27.04.2017.
 */

$('#register-form').validate({
    rules: {
        first_name: {
            minlength: 3,
            maxlength: 15,
            required: true,
        },
        last_name: {
            minlength: 3,
            maxlength: 15,
            required: true,
        },
        birth_date: {
            required: true,
        },
        birth_place: {
            minlength: 3,
            required: true,
        },
        pesel: {
            required: true,
            digits: true,
            minlength: 11,
            maxlength: 11,
        },
        addr_city: {
            required: true,
        },
        addr_street: {
            required: true,
        },
        addr_zip: {
            required: true,
        },
        addr_province: {
            required: true,
        },
        tel: {
            required: false,
            digits: true,
            minlength: 7,
            maxlength: 13,
        },
        email: {
            email: true,
        },
        password: {
            minlength: 6,
        },
    },
    highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
    }
});

$('#account').change(function(){
    var checked = $('#account').is(':checked');
    if(checked) {
        $('#login-data').slideDown();   //show

        $('#inputEmail, #inputPassword').each(function(){
            $(this).rules("add", "required")
        });
    }
    else {
        $('#login-data').slideUp();     //hide

        $('#inputEmail, #inputPassword').each(function(){
            $(this).rules("remove", "required")
        });
    }
});