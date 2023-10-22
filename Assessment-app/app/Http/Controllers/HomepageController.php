<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Jobs\SavePost;
use Faker\Factory as FakerFactory;
use App\Models\User;
use App\Helpers\PostHelper;

class HomepageController extends Controller
{
    public function index() {
        // Get the latest post from the posts table.
        $posts = Post::latest()->get();
        
        return view('homepage', ['posts' => $posts]);
    }    
}
