let _token = $("input[name='_token']").val();

$(".buy").on("click", function (e) {
    e.preventDefault();
    id_product = $(e.target).attr("data-id");

    $.ajax({
        url: "/cart/add",
        type: "post",
        async: true,
        data: {_token:_token, id_product: id_product},
        dataType: "json",
        success: function (data) {
            if(data.add === 1) {
                $(e.target).attr("disabled", true);
                $(e.target).html("В корзине");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR, textStatus, errorThrown);
        }

    });
})

$(".table__close").on("click", function (e) {
    e.preventDefault();
    let id_product = $(e.target).attr("data-id");
    let totalPrice = parseInt($(".total-price__val").html());
    let currentPrice = $(e.target).parent('td').prev('.table__price').html();
    console.log(totalPrice);
    $.ajax({
        url: "/cart/remove",
        type: "post",
        async: true,
        data: {_token:_token, id_product: id_product, totalPrice:totalPrice, currentPrice: currentPrice},
        dataType: "json",
        success: function (data) {
            console.log(data);
            $(e.target).closest("tr").remove();
            $(".total-price__val").html(data.totalPrice + " р.");

            if(data.basket === null) {
                $(".basket__wrapper").html("Корзина пустая");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR, textStatus, errorThrown);
        }

    });

})
