<?php

namespace App\View\Components;

use App\Models\Request;
use Illuminate\View\Component;

/**
 * Class ResponseList
 * @package App\View\Components
 */
class ResponseList extends Component
{
    /**
     * A request to render
     *
     * @var Request
     */
    public Request $request;

    /**
     * @var string
     */
    public string $class;

    /**
     * @var bool
     */
    public bool $full;

    /**
     * Create a new component instance.
     *
     * @param Request $request
     * @param bool $full
     * @param string $class
     */
    public function __construct(Request $request, bool $full = false, string $class = '')
    {
        $this->request = $request;
        $this->class = $class;
        $this->full = $full;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.response-list');
    }
}
