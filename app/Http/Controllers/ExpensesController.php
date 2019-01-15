<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;
use App\ExpenseAccounts;
use App\ExpenseCategory;
use App\ExpensePayee;
use App\Expenses;
use App\PhpSpreadsheet\Excel;
use App\Income;
use DateTime;

class ExpensesController extends Controller
{

    public static function showNetIncome(Request $request)
    {
        switch ($request->filter)
        {
            case "lastmonth":
                $dt = new DateTime();
                $dt->modify('last day of previous month');
                $end = $dt->format('Y-m-d');
                $start = $dt->format('Y-m')."-01";
                $expenses = Expenses::where('date', '>=', $start)
                    ->where('date', '<=', $end)
                    ->get();
                $income = Income::where('date', '>=', $start)
                    ->where('date', '<=', $end)
                    ->get();
                $message = "Net Income For ".$dt->format("F");
                break;
            case "30days":
                $start = new DateTime();
                $start->modify('-30 days');
                $end    = new DateTime();
                $expenses = Expenses::where('date', '>=', $start->format("Y-m-d"))
                    ->where('date', '<=', $end->format("Y-m-d"))
                    ->get();
                $income = Income::where('date', '>=', $start->format("Y-m-d"))
                    ->where('date', '<=', $end->format("Y-m-d"))
                    ->get();
                $message = "Net Income ".$start->format("m/d/Y")." - ".$end->format("m/d/Y");
                break;
            case "ytd":
                $today = new DateTime();
                $year = $today->format("Y");
                $string = $year."-01-01";
                $expenses = Expenses::where('date', '>=', $string)->where('date', '<=', $today->format("Y-m-d"))->get();
                $income = Income::where('date', '>=', $string)->where('date', '<=', $today->format("Y-m-d"))->get();
                $message = "Net Income Year To Date";
                break;
            default:
                return "blank";
        }

        $exp = 0.00;
        foreach($expenses as $expense)
        {
            $exp = $exp + $expense->total;
        }

        $inc_total = 0.00;
        foreach($income as $inc)
        {
            $inc_total = $inc_total + $inc->total;
        }

//        return [$start, $end];
        return [
            "expense" => number_format($exp, 2),
            "income" => number_format($inc_total, 2),
            "message" => $message,
            "net" => number_format( ($inc_total - $exp), 2 )
        ];

    }

    public static function export(Request $request)
    {
        $headers = ["Date", "Payee/Payor", "Payment Type", "Check Number", "Category", "Subtotal", "Shipping", "Tax", "Total", "Memo", "Description"];
        $rows    = [];
        $ids = json_decode($request->ids, true);

        foreach($ids as $id)
        {
            $id_num = $id[0];
            $type   = $id[1];

            switch($type)
            {
                case "income":
                    $data = Income::findOrFail($id_num);
                    $payee = ExpensePayee::find($data->payee);
                    $category = ExpenseCategory::find($data->category);
                    $payment_type = ExpenseAccounts::find($data->payer_account);

                    $rows[] = [
                        $data->date,
                        $payee->name,
                        $payment_type->name,
                        $data->check_number,
                        $category->name,
                        "$".number_format($data->subtotal,2),
                        "$".number_format($data->shipping,2),
                        "$".number_format($data->tax,2),
                        "($".number_format($data->total,2).")",
                        $data->memo,
                        $data->description
                    ];
                    break;
                case "expense":
                    $data = Expenses::findOrFail($id_num);
                    $payee = ExpensePayee::find($data->payee);
                    $category = ExpenseCategory::find($data->category);
                    $payment_type = ExpenseAccounts::find($data->payer_account);

                    $rows[] = [
                        $data->date,
                        $payee->name,
                        $payment_type->name,
                        $data->check_number,
                        $category->name,
                        "$".number_format($data->subtotal,2),
                        "$".number_format($data->shipping,2),
                        "$".number_format($data->tax,2),
                        "$".number_format($data->total,2),
                        $data->memo,
                        $data->description
                    ];
                    break;
                default:
                    return "error";
            }
        }

        Excel::basic($headers, $rows);
        exit;
    }

    public static function deleteExpenses(Request $request)
    {
        $arr = json_decode($request->ids, true);

        foreach($arr as $ids)
        {

            $id   = $ids[0];
            $type = $ids[1];

            switch ($type)
            {
                case "income":
                    Income::find($id)->delete();
                    break;
                case "expense":
                    Expenses::find($id)->delete();
                    break;
            }

        }
        return $request;
    }

    public static function getIncomeById($id)
    {
        $expense = Income::find($id);
        $arr = [];
        $arr["description"] = $expense->description;
        $arr["memo"]        = $expense->memo;
        $arr["account"]     = ExpenseAccounts::find($expense->payer_account)->name;
        $arr["account_id"]  = $expense->payer_account;
        if ($expense->payee !== 0)
        {
            $arr["payee"]       = ExpensePayee::find($expense->payee)->name;

        }
        else
        {
            $arr["payee"] = "Online Order";
        }

        if ($expense->category !== 0)
        {
            $arr["category"]    = ExpenseCategory::find($expense->category)->name;
        }
        else
        {
            $arr["category"] = "Online Order";
        }
        $arr["payee_id"]    = $expense->payee;

        $arr["category_id"] = $expense->category;
        $arr['amount']      = $expense->total;
        $arr['check_num']   = $expense->check_number;
        $arr['subtotal']    = $expense->subtotal;
        $arr['shipping']    = $expense->shipping;
        $arr['tax']         = $expense->tax;
        $arr['date']        = date("m/d/Y", strtotime($expense->date));
        $arr['id']          = $expense->id;
        $arr['type']        = "income";
        return $arr;
    }


    public static function getExpenseById($id)
    {
        $expense = Expenses::find($id);
        $arr = [];
        $arr["description"] = $expense->description;
        $arr["memo"]        = $expense->memo;
        $arr["account"]     = ExpenseAccounts::find($expense->payer_account)->name;
        $arr["account_id"]  = $expense->payer_account;
        $arr["payee"]       = ExpensePayee::find($expense->payee)->name;
        $arr["payee_id"]    = $expense->payee;
        $arr["category"]    = ExpenseCategory::find($expense->category)->name;
        $arr["category_id"] = $expense->category;
        $arr['amount']      = $expense->total;
        $arr['check_num']   = $expense->check_number;
        $arr['subtotal']    = $expense->subtotal;
        $arr['shipping']    = $expense->shipping;
        $arr['tax']         = $expense->tax;
        $arr['date']        = date("m/d/Y", strtotime($expense->date));
        $arr['id']          = $expense->id;
        $arr['type']        = "expense";
        return $arr;
    }
    public static function getExpensesTable(Request $request)
    {
        $parse = explode("|", $request->filter);
        if (count($parse) > 1)
        {
            switch($parse[0])
            {
                case "Q1":
                    $start = $parse[1]."-01-01";
                    $end   = $parse[1]."-03-31";
                    break;
                case "Q2":
                    $start = $parse[1]."-04-01";
                    $end   = $parse[1]."-06-30";
                    break;
                case "Q3":
                    $start = $parse[1]."-07-01";
                    $end   = $parse[1]."-09-30";
                    break;
                case "Q4":
                    $start = $parse[1]."-10-01";
                    $end   = $parse[1]."-12-31";
                    break;
                case "Current":
                    $today = new DateTime();
                    $month = $today->format("m");
                    $year  = $today->format("Y");

                    if ($month >= 1 && $month <= 3)
                    {
                        $start = $year."-01-01";
                        $end    = $year."-03-31";
                    } else if ($month >= 4 && $month <= 6){
                        $start = $year."-04-01";
                        $end   = $year."-06-30";
                    } else if ($month >= 7 && $month <=9 ){
                        $start = $year."-07-01";
                        $end   = $year."-09-30";
                    } else {
                        $start = $year."-10-01";
                        $end   = $year."-12-31";
                    }
                    break;
            }


            $expenses = Expenses::where('date', '>=', $start)
                ->where('date', '<=', $end)
                ->get();
            $income = Income::where('date', '>=', $start)
                ->where('date', '<=', $end)
                ->get();
        }
        else
        {
            switch ($request->filter)
            {
                case "30":
                    $start = new DateTime();
                    $start->modify('-30 days');
                    $end    = new DateTime();
                    $expenses = Expenses::where('date', '>=', $start->format("Y-m-d"))
                        ->where('date', '<=', $end->format("Y-m-d"))
                        ->get();
                    $income = Income::where('date', '>=', $start->format("Y-m-d"))
                        ->where('date', '<=', $end->format("Y-m-d"))
                        ->get();
                    break;
                case "month":
                    $today = new DateTime();
                    $month = $today->format("m");
                    $year  = $today->format("Y");
                    $string = $year."-".$month."-01";
                    $expenses = Expenses::where('date', '>=', $string)->where('date', '<=', $today->format("Y-m-d"))->get();
                    $income = Income::where('date', '>=', $string)->where('date', '<=', $today->format("Y-m-d"))->get();

                    break;
                case "ytd":
                    $today = new DateTime();
                    $year = $today->format("Y");
                    $string = $year."-01-01";
                    $expenses = Expenses::where('date', '>=', $string)->where('date', '<=', $today->format("Y-m-d"))->get();
                    $income = Income::where('date', '>=', $string)->where('date', '<=', $today->format("Y-m-d"))->get();

                    break;
                case "all":
                default:
                    $expenses = Expenses::all();
                    $income = Income::all();

            }
        }


        $cb       = [];
        foreach($expenses as $expense)
        {
            $arr = [];
            $arr["description"] = $expense->description;
            $arr["memo"]        = $expense->memo;
            $arr["account"]     = ExpenseAccounts::find($expense->payer_account)->name;
            $arr["payee"]       = ExpensePayee::find($expense->payee)->name;
            $arr["category"]    = ExpenseCategory::find($expense->category)->name;
            $arr['amount']      = $expense->total;
            $arr['subtotal']    = $expense->subtotal;
            $arr['shipping']    = $expense->shipping;
            $arr['tax']         = $expense->tax;
            if ($expense->check_number == null)
            {
                $arr['check_num'] = "";
            } else {
                $arr['check_num']   = $expense->check_number;

            }
            $arr['date']        = date("m/d/Y", strtotime($expense->date));
            $arr['id']          = $expense->id;
            $arr['type']        = "expense";
            $cb[] = $arr;
        }

        foreach($income as $expense)
        {
            $arr = [];
            $arr["description"] = $expense->description;
            $arr["memo"]        = $expense->memo;
            $arr["account"]     = ExpenseAccounts::find($expense->payer_account)->name;

            if ($expense->payee !== 0)
            {
                $arr["payee"]       = ExpensePayee::find($expense->payee)->name;

            }
            else
            {
                $arr["payee"] = "Online Order";
            }

            if ($expense->category !== 0)
            {
                $arr["category"]    = ExpenseCategory::find($expense->category)->name;
            }
            else
            {
                $arr["category"] = "Online Order";
            }
            $arr['amount']      = $expense->total;
            $arr['subtotal']    = $expense->subtotal;
            $arr['shipping']    = $expense->shipping;
            $arr['tax']         = $expense->tax;
            if ($expense->check_number == null)
            {
                $arr['check_num'] = "";
            } else {
                $arr['check_num']   = $expense->check_number;

            }
            $arr['date']        = date("m/d/Y", strtotime($expense->date));
            $arr['id']          = $expense->id;
            $arr['type']        = "income";
            $cb[] = $arr;
        }
        return $cb;
    }

    private static function getQuarter($month)
    {
        switch ($month)
        {
            case 1:
            case 2:
            case 3:
                $name = "Q1";
                break;

            case 4:
            case 5:
            case 6:
                $name = "Q2";
                break;

            case 7:
            case 8:
            case 9:
                $name = "Q3";
                break;

            case 10:
            case 11:
            case 12:
                $name = "Q4";
                break;

        }

        return $name;
    }
    public static function showExpenses()
    {


        $dt1 = new DateTime();
        $day_month = $dt1->format("m-d");
        $this_year = $dt1->format("Y");
        $last_year = ($this_year - 1);

        $start_date = new DateTime($last_year."-".$day_month);
        $start_quarter = self::getQuarter($start_date->format("m"));

        switch($start_quarter)
        {
            case "Q1":
                $return = [
                    "Q1|".$start_date->format("Y") => "Q1 - ".$start_date->format("Y"),
                    "Q2|".$start_date->format("Y") => "Q2 - ".$start_date->format("Y"),
                    "Q3|".$start_date->format("Y") => "Q3 - ".$start_date->format("Y"),
                    "Q4|".$start_date->format("Y") => "Q4 - ".$start_date->format("Y"),
                    "Current|".$this_year => "Current - ".$this_year
                ];
                break;

            case "Q2":
                $return = [
                    "Q2|".$start_date->format("Y") => "Q2 - ".$start_date->format("Y"),
                    "Q3|".$start_date->format("Y") => "Q3 - ".$start_date->format("Y"),
                    "Q4|".$start_date->format("Y") => "Q4 - ".$start_date->format("Y"),
                    "Q1|".$this_year => "Q1 - ".$this_year,
                    "Current|".$this_year => "Current - ".$this_year,
                ];
                break;

            case "Q3":
                $return = [
                    "Q3|".$start_date->format("Y") => "Q3 - ".$start_date->format("Y"),
                    "Q4|".$start_date->format("Y") => "Q4 - ".$start_date->format("Y"),
                    "Q1|".$this_year => "Q1 - ".$this_year,
                    "Q2|".$this_year => "Q2 - ".$this_year,
                    "Current|".$this_year => "Current - ".$this_year,


                ];
                break;

            case "Q4":
                $return = [
                    "Q4|".$start_date->format("Y") => "Q4 - ".$start_date->format("Y"),
                    "Q1|".$this_year => "Q1 - ".$this_year,
                    "Q2|".$this_year => "Q2 - ".$this_year,
                    "Q3|".$this_year => "Q3 - ".$this_year,
                    "Current|".$this_year => "Current - ".$this_year,

                ];
                break;
        }







        return view('admin.expenses')
            ->with('quarters', $return)
            ->with('accounts', ExpenseAccounts::all())
            ->with('categories', ExpenseCategory::all())
            ->with('payees', ExpensePayee::all());
    }

    public static function updateExpense(Request $request)
    {
        if ($request->payee_id == "")
        {
            $pay = new ExpensePayee();
            $pay->name = $request->payee_text;
            $pay->save();
            $payee_id = $pay->id;
        }
        else
        {
            $payee_id = $request->payee_id;
        }

        if ($request->category_id == "")
        {
            $cat = new ExpenseCategory();
            $cat->name = $request->category_text;
            $cat->save();
            $cat_id = $cat->id;
        }
        else
        {
            $cat_id = $request->category_id;
        }

        if ($request->account_id == "")
        {
            $acct = new ExpenseAccounts();
            $acct->name = $request->account_text;
            $acct->save();
            $acct_id = $acct->id;
        }
        else
        {
            $acct_id = $request->account_id;
        }

        switch ($request->type)
        {
            case "income":
                $newexp = Income::find($request->id);
                $newexp->description    = $request->description;
                $newexp->memo           = $request->memo;
                $newexp->payer_account  = $acct_id;
                $newexp->check_number   = $request->check_num;
                $newexp->payee          = $payee_id;
                $newexp->category       = $cat_id;
                $newexp->subtotal       = $request->subtotal;
                $newexp->shipping       = $request->shipping;
                $newexp->tax            = $request->tax;
                $newexp->total          = $request->amount;
                $newexp->date           = date("Y-m-d", strtotime($request->date));
                $newexp->save();
                break;
            case "expense":
                $newexp = Expenses::find($request->id);
                $newexp->description    = $request->description;
                $newexp->memo           = $request->memo;
                $newexp->payer_account  = $acct_id;
                $newexp->check_number   = $request->check_num;
                $newexp->payee          = $payee_id;
                $newexp->category       = $cat_id;
                $newexp->total          = $request->amount;
                $newexp->subtotal       = $request->subtotal;
                $newexp->shipping       = $request->shipping;
                $newexp->tax            = $request->tax;
                $newexp->date           = date("Y-m-d", strtotime($request->date));
                $newexp->save();
                break;

        }

        return $newexp;
    }
    public static function addExpense(Request $request)
    {
        if ($request->payee_id == "")
        {
            $pay = new ExpensePayee();
            $pay->name = $request->payee_text;
            $pay->save();
            $payee_id = $pay->id;
        }
        else
        {
            $payee_id = $request->payee_id;
        }

        if ($request->category_id == "")
        {
            $cat = new ExpenseCategory();
            $cat->name = $request->category_text;
            $cat->save();
            $cat_id = $cat->id;
        }
        else
        {
            $cat_id = $request->category_id;
        }

        if ($request->account_id == "")
        {
            $acct = new ExpenseAccounts();
            $acct->name = $request->account_text;
            $acct->save();
            $acct_id = $acct->id;
        }
        else
        {
            $acct_id = $request->account_id;
        }

        switch ($request->type)
        {
            case "income":
                $newexp = new Income();
                $newexp->description    = $request->description;
                $newexp->memo           = $request->memo;
                $newexp->payer_account  = $acct_id;
                $newexp->check_number   = $request->check_num;
                $newexp->payee          = $payee_id;
                $newexp->category       = $cat_id;
                $newexp->total          = $request->amount;
                $newexp->subtotal       = $request->subtotal;
                $newexp->shipping       = $request->shipping;
                $newexp->tax            = $request->tax;
                $newexp->date           = date("Y-m-d", strtotime($request->date));
                $newexp->save();
                break;

            case "expense":
                $newexp = new Expenses();
                $newexp->description    = $request->description;
                $newexp->memo           = $request->memo;
                $newexp->payer_account  = $acct_id;
                $newexp->check_number   = $request->check_num;
                $newexp->payee          = $payee_id;
                $newexp->category       = $cat_id;
                $newexp->total          = $request->amount;
                $newexp->subtotal       = $request->subtotal;
                $newexp->shipping       = $request->shipping;
                $newexp->tax            = $request->tax;
                $newexp->date           = date("Y-m-d", strtotime($request->date));
                $newexp->save();
                break;
        }

        return $newexp;

    }
}
