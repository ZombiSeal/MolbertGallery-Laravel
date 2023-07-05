
$(document).ready(function() {
    $(".edit").on("input", function (e){
        e.preventDefault();
        let value = $(this).attr("name");
        let _token = $("input[name='_token']").val()
        $.ajax({
            url: $(this).closest(".register-form").attr("action"),
            type: "post",
            data: {_token:_token, [value]: $(this).val(), name: $(this).attr("name")},
            dataType: "json",
            success: function(data) {
                console.log(data.error);
                if (data.error.length !== 0) {
                    $(e.target).next(".error").html(data.error[value]);
                } else {
                    $(e.target).next(".error").html("");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR,textStatus, errorThrown);
            }
        });
     });

    $(".repeat-password").on("input", function (e){
        e.preventDefault();
        let _token = $("input[name='_token']").val()
        $.ajax({
            url: $(this).closest(".register-form").attr("action"),
            type: "post",
            data: {_token:_token, passwordRepeat: $(this).val(), password: $('.password').val(), name: $(this).attr("name")},
            dataType: "json",
            success: function(data) {
                console.log(data);
                if (data.error.length !== 0) {
                    $(e.target).next(".error").html(data.error.passwordRepeat);
                } else {
                    $(e.target).next(".error").html("");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR,textStatus, errorThrown);
            }
        });
    });


    $(".emailExist").on("focusout", function( e ) {
        e.preventDefault();
        let _token = $("input[name='_token']").val();
        $.ajax({
            url: $(this).closest(".register-form").attr("action"),
            type: "post",
            async: true,
            data: {_token:_token, emailExist: $(this).val(), name: 'emailExist'},
            dataType: 'json',
            success: function(data) {
                if (data.error.length !== 0) {
                    $(e.target).next(".error").html(data.error.emailExist);
                }
                console.log(data.error);
            },
            error: function(data) {
                console.log(data.responseJSON.errors);
            }
        });
    });

    $(".register-form").on("submit", function( e ) {
        e.preventDefault();
        let _token = $("input[name='_token']").val();
        $.ajax({
            url: '/registration/create',
            type: "post",
            async: true,
            data: {_token:_token,
                firstName: $(".firstName").val(),
                lastName: $(".lastName").val(),
                email: $(".email").val(),
                emailExist: $(".email").val(),
                password: $(".password").val(),
                passwordRepeat: $(".repeat-password").val()},
            dataType: 'json',
            success: function(data) {
                if(data['status'] === 0) {
                    for(key in data['errors']) {
                        $('.' + key).next('.error').html(data['errors'][key][0]);
                    }
                } else {
                    console.log(data['data']);
                    window.location.href = '/login';
                }
            },
            error: function(data) {
                console.log(data.responseJSON.errors);
            }
        });
    });
});
