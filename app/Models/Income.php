<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    public function categories(){
        return $this->belongsToMany(Category::class)
                    ->withPivot('allocated_amount');
    }

    // public function getSpendAmountByCategoryAttribute(){
    //     $expense = Expense::whereBetween('date', [$this->start_date, $this->end_date])
    //                         ->
    // }
}
