<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BlogCreate extends Component
{
    public $categories; 

    public function __construct($categories) {
        $this->categories = $categories; 
    }

    public function render() {
        return view('components.blog-create');
    }
}
