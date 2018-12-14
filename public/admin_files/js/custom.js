$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function() {

    $('#side-menu').metisMenu();

});

$(function(){
   $(".datepicker").datepicker();
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
});




$(function(){

    $("#add-product-button").on("click", function(){
        var description_1   = $("#desc1").val();
        var description_2   = $("#txtarea1").val();
        var additional      = $("#txtarea2").val();
        var category        = $("#product-topcategory").val();
        var subcategory     = $("#product-category").val();
        var categorylinks   = $("#product-categorylink").val();
        var price           = $("#product-price").val();
        var quantityInStock = $("#product-quantity").val();
        var shipping        = $("#product-shipping").val();
        var special         = $("input[name='special-offer']:checked").val();

        if (description_1 == ""){
            $("#error-message").text("Product Name Required");
            $("#messages").modal('toggle');
            return false;
        }

        if (category === "blank"){
            $("#error-message").text("Category Required");
            $("#messages").modal('toggle');
            return false;
        }

        if (subcategory === "blank"){
            $("#error-message").text("Top Level Category Required");
            $("#messages").modal('toggle');
            return false;
        }

        if (categorylinks === "blank"){
            $("#error-message").text("SubCategory Required");
            $("#messages").modal('toggle');
            return false;
        }

        if (price === ""){
            $("#error-message").text("Price Required");
            $("#messages").modal('toggle');
            return false;

        }

        if (shipping === ""){
            $("#error-message").text("Shipping Cost Required");
            $("#messages").modal('toggle');
            return false;

        }

        if (quantityInStock === ""){
            $("#error-message").text("Quantity Required");
            $("#messages").modal('toggle');
            return false;
        }

        var new_sizes           = [];
        $(".new-size").each(function(){
            $this = $(this);
            var size        = $this.find("#size-select").val();
            var price       = $this.find(".product-price").val();
            var quantity    = $this.find(".product-quantity").val();

            new_sizes.push( {size: size, price: price, quantity: quantity} );
        });

        //Check for images
        var new_images = [];
        var defaultImage;
        $(".photo-block-image").each(function(){
           var img_name = $(this).find("input[type='checkbox']").data('photo-url');
           if ($(this).find("input[type='checkbox']").parent().hasClass('photo-select')){
               defaultImage = $(this).find("input[type='checkbox']").data('photo-url');
           }
           new_images.push(img_name);
        });

        $.ajax({
            url: "/admin/product/new",
            type: "post",
            data: {
                description_1: description_1,
                description_2: description_2,
                additional: additional,
                category: category,
                subcategory: subcategory,
                categorylink: categorylinks,
                price: price,
                shipping:shipping,
                new_sizes: new_sizes,
                defaultImage: defaultImage,
                quantity: quantityInStock,
                new_images: new_images,
                special:special
            }
        }).done(function(cb){
            $("#added-modal").modal('toggle');
        });
    });

    $(document).on("click", ".product-radio",function(){

        $(".after-product-select").fadeIn('fast');

        $.ajax({
            url: "/admin/image/"+$(this).data('id'),
            type: "get"
        }).done(function(cb){

            $(".photo-block").remove();
            $.each(cb, function(key,val){
                $("#image-pane").append('<div class="photo-block m-3">\n' +
                    '                <div class="photo-block-image">\n' +
                    '                   <div>\n' +
                    '                     <input type="radio" name="photo-boxes" class="photo-radios" data-photo-url="'+val.url+'" data-photo-id="'+val.id+'">\n' +
                    '                     <img src="../../'+val.url+'" class="img-responsive" alt="">\n' +
                    '                   </div>\n' +
                    '                 </div>\n' +
                    '              </div>')
            });
            $("input[name='photo-boxes']").prop("checked", true);


        })
    });

    $("#add-special").on("click", function(){
        var option = $("#select-option").val();
        if (option === "1"){
            var selected = $(".product-radio:checked").data('id');
            var price     = $("#special-price").val();
            if (price === ""){
                $("#error-message").text("Price Is Required");
                $("#messages").modal("toggle");
                return false;
            }

            var image = $(".photo-radios:checked").data('photo-url');
            if (typeof image === 'undefined'){
                $("#error-message").text("Select An Image");
                $("#messages").modal('toggle');
                return false;
            }

            var size = $("input[name='show-size']:checked").val();

            var desc = $(".product-radio:checked").parent().next()[0].innerText;


            $.ajax({
               url: "/admin/special/add",
               type: "post",
               data: {product_id: selected, price: price, image: image, desc: desc, size:size}
            }).done(function(cb){
                window.location.reload();
            });
        }

        if (option === "2"){

            var price     = $("#special-price").val();

            if (price === ""){
                $("#error-message").text("Price Is Required");
                $("#messages").modal("toggle");
                return false;
            }

            var image = $(".photo-radios:checked").data('photo-url');

            if (typeof image === 'undefined'){
                $("#error-message").text("Select An Image");
                $("#messages").modal('toggle');
                return false;
            }

            var size = $("input[name='show-size']:checked").val();

            var desc = $("#product-name").val();

            if (desc === ""){
                $("#error-message").text("Product Name is required");
                $("#messages").modal('toggle');
                return false;
            }


            $.ajax({
                url: "/admin/special/add",
                type: "post",
                data: {price: price, image: image, desc: desc, size:size}
            }).done(function(cb){
                window.location.reload();
            });
        }
    });
    $("#select-option").on("change", function(){

       if ($(this).val() === "1"){
           $(".new-product").hide();
           $(".existing-product").fadeIn('fast');
           setTimeout(function(){
               $("#special-offers-dt").dataTable({
                   columnDefs:[
                       {
                           orderable:false,
                           searchable:false,
                           targets:0

                       }
                   ],
                   paging:false,
                   info:false,
                   "scrollY":        "200px",
                   "scrollCollapse": true,
               });
           }, 100);
       } else if ($(this).val() === "2"){
           $("#special-offers-dt").DataTable().destroy();
           $(".existing-product").hide();

            $(".new-product").fadeIn('fast');
            $(".after-product-select").fadeIn('fast');
       }
    });

    $("#add-new-offer").on("click", function(){
       $(".edit-offer").addClass('hide');
       $(".add-offer").fadeIn('fast').removeClass('hide');
    });

    $("#update-special").on("click", function(){
        var special_id = $("#update-special-id").val();
        var name        = $("#product-name-2").val();
        var price       = $("#special-price-2").val();
        var size        = $("input[name='show-size-2']:checked").val();
        var image       = "img/"+$(".photo-radios:checked").data('photo-url');

        $.ajax({
            url: "/admin/special/update",
            type: "post",
            data: {special_id: special_id, name: name, price: price, size: size, image: image}
        }).done(function(cb){
           window.location.reload();
        });

    });
    $("#edit-offer").on("click", function(){
        var checked = $(".special-check:checked").data('id');
        if (typeof checked === "undefined"){
            return false;
        }

        $.ajax({
            url: "/admin/special/get/"+checked,
            type: "get",
        }).done(function(cb){

            $("#update-special-id").val(cb.id);
            $("#product-name-2").val(cb.name);
            $("#special-price-2").val(cb.price);
            if (cb.size === 1){
                $("#show-size-3").prop("checked", true);
            }

            $(".photo-block").remove();
            if (cb.image !== null){

                $("#image-pane-4").append('<div class="photo-block m-3">\n' +
                    '                <div class="photo-block-image">\n' +
                    '                   <div>\n' +
                    '                     <input type="radio" name="photos-radio" class="photo-radios" data-photo-url="'+cb.image+'" checked>\n' +
                    '                     <img src="../../'+cb.image+'" class="img-responsive" alt="">\n' +
                    '                   </div>\n' +
                    '                 </div>\n' +
                    '              </div>');
            }

            if (cb.product_id !== null){
                $.ajax({
                    url: "/admin/image/"+cb.product_id,
                    type: "get"
                }).done(function(cb1){


                    $.each(cb1, function(key,val){
                        $("#image-pane-4").append('<div class="photo-block m-3">\n' +
                            '                <div class="photo-block-image">\n' +
                            '                   <div>\n' +
                            '                     <input type="radio" name="photos-radio" class="photo-radios" data-photo-url="'+val.url+'" data-photo-id="'+val.id+'">\n' +
                            '                     <img src="../../'+val.url+'" class="img-responsive" alt="">\n' +
                            '                   </div>\n' +
                            '                 </div>\n' +
                            '              </div>');

                            if (val.url !== null){

                                $(".photo-radios").each(function(){
                                    if ($(this).data('photo-url') === cb.image){
                                        $(this).prop("checked", true);
                                    }
                                });
                            }
                    });



                });
            }



            $(".add-offer").addClass('hide');
            $(".edit-offer").fadeIn('fast').removeClass('hide');
        })


    });

    $(".delete-image-edit").on("click", function(){
        var checked = $("input[name='photos-radio']:checked").data('photo-url');
        $.ajax({
            url: "/admin/removeimage",
            type: "post",
            data: {url: checked}
        }).done(function(cb){
            $("input[name='photos-radio']:checked").parent().parent().parent().remove();
            $("input[name='photos-radio']").prop("checked", true);
        });

    });

    $(".delete-new-image").on("click", function(){
        var checked = $("input[name='photo-boxes']:checked").data('photo-url');
        $.ajax({
            url: "/admin/removeimage",
            type: "post",
            data: {url: checked}
        }).done(function(cb){
            $("input[name='photo-boxes']:checked").parent().parent().parent().remove();
            $("input[name='photo-boxes']").prop("checked", true);
        });
    });
    $("#product-category").on("change", function(){
        var top = $(this).val();
        $.ajax({
            url: "/admin/product/getlinks",
            type: "post",
            data: {id: top}
        }).done(function(cb){
            var html = "<option value='blank'></option>";
            $.each(cb, function(key, val){
                html += "<option value='"+val.id+"'>"+val.name+"</option>";
            });
            $("#product-categorylink").html(html);
        });
    });

    $("#product-topcategory").on("change", function(){
        var top = $(this).val();
        $.ajax({
            url: "/admin/product/getcat",
            type: "post",
            data: {id: top}
        }).done(function(cb){
            var html = "<option value='blank'></option>";
            $.each(cb, function(key, val){
               html += "<option value='"+val.id+"'>"+val.name+"</option>";
            });
            $("#product-category").html(html);
            $("#product-categorylink").html("<option value='blank'></option>");
        });
    });

    $("#submit-product-changes").on("click", function(){

        var product_id      = $("#product-id").val();
        var description_1   = $("#desc1").val();
        var description_2   = $("#txtarea1").val();
        var additional      = $("#txtarea2").val();
        var category        = $("#product-topcategory").val();
        var subcategory     = $("#product-subcategory").val();
        var categorylink    = $("#product-categorylink").val();
        var price           = $("#product-price").val();
        var shipping        = $("#product-shipping").val();
        var defaultImage    = $(".photo-select input").data("photo-id");
        var quantityInStock        = $("#product-quantity").val();
        var special         = $("input[name='special-offer']:checked").val();

        if (description_1 == ""){
            $("#error-message").text("Product Name Required");
            $("#messages").modal('toggle');
            return false;
        }

        if (category === "0"){
            $("#error-message").text("Category Required");
            $("#messages").modal('toggle');
            return false;

        }

        if (price === ""){
            $("#error-message").text("Price Required");
            $("#messages").modal('toggle');
            return false;

        }

        if (shipping === ""){
            $("#error-message").text("Shipping Cost Required");
            $("#messages").modal('toggle');
            return false;

        }

        if (quantityInStock === ""){
            $("#error-message").text("Quantity Required");
            $("#messages").modal('toggle');
            return false;
        }

        var new_sizes           = [];
        $(".new-size").each(function(){
            $this = $(this);
            var size        = $this.find("#size-select").val();
            var code        = $this.find(".product-code").val();
            var price       = $this.find(".product-price").val();
            var quantity    = $this.find(".product-quantity").val();

            new_sizes.push( {size: size, code: code, price: price, quantity: quantity} );
        });

        var existing_sizes      = [];
        $(".existing").each(function(){
            $this = $(this);

            var id          = $this.prop('id').replace("size_", "");

            existing_sizes.push( id );
        });


        $.ajax({
            url: "/admin/product/update",
            type: "post",
            data: {
                product_id: product_id,
                description_1: description_1,
                description_2: description_2,
                category: category,
                subcategory: subcategory,
                categorylink: categorylink,
                additional: additional,
                price: price,
                shipping:shipping,
                new_sizes: new_sizes,
                existing_sizes: existing_sizes,
                defaultImage: defaultImage,
                quantity: quantityInStock,
                special:special
            }
        }).done(function(cb){
            window.location.reload();
        });

    });

    $(".newtransaction").on("click", function(){
       $("#expense-table-pane").addClass("hide");
       $("#new-expense-pane").removeClass("hide");
    });

    $(".backtoexpenses").on("click", function(){
        $("#new-expense-pane").addClass("hide");
        $("#edit-expense-pane").addClass("hide");
        $("#expense-table-pane").removeClass("hide");
    });

    $("#update_cancel").on("click", function(){
        $("#expense-table-pane").removeClass("hide");
        $("#edit-expense-pane").addClass("hide");
    });

    $("#select-page").on("click", function(){
        $(".expense-checkbox").each(function(i){
            $(this).prop("checked", true);
        });
    });

    $("#select-all").on("click", function(){
        var table = $("#expenses_table").DataTable();
        var rows = table.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', true);
    });

    $("#unselect").on("click", function(){
        var table = $("#expenses_table").DataTable();
        var rows = table.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', false);
    });

    $("#delete-selected").on("click", function(e){
        e.preventDefault();
        $("#confirm_delete").modal('toggle');
    });

    $(".delete-selected").on("click", function(){
        var table = $("#expenses_table").DataTable();
        var rows = table.rows({ 'search': 'applied' }).nodes();
        var ids = [];
        $('input[type="checkbox"]', rows).each(function(){
            if ($(this).is(":checked")){
                ids.push($(this).data("exp-id"));
            }
        });

        $.ajax({
            url: "/admin/expenses",
            type: "delete",
            data: {ids : ids}

        }).done(function(cb){
            window.location.reload();
        });

    });

    $(".filter-option").on("click", function(){
        var filter = $(this).data("filter");
        var table = $("#expenses_table").DataTable();
        table.destroy();

        $(".expenses-table").addClass("hide");
        $(".loading_gif").show();

        $.ajax({
            url: "/admin/expenses/table",
            type: "post",
            data: {filter: filter}
        }).done(function(cb){
            var tableHtml = "";
            $.each(cb, function(i,v){
                tableHtml += "<tr>\n" +
                    "<td><input type=\"checkbox\" class=\"expense-checkbox\" data-exp-id=\""+v.id+"\"></td>\n" +
                    "<td>"+v.date+"</td>\n" +
                    "<td>"+v.account+"</td>\n" +
                    "<td>"+v.check_num+"</td>\n" +
                    "<td>"+v.payee+"</td>\n" +
                    "<td>"+v.category+"</td>\n" +
                    "<td>$"+v.amount+"</td>\n" +
                    "<td><a href='#' class='view_edit_expense' data-exp-id=\""+v.id+"\">View/Edit</a></td>\n" +
                    "</tr>"
            });
            $(".loading_gif").hide();
            $(".expenses-table").removeClass("hide");
            $("#expenses_table > tbody").html(tableHtml);
            $("#expenses_table").dataTable({
                "columnDefs":[
                    {"orderable": false, "targets": [0,7]}
                ],
                "order" : [[1, "desc"]]
            });
        });
    });
    $(document).on("click", ".view_edit_expense", function(e){
        e.preventDefault();
        $.ajax({
            url: "/admin/expense/"+$(this).data("exp-id"),
            type: "get"
        }).done(function(cb){

            $("#update_exp_id").val(cb.id);
            $("#update_expense_date").val(cb.date);
            $("#update_payee").val(cb.payee);
            $("#update_payee_selected").val(cb.payee_id);
            $("#update_category").val(cb.category);
            $("#update_category_selected").val(cb.category_id);
            $("#update_account").val(cb.account);
            $("#update_account_selected").val(cb.account_id);
            $("#update_description").val(cb.description);
            $("#update_check_num").val(cb.check_num);
            $("#update_amount").val(cb.amount);
            $("#update_memo").val(cb.memo);
            $("#expense-table-pane").addClass("hide");
            $("#edit-expense-pane").removeClass("hide");
        });
    });



    $(document).on("click", ".account-option", function(){
        $("#account").val($(this).text());
        $("#account_selected").val($(this).data("id"));
    });

    $(document).on("click", ".category-option", function(){
       $("#category").val($(this).text());
       $("#category_selected").val($(this).data("id"));
    });

    $(document).on("click", ".payee-option",  function(){
        $("#payee").val($(this).text());
        $("#payee_selected").val($(this).data("id"));
    });

    $(document).on("click", ".update-payee-option", function(){
       $("#update_payee").val($(this).text());
       $("#update_payee_selected").val($(this).data("id"));
    });

    $(document).on("click", ".update-category-option", function(){
        $("#update_category").val($(this).text());
        $("#update_category_selected").val($(this).data("id"));
    });

    $(document).on("click", ".update-account-option", function(){
        $("#update_account").val($(this).text());
        $("#update_account_selected").val($(this).data("id"));
    });

    $(document).on("keyup", "#account", function(){
       $("#account_selected").val("");
    });

    $(document).on("keyup", "#category", function(){
        $("#category_selected").val("");
    });

    $(document).on("keyup", "#payee", function(){
        $("#payee_selected").val("");
    });

    $(document).on("keyup", "#update_account", function(){
        $("#update_account_selected").val("");
    });

    $(document).on("keyup", "#update_payee", function(){
        $("#update_payee_selected").val("");
    });

    $(document).on("keyup", "#update_category", function(){
       $("#update_category_selected").val("");
    });


    $("#update_expense").on("click", function(){
        var data = {};

        var date = $("#update_expense_date").val();
        if (date.length === 0){
            $(".error-message").html("Expense date is required");
            $("#error_modal").modal("toggle");
            return false;
        }

        var payee = $("#update_payee").val();
        if (payee.length === 0){
            $(".error-message").html("Payee is required");
            $("#error_modal").modal("toggle");
            return false;
        }

        var amount = $("#update_amount").val();
        if (amount.length === 0){
            $(".error-message").html("Amount is required");
            $("#error_modal").modal("toggle");
            return false;
        }

        data.date           = date;
        data.payee_text     = payee;
        data.payee_id       = $("#update_payee_selected").val();
        data.category_text  = $("#update_category").val();
        data.category_id    = $("#update_category_selected").val();
        data.account_text   = $("#update_account").val();
        data.account_id     = $("#update_account_selected").val();
        data.description    = $("#update_description").val();
        data.check_num      = $("#update_check_num").val();
        data.amount         = amount;
        data.memo           = $("#update_memo").val();
        data.id             = $("#update_exp_id").val();

        $.ajax({
            url: "/admin/expenses/",
            type: "put",
            data: data
        }).done(function(cb){
            window.location.reload();
        });
    });
    $("#add_expense").on("click", function(){
        var data = {};

        var date = $("#expense_date").val();
        if (date.length === 0){
            $(".error-message").html("Expense date is required");
            $("#error_modal").modal("toggle");
            return false;
        }

        var payee = $("#payee").val();
        if (payee.length === 0){
            $(".error-message").html("Payee is required");
            $("#error_modal").modal("toggle");
            return false;
        }

        var amount = $("#amount").val();
        if (amount.length === 0){
            $(".error-message").html("Amount is required");
            $("#error_modal").modal("toggle");
            return false;
        }

        data.date           = date;
        data.payee_text     = payee;
        data.payee_id       = $("#payee_selected").val();
        data.category_text  = $("#category").val();
        data.category_id    = $("#category_selected").val();
        data.account_text   = $("#account").val();
        data.account_id     = $("#account_selected").val();
        data.description    = $("#description").val();
        data.check_num      = $("#check_num").val();
        data.amount         = amount;
        data.memo           = $("#memo").val();

        $.ajax({
            url: "/admin/expenses/",
            type: "post",
            data: data
        }).done(function(cb){
            window.location.reload();
        });
    });



    // function loadExpensesTable(filters){
    //     $.ajax({
    //         url: "/admin/expenses/table",
    //         type: "post",
    //         data: {filters: filters}
    //     }).done(function(cb){
    //         var tableHtml = "";
    //         $.each(cb, function(i,v){
    //             tableHtml += "<tr>\n" +
    //                 "<td><input type=\"checkbox\" class=\"expense-checkbox\" data-exp-id=\""+v.id+"\"></td>\n" +
    //                 "<td>"+v.date+"</td>\n" +
    //                 "<td>"+v.account+"</td>\n" +
    //                 "<td>"+v.check_num+"</td>\n" +
    //                 "<td>"+v.payee+"</td>\n" +
    //                 "<td>"+v.category+"</td>\n" +
    //                 "<td>$"+v.amount+"</td>\n" +
    //                 "<td><a href='#' class='view_edit_expense'>View/Edit</a></td>\n" +
    //                 "</tr>"
    //         });
    //         $("#expenses_table > tbody").html(tableHtml);
    //         $("#expenses_table").dataTable();
    //     });
    // }

    //
    // $("#account").on("keyup", function(){
    //     $("#account_selected").val("");
    //     var currentText = $(this).val().toLowerCase();
    //     var textArray   = currentText.split("");
    //     var elements    = $(".accounts-dropdown > li");
    //     var halt        = false;
    //
    //     if (textArray.length === 0){
    //         if ($(".check-for-account").hasClass("open")){
    //             $(".accounts-dropdown").dropdown('toggle');
    //         }
    //         for (var o = 0; o<elements.length;o++){
    //             $(elements[o]).show();
    //         }
    //         return false;
    //     }
    //
    //
    //     for (var o = 0; o<elements.length;o++){
    //         var $this   = elements[o];
    //         var id      = $($this).data("id");
    //         var name    = $($this).text().toLowerCase().split("");
    //         for(var i = 0; i<textArray.length;i++){
    //
    //             if (textArray[i] === name[i])
    //             {
    //
    //                 if (!$(".check-for-account").hasClass("open")){
    //                     $(".accounts-dropdown").dropdown('toggle');
    //                 }
    //                 $($this).show();
    //
    //             } else {
    //                 if ($(".check-for-account").hasClass("open")){
    //                     $(".accounts-dropdown").dropdown('toggle');
    //                 }
    //                 $($this).hide();
    //             }
    //         }
    //     }
    // });
    //
    //
    // $("#category").on("keyup", function(){
    //     $("#category_selected").val("");
    //     var currentText = $(this).val().toLowerCase();
    //     var textArray   = currentText.split("");
    //     var elements    = $(".category-dropdown > li");
    //     var halt        = false;
    //
    //     if (textArray.length === 0){
    //         if ($(".check-for-category").hasClass("open")){
    //             $(".category-dropdown").dropdown('toggle');
    //         }
    //         for (var o = 0; o<elements.length;o++){
    //             $(elements[o]).show();
    //         }
    //         return false;
    //     }
    //     for (var o = 0; o<elements.length;o++){
    //         var $this   = elements[o];
    //         var id      = $($this).data("id");
    //         var name    = $($this).text().toLowerCase().split("");
    //
    //         for(var i = 0; i<textArray.length;i++){
    //             if (textArray[i] === name[i])
    //             {
    //                 if (!$(".check-for-category").hasClass("open")){
    //                     $(".category-dropdown").dropdown('toggle');
    //                 }
    //                 $($this).show();
    //
    //             } else {
    //                 if ($(".check-for-category").hasClass("open")){
    //                     $(".category-dropdown").dropdown('toggle');
    //                 }
    //                 $($this).hide();
    //             }
    //         }
    //     }
    // });
    //
    // $("#payee").on("keyup", function(){
    //     $("#payee_selected").val("");
    //     var currentText = $(this).val().toLowerCase();
    //     var textArray   = currentText.split("");
    //     var elements    = $(".payee-dropdown > li");
    //     var halt        = false;
    //
    //     if (textArray.length === 0){
    //         if ($(".check-for-payee").hasClass("open")){
    //             $(".payee-dropdown").dropdown('toggle');
    //         }
    //         for (var o = 0; o<elements.length;o++){
    //             elements[0].show();
    //         }
    //         return false;
    //     }
    //     for (var o = 0; o<elements.length;o++){
    //         var $this   = elements[o];
    //         var id      = $($this).data("id");
    //         var name    = $($this).text().toLowerCase().split("");
    //
    //         for(var i = 0; i<textArray.length;i++){
    //             if (textArray[i] === name[i])
    //             {
    //                 if (!$(".check-for-payee").hasClass("open")){
    //                     $(".payee-dropdown").dropdown('toggle');
    //                 }
    //                 $($this).show();
    //
    //             } else {
    //                 if ($(".check-for-payee").hasClass("open")){
    //                     $(".payee-dropdown").dropdown('toggle');
    //                 }
    //                 $($this).hide();
    //             }
    //         }
    //     }
    // });

    $(document).on("click", "#sizes-available i.fa-trash", function(){
        $(this).parent().parent().remove();
    });


    $(document).on("click", ".edit-category", function(){
       $(this).parent().parent().find('.hide').removeClass('hide');
       $(this).parent().parent().find('p').addClass('hide');
    });

    $(document).on("click", ".cancel-update", function(){
        $(this).parent().parent().parent().find('.form-group').addClass('hide');
        $(this).parent().parent().parent().find('.button-holder').addClass('hide');
        $(this).parent().parent().parent().find('input').addClass('hide');
        $(this).parent().parent().parent().find('p').removeClass('hide');

    });

    $(document).on("click", ".add-new-sub-line", function(){
       $(this).parent().before("<span><input type='text' class='form-control mb-10 subcat-update-value'><i class='fa fa-trash remove-subcat-line2'></i></span>");
    });

    $(document).on("click", ".add-new-sub-line2", function(){
        $(this).parent().before("<input type='text' class='form-control mb-10 subcat-update-value'>");
    });

    $("#top-level-cat").on("change", function(){
        $(".hidden-tables").addClass('hide');
        $("#table_for_"+$(this).val()+" .top-level-name").text($("#top-level-cat option:selected").text())
        $("#table_for_"+$(this).val()).fadeIn('slow').removeClass('hide');
    });
    $(document).on("click", ".update-categories", function(){
        var cat_id = $(this).data('cat-id');
        var cat_name = $("#input_cat_"+cat_id).val();
        var sub_cats = $(this).parent().parent().find(".subcat-update-value");
        var sub_cats_a = [];

        if ($.trim(cat_name).length === 0){
            $("#error-message").text("Category Name Required");
            $("#messages").modal('toggle');
            return false;
        }

        $.each(sub_cats, function(key,val){
            if ($.trim($(val).val()).length !== 0)
            {
                if (typeof $(val).data('subcat-id') === 'undefined'){
                    var subcat_id = 0;
                } else {
                    var subcat_id = $(val).data('subcat-id');
                }

                sub_cats_a.push( [subcat_id, $.trim($(val).val())] );
            }
        });

        $.ajax({
            url: "/admin/categories/update",
            type: "post",
            data: {
                cat_name: cat_name,
                cat_id: cat_id,
                sub_cats: sub_cats_a
            }
        }).done(function(cb){
            window.location.reload();
        });

    });
    $(document).on("click", "#yes-delete-subcat", function(){
        $(".subcat_"+$("#selected-subcat-id").val()).remove();
        $("#confirm-subcat-delete").modal('toggle');
        $("#count").text("");
        $("#selected-subcat-id").val("");
    });

    $(document).on("click", ".delete-top-level", function(){
       $("#selected-cat-id").val($(this).data('cat-id'));
       $("#confirm-cat-delete").modal('toggle');
    });

    $(document).on("click", ".yes-delete-cat", function(){
       $.ajax({
           url: "/admin/categories/delete",
           type: "post",
           data: {cat_id: $("#selected-cat-id").val()}
       }).done(function(cb){
           window.location.reload();
       })
    });

    $(document).on("click", ".delete-category", function(){
        $("#selected-cat-id2").val($(this).data('cat-id'));
        $("#confirm-cat-delete2").modal('toggle');
    });

    $(document).on("click", "#yes-delete-cat2", function(){
        $.ajax({
            url: "/admin/categories/delete2",
            type: "post",
            data: {cat_id: $("#selected-cat-id2").val()}
        }).done(function(cb){
            window.location.reload();
        })
    });






    $(document).on("click", ".remove-subcat-line2", function(){
        $(this).parent().remove();
    });
    $(document).on("click", ".remove-subcat-line", function(){
        var subcat_id = parseInt($(this).prop('id').replace("subcat_", ""));
        $.ajax({
            url: "/admin/categories/check",
            type: "post",
            data: {subcat: subcat_id}
        }).done(function(cb){
            var count = cb.length;
            $("#count").text(count);
            $("#selected-subcat-id").val(subcat_id);
            $("#confirm-subcat-delete").modal('toggle');
        });
    });

    $(document).on("click", ".show-hidden-form", function(){
        $(this).parent().parent().parent().find('tr.hide').removeClass('hide');

        $(this).parent().parent().remove();
    });

    $(document).on("click", ".add-category", function(){
        var cat_id = $(this).data('cat-id');
        var cat_name = $("#new-cat-name").val();
        var sub_cats = $(this).parent().parent().find(".subcat-update-value");
        var sub_cats_a = [];

        if ($.trim(cat_name).length === 0){
            $("#error-message").text("Category Name Required");
            $("#messages").modal('toggle');
            return false;
        }

        $.each(sub_cats, function(key,val){
            if ($.trim($(val).val()).length !== 0)
            {
                sub_cats_a.push($.trim($(val).val()));
            }
        });

        $.ajax({
            url: "/admin/categories/addcat",
            type: "post",
            data: {cat_id: cat_id, cat_name: cat_name, subcats: sub_cats_a}
        }).done(function(cb){
            window.location.reload();
        })
    });


    $("#add-new-cat").on("click", function(){
       var cat_name = $("#new-top-cat").val();

       $.ajax({
           url: "/admin/categories/add",
           type: "post",
           data: {cat: cat_name}
       }).done(function(cb){

          window.location.reload();
       });



    });

    $("#add-size").on("click", function(){
        var html = "<tr class=\"new-size\">\n" +
            "    <td>\n" +
            "        <select id=\"size-select\" class=\"form-control\">\n" +
            "            <option value=\"XS\">XS</option>\n" +
            "            <option value=\"S\">S</option>\n" +
            "            <option value=\"M\">M</option>\n" +
            "            <option value=\"L\">L</option>\n" +
            "            <option value=\"XL\">XL</option>\n" +
            "            <option value=\"2X\">2X</option>\n" +
            "        </select>\n" +
            "    </td>\n" +
            "    <td>\n" +
            "        <input type=\"text\"  class=\"form-control product-price\">\n" +
            "    </td>\n" +
            "    <td>\n" +
            "        <input type=\"number\" class=\"form-control product-quantity\">\n" +
            "    </td>\n" +
            "    <td><i class=\"fa fa-trash\"></i></td>\n" +
            "</tr>";
        $("#sizes-available tbody").append(html);
    });


   $(".add-new-image").on("click", function(){
        $("#image-input").click();
   });

   $(".add-new-image-2").on("click", function(){
       $("#new-image-input").click();
   });

    $(".add-new-image-3").on("click", function(){
        $("#new-image-input-3").click();
    });

    $(".add-new-image-4").on("click", function(){
        $("#new-image-input-4").click();
    });

    $(".rotate-image").on("click", function(){
        var inputs = $(".photo-block-image input[type='checkbox']:checked");
        if (inputs.length === 1){
            var image_url = $(".photo-block-image input[type='checkbox']:checked").data('photo-url');
            $.ajax({
                url: "/admin/image/rotate1",
                type: "post",
                data: {url: image_url}
            }).done(function(cb){
                var d = new Date();
                $(".photo-block-image input[type='checkbox']:checked").parent().find("img").attr('src', '../../img/'+image_url+'?'+d.getTime())
            });

        }
    });

   $(".select-default").on("click", function(){

       var inputs = $(".photo-block-image input[type='checkbox']:checked");
       if (inputs.length === 1){
           $(".photo-select").removeClass('photo-select');
           inputs.parent().addClass('photo-select');
       }
    });


   $("#remove-selected-offers").on("click", function(){

       $(".special-check").each(function(){
           if ($(this).is(":checked")){
               $("#confirm-delete").modal("toggle");
               return false;
           }
       });

   });

   $("#remove-offers").on("click", function(){
       var a = [];
       $(".special-check").each(function(){
           if ($(this).is(":checked")){
               a.push($(this).data('id'));
           }
       });

       $.ajax({
           url: "/admin/special/remove",
           type: "post",
           data: {ids: a}
       }).done(function(cb){
           window.location.reload();
       });
   });
   $(".delete-images").on("click", function(){
       var ids = [];
      $(".photo-block-image input[type='checkbox']:checked").each(function(){
          ids.push($(this).data('photo-id'));
          $(this).parent().parent().remove();
      });
      if (ids.length > 0){
          $.ajax({
              url: "/admin/product/image",
              type: "delete",
              data: {ids: ids}
          })
      }
   });

    $(".delete-images-2").on("click", function(){
        var ids = [];
        $(".photo-block-image input[type='checkbox']:checked").each(function(){
            ids.push($(this).data('photo-id'));
            $(this).parent().parent().parent().remove();
        });
        if (ids.length > 0){
            $.ajax({
                url: "/admin/product/image",
                type: "delete",
                data: {ids: ids}
            })
        }
    });

    $("#new-image-input").on("change", function(){
        var formData = new FormData();
        formData.append('file', $("#new-image-input")[0].files[0]);
        $.ajax({
            url: "/admin/product/image_2",
            type: "post",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        }).done(function(cb){
            var new_block = $(".add-new-image").parent();
            $(".image-blocks").append('<div class="photo-block m-3">\n' +
                '                <div class="photo-block-image">\n' +
                '                   <div>\n' +
                '                     <input type="checkbox" class="form-control" data-photo-url="'+cb.file+'" data-photo-id="'+cb.id+'">\n' +
                '                     <img src="../../img/'+cb.file+'" class="img-responsive" alt="">\n' +
                '                   </div>\n' +
                '                 </div>\n' +
                '              </div>');
        });
    });
    $("#new-image-input-4").on("change", function(){
        var formData = new FormData();
        formData.append('file', $("#new-image-input-4")[0].files[0]);
        $.ajax({
            url: "/admin/product/image_3",
            type: "post",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        }).done(function(cb){
            var new_block = $(".add-new-image").parent();
            $("#image-pane-4").append('<div class="photo-block m-3">\n' +
                '                <div class="photo-block-image">\n' +
                '                   <div>\n' +
                '                     <input type="radio" name="photos-radio" class="photo-radios" data-photo-url="'+cb.file+'">\n' +
                '                     <img src="../../img/'+cb.file+'" class="img-responsive" alt="">\n' +
                '                   </div>\n' +
                '                 </div>\n' +
                '              </div>');
        });
    });
   $("#new-image-input-3").on("change", function(){
       var formData = new FormData();
       formData.append('file', $("#new-image-input-3")[0].files[0]);
       $.ajax({
           url: "/admin/product/image_3",
           type: "post",
           data: formData,
           cache: false,
           contentType: false,
           processData: false
       }).done(function(cb){
           var new_block = $(".add-new-image").parent();
           $(".image-blocks").append('<div class="photo-block m-3">\n' +
               '                <div class="photo-block-image">\n' +
               '                   <div>\n' +
               '                     <input type="radio" name="photo-boxes" class="photo-radios" data-photo-url="img/'+cb.file+'" checked>\n' +
               '                     <img src="../../img/'+cb.file+'" id="'+cb.file+'" class="img-responsive" alt="">\n' +
               '                   </div>\n' +
               '                 </div>\n' +
               '              </div>');
       });
   });
   $("#image-input").on("change", function(){
       var formData = new FormData();
       formData.append('file', $("#image-input")[0].files[0]);
       formData.append('product_id', $("#product-id").val());
       $.ajax({
           url: "/admin/product/image",
           type: "post",
           data: formData,
           cache: false,
           contentType: false,
           processData: false
       }).done(function(cb){
           var new_block = $(".add-new-image").parent();
           $(".image-blocks").append('<div class="photo-block m-3">\n' +
               '                <div class="photo-block-image">\n' +
               '                   <div>\n' +
               '                     <input type="checkbox" class="form-control" data-photo-url="'+cb.file+'" data-photo-id="'+cb.id+'">\n' +
               '                     <img src="../../img/'+cb.file+'" class="img-responsive" alt="">\n' +
               '                   </div>\n' +
               '                 </div>\n' +
               '              </div>');
       });
   });
});


$(function(){
   $(".sizes-available-checkbox").on("click", function(){
       if ($(this).is(":checked")){
           $(".sizes-available-table").removeClass('hide');
       } else {
           $(".sizes-available-table").addClass('hide');
       }
   });
});


//Order Page Marked As Shipped Modal
$(function(){
   $("#open-shipping-modal").on("click", function(){
        $("#order_id").val($(this).data('order-id'));
        $("#mark-as-shipped-modal").modal('toggle');
   });

   $("#mark-as-shipped-modal").on("hidden.bs.modal", function(){
      $("#order_id").val("");
   });

   $("#complete-order").on("click", function(){
      var tracking = $("#tracking").val();
      var carrier  = $("#carrier").val();
      var note      = $("#notes").val();
      var order_id  = $("#order_id").val();

      $.ajax({
          url: "/admin/order/complete",
          type: "post",
          data: {order_id: order_id, tracking: tracking, carrier: carrier, note: note}
      }).done(function(cb){
            window.location.reload();
      })
   });
});
//DataTable Initializations and Functions
$(function(){

    function confirmDelete(){
        var count = 0;
        $("#products-table .selected").each(function(){
            count++;
        });

        if (count > 0)
        {
            var message = "selected product?";
            if (count > 1)
            {
                var message = count+" products?";
            }
            $("#delete-count").text(message);
            $("#confirm-delete").modal('toggle');
        }
    }

    function deleteSelected(){

        var ids = [];
        var table = $("#products-table").DataTable();
        $("#products-table .selected").each(function(){
           ids.push(parseInt($(this).prop("id").replace("product_", "")));
        });

        $.ajax({
            url: "/admin/products",
            type:"delete",
            data: {ids: ids}
        }).done(function(){
            $("#confirm-delete").modal('toggle');
            table.rows('.selected').remove().draw();
        });
    }

    $("#orders-to-ship-table").dataTable({
        columnDefs:[
            {
                orderable:false,
                targets: [6]
            }
        ]
    });



    $("#past-orders-table").dataTable();


    $("#delete-selected-products").on("click", deleteSelected);

    //Products Table under 'View Products'
    $("#products-table").dataTable({
        columnDefs:[{
            orderable: false,
            className: 'select-checkbox',
            targets: 0,
        }],
        select:{
            style: 'multi',
            selector: 'td:first-child'
        },
        order: [[1, 'asc']],
        dom: '<"mb-10 clearfix" lfr >tiB<>p',
        buttons: [
            {
                text: 'Delete Selected',
                action: function ( e, dt, node, config ) {
                   confirmDelete();
                }
            }
        ]
    });

});
