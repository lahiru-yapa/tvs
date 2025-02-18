<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Expense;
class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::orderBy('expense_date', 'desc')->get();
        return view('expenses.viewExpence', compact('expenses'));
    }

    public function create()
    {
        return view('expenses.addExpence');
    }
    public function store(Request $request)
    {
 
        $request->validate([
            'expense_type' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'paid_by' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'paid_for_whom' => 'nullable|string',
        ]);

        Expense::create([
            'expense_type' => $request->expense_type,
            'amount' => $request->amount,
            'expense_date' => $request->expense_date,
            'paid_by' => $request->paid_by,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense added successfully!');
    }

    public function destroy(CompanyExpense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully!');
    }

}
