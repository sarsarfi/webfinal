<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    protected $table = 'posts';
    protected $fillable = ['user_id', 'title', 'content'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
   public function relatedPosts() {
    return $this->hasMany(RelatedPost::class, 'post_1_id');
}

    
    public function views() {
        return $this->hasOne(PostView::class);
    }
}