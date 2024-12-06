<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $cat = $request->category;
        $type = $request->type;
        $transactions = Transaction::when($request->type, function($q, $type){
            $q->where('type',$type);
        })
        ->when($cat, function($q, $cat){
            $q->where('category_id','like',"%$cat%");
        })
        ->when($search, function($q, $search){
            $q->where('name','like',"%$search%");
        })
        ->orderBy('created_at', 'asc')
        ->paginate(10)
        ->withQueryString();
        $categories = Category::all();
        return view('Transaction.index',compact('transactions','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('Transaction.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|string|in:income,expense',
            'description' => 'required|string'
        ]);

        Transaction::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'type' => $request->type,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('transaction.index')->with('status', 'New Transaction is created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $categories = Category::all();
        return view('Transaction.edit', compact('transaction', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|string|in:income,expense',
            'description' => 'required|string'
        ]);

        $transaction->name = $request->name;
        $transaction->amount = $request->amount;
        $transaction->category_id = $request->category_id;
        $transaction->type = $request->type;
        $transaction->description = $request->description;
        $transaction->user_id = Auth::id();

        $transaction->update();

        return redirect()->route('transaction.index')->with('status', 'Transaction is updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transaction.index')->with('status', 'Transaction is deleted.');
    }
}
