<?php

namespace App\Livewire;

use App\Models\Admin\Blog;
use Livewire\Component;
use Livewire\WithPagination;

class Blogs extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $blogs;


    public function render()
    {
        $blogs = Blog::latest()->paginate($this->perPage);
        return view('livewire.Blog', compact('blogs'));
    }

}
