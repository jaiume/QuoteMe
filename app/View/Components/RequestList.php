<?php

namespace App\View\Components;

use App\Models\Request;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class RequestList extends Component
{
    /**
     * @var Collection|Request[] $requests
     */
    public $requests;

    /**
     * Create a new component instance.
     *
     * @param Collection|Request[] $requests
     */
    public function __construct($requests)
    {
        $this->requests = $requests;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.request-list');
    }
}
