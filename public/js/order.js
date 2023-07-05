$(document).ready(function () {
    console.log("helo");
    $('input[type="radio"]').each(function () {
        $(this).prop('checked', false);
    })
    $('input[type="text"]').each(function () {
        $(this).val("");
    })
})

$("input[name='delivery']").on("change", function (e) {
    e.preventDefault();
    if($(this).val() != 1) {
        $(".adress").css({display: "block"});
    } else {
        $('input[type="text"]').each(function () {$(this).val("")});
        $(".adress").css({display: "none"});
    }
});

$(".sale__form-btn").on("click", function (event) {
    event.preventDefault();
    let _token = $("input[name='_token']").val()
    $.ajax({
        url: "/order/sale",
        type: "post",
        data: {_token:_token, sale: $(".sale__form-val").val()},
        dataType: "json",
        success: function (data) {
            if(data.error) {
                alert("Такого промокода нет(((");
                $(".sale__form-val").val("");
            }

            let totalPrice = parseInt($(".order__total-price").html());
            let salePrice = totalPrice * data.sale / 100;
            $(".order__sale").html(salePrice + " р.");
            $(".order__price-sale").html(totalPrice - salePrice + " р.")
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR, textStatus, errorThrown);
        }
    })
})

$(".order__submit").on("click", function (event) {
    event.preventDefault();
    let _token = $("input[name='_token']").val()


    let delivery = $(".delivery__form input:checked").val();
    let payment = $(".payment__form input:checked").val();

    let street = $(".adress__street-name").val();
    let house = $(".adress__street-house").val();
    let city = $(".adress__city").val();
    let country = $(".adress__country").val();

    let sale = $(".sale__form-val").val();

    $.ajax({
        url: "/order/add",
        type: "post",
        async: true,
        data: {_token:_token,
            delivery: delivery,
            payment: payment,
            adress: {
                street: street,
                house:house,
                city: city,
                country: country
            },
            sale: sale

        },
        dataType: "json",
        success: function (data) {

            console.log(data);
            if(data.res === 1) {
                alert("Добавлено");
                window.location.href = "/catalog";
                // console.log(data);
            } else {
                $(".valid").each(function(){
                    $(this).css({"border": "1px solid #C4C4C4"})
                });

                alert("Заполните все поля");
                for (key in data.errors) {
                    $("." + key + "__error").css({"border": "1px solid #FF4823FF"});
                }
             }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR, textStatus, errorThrown);
        }

    });
})
