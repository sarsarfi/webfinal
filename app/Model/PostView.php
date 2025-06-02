<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostView extends Model {
    protected $table = 'post_views';
    protected $fillable = ['post_id', 'view_count'];
}