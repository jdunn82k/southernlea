$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//Update Cart Total
function updateCart(){
    $.ajax({
        url: "/cart/stats",
        type: "get"
    }).done(function(cb){
        $(".simpleCart_total").text("$"+cb.total);
        $("#simpleCart_quantity").text(cb.count);
    });
}
//Get Filters from Product Listings Page
function getFilters(){
    var filters = {};
    if ($(".color-block-active").length > 0){
        filters.color = $(".color-block-active").data("id");
    }

    if ($("input[name='discount']:checked").length > 0){
        filters.discount = $("input[name='discount']:checked").val();
    }

    filters.sort_by = $("#sort-filter").val();
    return filters;
}

function pagination(current_page, total){


    if (total > 20){

        var html = "";
        var pages = Math.ceil(total / 20);
        var next_page = current_page + 1;

        if (current_page > 1){
            var prev_page = (current_page - 1);
        }

        if (current_page > 1){
            html += "<li class=\"page-item\"><a class=\"page-link product-page\" href=\"#\" data-page-num=\""+prev_page+"\">Previous Page</a></li>";
            html += "<li class=\"page-item\"><a class=\"page-link product-page\" href=\"#\" data-page-num=\""+(current_page - 1)+"\">"+(current_page - 1)+"</a></li>";
        }

        html += "<li class=\"page-item active\"><a class=\"page-link product-page\" href=\"#\" data-page-num=\""+current_page+"\">"+current_page+"</a></li>";


        if ( next_page <= pages){
            html += "<li class=\"page-item\"><a class=\"page-link product-page\" href=\"#\" data-page-num=\""+next_page+"\">"+next_page+"</a></li>";
        }

        if ( (current_page + 2) <= pages){
            html += "<li class=\"page-item\"><a class=\"page-link product-page\" href=\"#\" data-page-num=\""+(current_page + 2)+"\">"+(current_page + 2)+"</a></li>";
        }

        if (next_page <= pages){
            html += "<li class=\"page-item\"><a class=\"page-link product-page\" href=\"#\" data-page-num=\""+next_page+"\">Next Page</a></li>";
        }

        html += "<li class=\"page-item\"><a class=\"page-link\" id=\"view_all\" href=\"#\">View All</a></li>";

        $(".pagination").html(html);

    } else {
        $(".pagination").html("");
    }
}
function loadProducts(page=1, viewall=false){

    $("#product-listings").html("");
    var filters = getFilters();

    $.ajax({
        type: "post",
        url: "/product_table",
        data: {filters: filters, page: page, view_all: viewall}
    }).done(function(cb){

        var products = cb.products;
        var images   = cb.images;
        var product_count = Object.keys(products).length;
        if (!viewall){
            pagination(page, cb.products_count);
        } else {
            $(".pagination").hide();
        }
        $("#product-count").text(cb.products_count);
        if (product_count > 0){
            $.each(products, function(key, val){
                if (typeof images[val.id] !== 'undefined'){
                    var url = "";
                    $.each(images[val.id], function(key2, val2){
                        if (val2.default === 1){
                            url = val2.url;
                        }
                    });
                }

                var html = "<div class=\"product-block\">\n" +
                    "          <a href=\"/product/"+val.id+"\"><img src=\""+url+"\" class=\"img-responsive product-image\" alt=\"\"></a>\n" +
                    "           <div class=\"special-info grid_1 simpleCart_shelfItem\">\n" +
                    "              <h5 class=\"product-description\">\""+val.name+"\"</h5>\n" +
                    "               <div class=\"item_add\"><span class=\"item_price\"><h6>ONLY $"+val.price+"</h6></span></div>\n" +
                    "            </div>\n" +
                    "        </div>";


                $("#product-listings").append(html);

            });
        }
        $("#product-listings").fadeIn('slow');

    });

}

//Empty Cart button handler
$(".simpleCart_empty").on("click", function(e){
    e.preventDefault();
    $.ajax({
        url: "/cart",
        type: "delete"
    }) .done(function(){
        $(".simpleCart_total").text("$0.00");
        $("#simpleCart_quantity").text("0");
    })
});

//Add To Cart button handler
$("#add_to_cart").on("click", function(){
    var product_id      = $(this).data('product-id');
    var size_checked    = $("input[name='size-picker-radio']:checked").val();
    var qty             = $("#quantity").val();

    $.ajax({
        url: "/cart/add",
        type: "put",
        data: {product: product_id, size: size_checked, quantity: qty}
    }).done(function(cb){
        updateCart();
        $("#add_to_cart").text("added to cart").prop("disabled", true).css('background-color', '#f5f5f5').css('color', '#8c8585');
    });
});

$(document).on("click", ".remove-cart-item", function(){
   var row_id = $(this).data('row-id');
   $.ajax({
       url: "/cart/delete",
       type: "post",
       data: {rowId: row_id}
   }).done(function(cb){
      window.location.reload();
   });
});

//Change Main Product Details Photo
$(document).on("click", ".preview-photo > img", function(){
    $(".main-photo > img").attr('src', $(this).attr("src"));
});

// Load Default Product Listings Table
if ($("#product-listings").length){
    loadProducts();
}

// Discount Filter
$(document).on("click", "input[name='discount']", function(){
    loadProducts();
});

$(document).on("click", "#view_all", function(){
   loadProducts(1, true);
});

$(document).on("change", "#sort-filter", function(){
    loadProducts();
});

$('#list-tab a').on('click', function (e) {
    e.preventDefault()
    $(this).tab('show')
});

$(".size-picker-item").on("click", function(){
   $(this).find('input')[0].click();
});


//Color Block Filter
$(document).on("click", ".color-block", function(){
    if ($(this).hasClass('color-block-active')){
        $(this).removeClass('color-block-active');
        $(this).css('box-shadow', 'none');
        loadProducts();
    } else {
        $(".color-block-active").css('box-shadow', 'none').removeClass('color-block-active');
        $(this).addClass('color-block-active');
        $(this).css('box-shadow', '0px 0px 3px 2px '+$(this).css('background-color'));
        loadProducts();
    }

});

//Pagination Link handling
$(document).on("click", ".product-page", function(e){
    e.preventDefault();
    loadProducts($(this).data("page-num"), false);
});

