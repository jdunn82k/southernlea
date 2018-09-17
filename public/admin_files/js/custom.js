$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function() {

    $('#side-menu').metisMenu();

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
        var category        = $("#product-category").val();
        var subcategory     = $("#product-subcategory").val();
        var price           = $("#product-price").val();
        var quantityInStock        = $("#product-quantity").val();



        var new_sizes           = [];
        $(".new-size").each(function(){
            $this = $(this);
            var size        = $this.find("#size-select").val();
            var code        = $this.find(".product-code").val();
            var price       = $this.find(".product-price").val();
            var quantity    = $this.find(".product-quantity").val();

            new_sizes.push( {size: size, code: code, price: price, quantity: quantity} );
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
                category: category,
                subcategory: subcategory,
                price: price,
                new_sizes: new_sizes,
                defaultImage: defaultImage,
                quantity: quantityInStock,
                new_images: new_images,
            }
        }).done(function(cb){
            console.log(cb);
        });
    });


    $("#submit-product-changes").on("click", function(){

        var product_id      = $("#product-id").val();
        var description_1   = $("#desc1").val();
        var description_2   = $("#txtarea1").val();
        var category        = $("#product-category").val();
        var subcategory     = $("#product-subcategory").val();
        var price           = $("#product-price").val();
        var defaultImage    = $(".photo-select input").data("photo-id");
        var quantityInStock        = $("#product-quantity").val();

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
                price: price,
                new_sizes: new_sizes,
                existing_sizes: existing_sizes,
                defaultImage: defaultImage,
                quantity: quantityInStock
            }
        }).done(function(cb){
            console.log(cb);
        });

    });

    $(document).on("click", "#sizes-available i.fa-trash", function(){
        $(this).parent().parent().remove();
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
            "        <input type=\"text\"  class=\"form-control product-code\">\n" +
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

   $(".select-default").on("click", function(){

       var inputs = $(".photo-block-image input[type='checkbox']:checked");
       if (inputs.length === 1){
           $(".photo-select").removeClass('photo-select');
           inputs.parent().addClass('photo-select');
       }
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

   $("#new-image-input").on("change", function(){
       var formData = new FormData();
       formData.append('file', $("#new-image-input")[0].files[0]);
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
               '                     <input type="checkbox" class="form-control" data-photo-url="'+cb.file+'">\n' +
               '                     <img src="../../img/'+cb.file+'" class="img-responsive" alt="">\n' +
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
               '                     <input type="checkbox" class="form-control" data-photo-id="'+cb.id+'">\n' +
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
