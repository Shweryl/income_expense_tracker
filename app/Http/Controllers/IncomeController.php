<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incomes = Income::all();
        return view('Income.index', compact('incomes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('Income.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'categories' => 'required',
            'categories.*' => 'required|numeric|min:1'
        ]);

        $income = new Income();
        $income->name = $request->name;
        $income->amount = $request->amount;
        $income->start_date = $request->start_date;
        $income->end_date = $request->end_date;
        $income->save();

        // saving allocated amount in pivot table
        $allocatedAmount = [];
        foreach($request->categories as $key=>$value){
            $allocatedAmount[$key] = ['allocated_amount' => $value];
        }
        $income->categories()->attach($allocatedAmount);

        return redirect()->route('income.index')->with('message','New Income is added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Income $income)
    {
        return view('Income.show', compact('income'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Income $income)
    {
        return view('Income.edit', compact('income'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Income $income)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'categories' => 'required',
            'categories.*' => 'required|numeric|min:1'
        ]);

        $income->name = $request->name;
        $income->amount = $request->amount;
        $income->start_date = $request->start_date;
        $income->end_date = $request->end_date;
        $income->update();
        
        $allocatedAmount = [];
        foreach($request->categories as $key=>$value){
            $allocatedAmount[$key] = ['allocated_amount' => $value];
        }
        $income->categories()->sync($allocatedAmount);

        return redirect()->route('income.index')->with('message','Income is edited.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Income $income)
    {
        $income->categories()->detach();

        $income->delete();

        return redirect()->route('income.index')->with('message','Income is deleted.');
    }
}
