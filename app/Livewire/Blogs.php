<?php

namespace App\Livewire;

use App\Models\Admin\Blog;
use Livewire\Component;
use Livewire\WithPagination;

class Blogs extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 10;

    public function render()
    {
        $blogs = Blog::latest()->paginate($this->perPage);
        return view('livewire.Blogs', compact('blogs'));
    }

}
