<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $table = 'category_post'; //migrateが単数の場合は記載が必要。
    protected $fillable = ['category_id', 'post_id']; // we will use createMany()
    public $timestamps = false;  //created_at and updated_at migrateファイルでtimestampカラムを削除をしたため、記述が必要。

    #Use this method to get the name of the category
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
