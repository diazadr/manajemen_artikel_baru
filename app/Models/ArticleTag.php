<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    protected $table = 'article_tags';
    protected $fillable = [
        'article_id',
        'tag_id'
    ];

    public function article() {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function tag() {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}
