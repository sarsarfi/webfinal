<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RelatedPost extends Model {
    protected $table = 'related_posts';
    protected $fillable = ['post_1_id', 'post_2_id'];
    public static function getRelatedPosts($postId)
{
    return Post::whereIn('id', function ($query) use ($postId) {
        $query->selectRaw('CASE 
                                WHEN post_1_id = ? THEN post_2_id 
                                WHEN post_2_id = ? THEN post_1_id 
                                ELSE NULL 
                           END', [$postId, $postId])
              ->from('related_posts')
              ->whereRaw('post_1_id = ? OR post_2_id = ?', [$postId, $postId]);
    })->get();
}

}