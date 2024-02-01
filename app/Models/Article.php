<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\Category;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory, Searchable;
    protected $fillable = 
    [
        'title','subtitle','body','image','category_id','user_id','is_accepted', 'slug',
    ];

    public function tags(){

        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function toSearchableArray(){
        return [
            'id'=> $this->id,
            'title'=>$this->title,
            'body'=> $this->body,
            'category'=> $this->category,
        ];
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    public function readDuration(){
        $totalWords = str_word_count($this->body);
        $minutesToRead = round($totalWords / 200);

        return intval($minutesToRead);
    }
    
}
