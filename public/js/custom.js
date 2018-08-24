$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



// Load Default Product Listings Table
if ($("#product-listings").length){
    $.ajax({
        type: "get",
        url: "/product_table/asc"
    }).done(function(cb){

        var products = cb.products;
        var images   = cb.images;

        if (Object.keys(products).length > 0){
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
                    "          <a href=\"details.html\"><img src=\""+url+"\" class=\"img-responsive product-image\" alt=\"\"></a>\n" +
                    "           <div class=\"special-info grid_1 simpleCart_shelfItem\">\n" +
                    "              <h5 class=\"product-description\">\""+val.name+"\"</h5>\n" +
                    "               <div class=\"item_add\"><span class=\"item_price\"><h6>ONLY $"+val.price+"</h6></span></div>\n" +
                    "            </div>\n" +
                    "        </div>";

                $("#product-listings").append(html);
            });
        }


    });
}
