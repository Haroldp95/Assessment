<?php
 
namespace App\Livewire;
 
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Post;
 
class CreatePost extends Component
{
    public $user_id = '';
    public $title = '';
    public $body = '';
 
    // Gets the infomation filled into the form and pushes it to the Posts database.
    // Reloads to show the newly added content.
    public function save()
    {
        $user_id = Auth::id();

        Post::create([
            'user_id' => $user_id,
            'title' => $this->title,
            'body' => $this->body,
        ]);

        return $this->redirect('/homepage');
    }
 
    public function render()
    {
        return view('livewire.create-post');
    }
}