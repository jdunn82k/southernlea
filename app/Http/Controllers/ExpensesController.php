<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseAccounts;
use App\ExpenseCategory;
use App\ExpensePayee;
use App\Expenses;
use DateTime;

class ExpensesController extends Controller
{

    public static function deleteExpenses(Request $request)
    {
        foreach($request->ids as $id)
        {
            $exp = Expenses::find($id)->delete();

        }
        return $request;
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
        $arr['date']        = date("m/d/Y", strtotime($expense->date));
        $arr['id']          = $expense->id;
        return $arr;
    }
    public static function getExpensesTable(Request $request)
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
                break;
            case "month":
                $today = new DateTime();
                $month = $today->format("m");
                $year  = $today->format("Y");
                $string = $year."-".$month."-01";
                $expenses = Expenses::where('date', '>=', $string)->where('date', '<=', $today->format("Y-m-d"))->get();
                break;
            case "ytd":
                $today = new DateTime();
                $year = $today->format("Y");
                $string = $year."-01-01";
                $expenses = Expenses::where('date', '>=', $string)->where('date', '<=', $today->format("Y-m-d"))->get();
                break;
            case "all":
            default:
                $expenses = Expenses::all();

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
            $arr['check_num']   = $expense->check_number;
            $arr['date']        = date("m/d/Y", strtotime($expense->date));
            $arr['id']          = $expense->id;
            $cb[] = $arr;
        }
        return $cb;
    }

    public static function showExpenses()
    {
        return view('admin.expenses')
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

        $newexp = Expenses::find($request->id);
        $newexp->description    = $request->description;
        $newexp->memo           = $request->memo;
        $newexp->payer_account  = $acct_id;
        $newexp->check_number   = $request->check_num;
        $newexp->payee          = $payee_id;
        $newexp->category       = $cat_id;
        $newexp->total          = $request->amount;
        $newexp->date           = date("Y-m-d", strtotime($request->date));
        $newexp->save();

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

        $newexp = new Expenses();
        $newexp->description    = $request->description;
        $newexp->memo           = $request->memo;
        $newexp->payer_account  = $acct_id;
        $newexp->check_number   = $request->check_num;
        $newexp->payee          = $payee_id;
        $newexp->category       = $cat_id;
        $newexp->total          = $request->amount;
        $newexp->date           = date("Y-m-d", strtotime($request->date));
        $newexp->save();

        return $newexp;

    }
}
