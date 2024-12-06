<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::all();
        return view('Expense.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('Expense.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'note' => 'required|string|max:250',
            'amount' => 'required|numeric|min:1',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        $income = Income::where('start_date', '<=' , $request->date)
                        ->where('end_date', '>=', $request->date)
                        ->first();

        $category = $income->categories()->where('category_id', $request->category_id)->first();

        if($category){
            $allocated_amount = $category->pivot->allocated_amount;
        }

        $total = Expense::where('category_id', $request->category_id)
                        ->whereBetween('date', [$income->start_date, $income->end_date])
                        ->sum('amount');

        $total = $total + $request->amount;

        if($total > $allocated_amount){
            return back()->with('message', "You have not enough budget for {$category->name} category.");
        }

        $expense = new Expense();
        $expense->note = $request->note;
        $expense->amount = $request->amount;
        $expense->date = $request->date;
        $expense->category_id = $request->category_id;
        $expense->save();

        return redirect()->route('expense.index')->with('message','New Expense is added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $categories = Category::all();
        return view('Expense.edit', compact('expense', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'note' => 'required|string|max:250',
            'amount' => 'required|numeric|min:1',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        $expense->note = $request->note;
        $expense->amount = $request->amount;
        $expense->date = $request->date;
        $expense->category_id = $request->category_id;
        $expense->update();

        return redirect()->route('expense.index')->with('message','Expense is updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expense.index')->with('message', 'Expense is deleted');
    }
}
