<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getRelatedIncomeCategoryAttribute(){
        $income = Income::where('start_date','<=', $this->date)
                    ->where('end_date', '>=', $this->date)->first();
        return $income->categories()->where('category_id', $this->category_id)->first();
    }
}
