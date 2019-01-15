@extends('layouts.admin2')

@section('content')

    <div id="page-wrapper">
        <div class="main-page">
            <div class="row" id="expense-table-pane">
                <div class="col-md-12">
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms">
                        <div class="form-title clearfix">
                            <h4 class="pull-left">Transactions</h4>
                            <button class="pull-right btn btn-primary newtransaction">New Transaction</button>
                        </div>
                        <div class="form-body">
                            <div class="loading_gif text-center"><img src="{{URL::to('/admin_files/images/loading.gif')}}" alt=""></div>
                            <div class="expenses-table hide">
                                <div class="btn-group mb-10">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        Filter <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" class='filter-option' data-filter="month">Current Month</a></li>
                                        <li><a href="#" class='filter-option' data-filter="30">Last 30 Days</a></li>
                                        <li><a href="#" class='filter-option' data-filter="ytd">Year To Date</a></li>
                                        <li class="divider"></li>
                                        @foreach($quarters as $key => $quarter)
                                            <li><a href="#" class="filter-option" data-filter="{{$key}}">{{$quarter}}</a></li>
                                        @endforeach
                                        <li class="divider"></li>
                                        <li><a href="#" class='filter-option' data-filter="all">All</a></li>
                                    </ul>
                                </div>
                                <div class="btn-group mb-10">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" id="delete-selected">Delete Selected</a></li>
                                    </ul>
                                </div>

                                <div class="btn-group mb-10 pull-right">
                                    <button type="button" class="btn btn-primary" id="export-transactions">
                                        Export
                                    </button>
                                </div>
                                <table class="table table-responsive" id="expenses_table">
                                    <thead>
                                    <tr>
                                        <th>
                                            <div class="btn-group">
                                                <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                                    <input type="checkbox" id="expense-select-all"> <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#" id="select-all">Select All</a></li>
                                                    <li><a href="#" id="select-page">Select Page</a></li>
                                                    <li><a href="#" id="unselect">Unselect All</a></li>
                                                </ul>
                                            </div>
                                        </th>
                                        <th>Date</th>
                                        <th>Payment Type</th>
                                        <th>Payee</th>
                                        <th>Category</th>
                                        <th>Subtotal</th>
                                        <th>Shipping</th>
                                        <th>Tax</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row hide" id="new-expense-pane">
                <div class="col-md-12">
                    <div class="form-grids widget-shadow">
                        <div class="form-title clearfix">
                            <h4 class="expense-title pull-left">New Transaction</h4>
                            <button class="btn btn-primary pull-right backtoexpenses">Back</button>
                        </div>
                        <div class="form-body">

                            <div class="row mt-20">
                                <div class="col-lg-2 col-md-2">
                                    <label>Date</label>
                                    <input type="text" class="form-control datepicker" id="expense_date" value="@php echo date('m/d/Y'); @endphp">
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <label>Payee/Payor</label>
                                    <div class="input-group">
                                        <form autocomplete="off">
                                            <input class="form-control" id="payee" name="payee" placeholder="Enter Payee/Payor" autocomplete="off">
                                            <input type="hidden" id="payee_selected" value="">
                                        </form>

                                        <div class="input-group-btn check-for-payee">
                                            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu payee-dropdown dropdown-menu-right">
                                                @foreach($payees as $payee)
                                                    <li class="payee-option" data-id="{{$payee->id}}">{{$payee->name}}</li>
                                                @endforeach
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <label>Category</label>
                                    <div class="input-group">

                                        <form autocomplete="off">
                                            <input class="form-control" id="category" name="category" placeholder="Category" autocomplete="off">
                                            <input type="hidden" id="category_selected" value="">
                                        </form>

                                        <div class="input-group-btn check-for-category">
                                            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu category-dropdown dropdown-menu-right">
                                                @foreach($categories as $cat)
                                                    <li class="category-option" data-id="{{$cat->id}}">{{$cat->name}}</li>
                                                @endforeach
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-md-12">
                                    <table class="table table-condensed table-bordered" id="new-expense-table">
                                        <thead>
                                        <tr>
                                            <th style="width:125px;">Type</th>
                                            <th style="width:165px;">Account</th>
                                            <th>Description</th>
                                            <th style="width:75px;">Check #</th>
                                            <th style="width:90px;">Subtotal</th>
                                            <th style="width:90px;">Shipping</th>
                                            <th style="width:90px;">Tax</th>
                                            <th style="width:155px;">Total Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <select class="form-control" id="trans-type">
                                                    <option value="income">Income</option>
                                                    <option value="expense">Expense</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <form autocomplete="off">
                                                        <input class="form-control" id="account" name="account" placeholder="enter account" autocomplete="off">
                                                        <input type="hidden" id="account_selected" value="">
                                                    </form>

                                                    <div class="input-group-btn check-for-account">
                                                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu accounts-dropdown dropdown-menu-right">
                                                            @foreach($accounts as $acct)
                                                                <li class="account-option" data-id="{{$acct->id}}"> {{$acct->name}}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>

                                                </div>
                                            </td>

                                            <td><input type="text" class="form-control" id="description" placeholder="Description of Expense"></td>
                                            <td><input type="text" class="form-control" id="check_num"></td>
                                            <td><input type="text" class="form-control" id="subtotal" value="0.00"></td>
                                            <td><input type="text" class="form-control" id="shipping" value="0.00"></td>
                                            <td><input type="text" class="form-control" id="tax" value="0.00"></td>
                                            <td><input type="text" class="form-control" id="amount"></td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="memo">Memo</label>
                                    <textarea class="form-control" id="memo"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="button-group">
                                        <button type="button" class="btn btn-primary" id="add_expense">Add Expense</button>
                                        {{--<button type="button" class="btn btn-danger" id="clear_form">Clear</button>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row hide" id="edit-expense-pane">
                <div class="col-md-12">
                    <div class="form-grids widget-shadow">
                        <div class="form-title clearfix">
                            <h4 class="expense-title pull-left">Edit Transaction</h4>
                        </div>
                        <div class="form-body">

                            <div class="row mt-20">
                                <div class="col-lg-2 col-md-2">
                                    <label>Date</label>
                                    <input type="text" class="form-control datepicker" id="update_expense_date" value="">
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <label>Payee</label>
                                    <div class="input-group">
                                        <form autocomplete="off">
                                            <input class="form-control" id="update_payee" name="payee" placeholder="Enter Payee" autocomplete="off">
                                            <input type="hidden" id="update_payee_selected" value="">
                                        </form>

                                        <div class="input-group-btn check-for-payee">
                                            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu payee-dropdown dropdown-menu-right">
                                                @foreach($payees as $payee)
                                                    <li class="update-payee-option" data-id="{{$payee->id}}">{{$payee->name}}</li>
                                                @endforeach
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <label>Category</label>
                                    <div class="input-group">

                                        <form autocomplete="off">
                                            <input class="form-control" id="update_category" name="category" placeholder="Category" autocomplete="off">
                                            <input type="hidden" id="update_category_selected" value="">
                                        </form>

                                        <div class="input-group-btn check-for-category">
                                            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu category-dropdown dropdown-menu-right">
                                                @foreach($categories as $cat)
                                                    <li class="update-category-option" data-id="{{$cat->id}}">{{$cat->name}}</li>
                                                @endforeach
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-md-12">
                                    <table class="table table-condensed table-bordered" id="new-expense-table">
                                        <thead>
                                        <tr>
                                            <th style="width:165px;">Account</th>
                                            <th>Description</th>
                                            <th style="width:75px;">Check #</th>
                                            <th style="width:90px;">Subtotal</th>
                                            <th style="width:90px;">Shipping</th>
                                            <th style="width:90px;">Tax</th>
                                            <th style="width:155px;">Total Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="input-group">
                                                    <form autocomplete="off">
                                                        <input class="form-control" id="update_account" name="account" placeholder="enter account" autocomplete="off">
                                                        <input type="hidden" id="update_account_selected" value="">
                                                    </form>

                                                    <div class="input-group-btn check-for-account">
                                                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu accounts-dropdown dropdown-menu-right">
                                                            @foreach($accounts as $acct)
                                                                <li class="update-account-option" data-id="{{$acct->id}}"> {{$acct->name}}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>

                                                </div>
                                            </td>
                                            <td><input type="text" class="form-control" id="update_description" placeholder="Description of Expense"></td>
                                            <td><input type="text" class="form-control" id="update_check_num"></td>
                                            <td><input type="text" class="form-control" id="update_subtotal" value="0.00"></td>
                                            <td><input type="text" class="form-control" id="update_shipping" value="0.00"></td>
                                            <td><input type="text" class="form-control" id="update_tax" value="0.00"></td>
                                            <td><input type="text" class="form-control" id="update_amount"></td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="update_memo">Memo</label>
                                    <textarea class="form-control" id="update_memo"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="button-group">
                                        <input type="hidden" id="update_exp_id" value="">
                                        <input type="hidden" id="update_type" value="">
                                        <button type="button" class="btn btn-primary" id="update_expense">Update Expense</button>
                                        <button type="button" class="btn btn-danger" id="update_cancel">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="error_modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p class="error-message"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="confirm_delete">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p>Delete selected expenses?</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-primary delete-selected">Ok</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="export_form" action="{{URL::to("/admin/expenses/export")}}" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="ids">
    </form>
    <script>
        $(document).ready(function(){
           $.ajax({
               url: "/admin/expenses/table",
               type: "post",
               data: {filters: []}
           }).done(function(cb){
               var tableHtml = "";
               $.each(cb, function(i,v){
                   var amount;
                   if (v.type === "income"){
                       amount = "$"+v.amount;
                   } else if (v.type === "expense"){
                       amount = "<span style='color:red;'>$"+v.amount+"</span>";
                   }
                  tableHtml += "<tr>\n" +
                      "<td><input type=\"checkbox\" class=\"expense-checkbox\" data-type='"+v.type+"' data-exp-id=\""+v.id+"\"></td>\n" +
                      "<td>"+v.date+"</td>\n" +
                      "<td>"+v.account+"</td>\n" +

                      "<td>"+v.payee+"</td>\n" +
                      "<td>"+v.category+"</td>\n" +
                      "<td>$"+v.subtotal+"</td>\n" +
                      "<td>$"+v.shipping+"</td>\n" +
                      "<td>$"+v.tax+"</td>\n" +
                      "<td>"+amount+"</td>\n" +
                      "<td><a href='#' class='view_edit_expense' data-type='"+v.type+"' data-exp-id=\""+v.id+"\">View/Edit</a></td>\n" +
                      "</tr>";
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
    </script>
@endsection