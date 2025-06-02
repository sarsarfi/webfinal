<?php
namespace App\Controller;

use App\Model\User;
use App\Model\Post;

class FrontController
{
    public function home()
    {
        // نمایش لیست دانشجویان به ترتیب الفبا
        $students = User::orderBy('name')->get();
        view('home.php', ['students' => $students]);
    }
    
   public function posts()
{
    // گرفتن همه پست‌ها همراه با اطلاعات نویسنده و بازدید
    $posts = Post::with('user', 'views')->get();

    // افزودن پست‌های مرتبط به هر پست
    foreach ($posts as $post) {
        $post->user_name = $post->user->name ?? 'نامشخص';
        $post->user_email = $post->user->email ?? '';
        $post->view_count = $post->views->view_count ?? 0;
        $post->related_posts = \App\Model\RelatedPost::getRelatedPosts($post->id);
    }

    // ارسال داده‌ها به ویو
    view('posts.php', ['posts' => $posts]);
}

    
    public function matrix()
    {
        // محاسبه ماتریس A
        $posts = Post::with('relatedPosts', 'views')->limit(70)->get();
        $matrix = $this->calculateMatrix($posts);
        view('matrix.php', ['matrix' => $matrix]);
    }
    
    public function ranking()
    {
        // محاسبه رتبه‌بندی پست‌ها
        $posts = Post::with('relatedPosts', 'views')->limit(70)->get();
        $matrix = $this->calculateMatrix($posts);
        $ranking = $this->calculateRanking($matrix, $posts);
        view('ranking.php', ['ranking' => $ranking]);
    }
    
    private function calculateMatrix($posts)
    {
        $n = count($posts);
        $matrix = array_fill(0, $n, array_fill(0, $n, 0));
        
        foreach ($posts as $i => $post1) {
            $relatedPosts = $post1->relatedPosts;
            $totalViews = $post1->views->view_count;
            
            foreach ($relatedPosts as $related) {
                $post2 = $related->post_2_id;
                $j = $posts->search(function($item) use ($post2) {
                    return $item->id == $post2;
                });
                
                if ($j !== false && $totalViews > 0) {
                    $matrix[$i][$j] = $posts[$j]->views->view_count / $totalViews;
                }
            }
        }
        
        return $matrix;
    }
    
    private function calculateRanking($matrix, $posts)
    {
        $n = count($matrix);
        $v = array_fill(0, $n, 1.0);
        
        // روش توانی برای محاسبه بردار ویژه
        for ($k = 0; $k < 100; $k++) {
            $Av = array_fill(0, $n, 0.0);
            
            for ($i = 0; $i < $n; $i++) {
                for ($j = 0; $j < $n; $j++) {
                    $Av[$i] += $matrix[$i][$j] * $v[$j];
                }
            }
            
            $norm = sqrt(array_sum(array_map(function($x) { return $x * $x; }, $Av)));
            for ($i = 0; $i < $n; $i++) {
                $v[$i] = $Av[$i] / $norm;
            }
        }
        
        // ترکیب نتایج با پست‌ها
        $ranking = [];
        foreach ($posts as $i => $post) {
            $ranking[] = [
                'post' => $post,
                'score' => $v[$i]
            ];
        }
        
        // مرتب‌سازی نزولی
        usort($ranking, function($a, $b) {
            return $b['score'] <=> $a['score'];
        });
        
        return $ranking;
    }
}