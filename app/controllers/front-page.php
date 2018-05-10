<?php

namespace App;

use Sober\Controller\Controller;

class FrontPage extends Controller
{
    public function recentUploads() {
        $posts = get_posts(array(
            'post_type' => 'attachment',
            'posts_per_page' => 8
        ));
    }
}
