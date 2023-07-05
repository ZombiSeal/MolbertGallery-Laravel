$(document).ready(function (){
    $.ajax({
        url: "/data",
        type: "get",
        data: {_toke:_token},
        dataType: "json",
        success: function (data) {
            console.log(data);
            $(".firstname").val(data.user.firstname);
            $(".lastname").val(data.user.lastname);
            $(".email").val(data.user.email);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR, textStatus, errorThrown);
        }
    });

    $(".user-account__link").on("click", function (e) {
        if($(this).attr('data-href') !== "exit") {
            e.preventDefault();
            $(".user-account__link").each( function (index, el) {
                if($(el).hasClass("user-account__link_active")) {
                    $(el).removeClass("user-account__link_active");
                }
            })
            $(this).addClass("user-account__link_active");

            let url = $(this).attr('href');
            let route = url.split("/");
            route = "/" + route[route.length - 2] + "/" + route[route.length - 1] ;

            $('.user-account__info').load($(this).attr('href') , route);
        }

    })

    $(document).on("click", ".accordion-header", function(e) {
        $('.accordion-body').not($(this).next()).slideUp(300);
        $(this).next().slideToggle(800);
    });

    $(".user-account__form-data").on("submit", function (e) {
        e.preventDefault();
        let _token = $("input[name='_token']").val();
        let firstname = $('#inf-firstname').val();
        let lastname = $('#inf-lastname').val();
        let email = $('#inf-email').val();

        $.ajax({
            url: $(this).attr('action'),
            type: "post",
            data: {_token:_token, firstName: firstname, lastName: lastname, email:email, emailExist:email},
            dataType: "json",
            success: function (data) {
                console.log(data);
                $(".error").each(function(){$(this).html("")});
                for(key in data['errors']) {
                        $('.' + key + '__error').html(data['errors'][key][0]);
                    }
                if(data['res'] == 1) {alert("Изменено")}

                    // $('.user-account__info').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR, textStatus, errorThrown);
            }
        });

    })


    $(".user-account__form-pass ").on("submit", function (e) {
        e.preventDefault();
        let _token = $("input[name='_token']").val();
        let userPassword = $('#inf-user-pass').val();
        let password = $('#inf-password').val();
        let passwordRepeat = $('#inf-pass-repeat').val();

        $.ajax({
            url: $(this).attr('action'),
            type: "post",
            data: {_token:_token, userPassword: userPassword, password: password, passwordRepeat:passwordRepeat},
            dataType: "json",
            success: function (data) {
                console.log(data);
                $(".error").each(function(){$(this).html("")});
                for(key in data['errors']) {
                    $('.' + key + '__error').html(data['errors'][key][0]);
                }
                if(data['res'] == 1) {alert("Изменено")}

                // $('.user-account__info').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR, textStatus, errorThrown);
            }
        });

    })
})


