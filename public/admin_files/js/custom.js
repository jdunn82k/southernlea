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
   $(".sizes-available-checkbox").on("click", function(){
       if ($(this).is(":checked")){
           $(".sizes-available-table").removeClass('hide');
       } else {
           $(".sizes-available-table").addClass('hide');
       }
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

    $("#orders-to-ship-table").dataTable();
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
