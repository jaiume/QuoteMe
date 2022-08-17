<?php

namespace App\View\Components;

use App\Models\Request;
use Illuminate\View\Component;

/**
 * Class RequestCard
 * @package App\View\Components
 */
class RequestCard extends Component
{
    /**
     * A request to render
     *
     * @var Request
     */
    public Request $request;

    /**
     * @var bool
     */
    public bool $hideButtons;

    /**
     * @var string
     */
    public string $class;

    /**
     * Create a new component instance.
     *
     * @param Request $request
     * @param bool $hideButtons
     * @param string $class
     */
    public function __construct(Request $request, bool $hideButtons = false, string $class = '')
    {
        $this->request = $request;
        $this->hideButtons = $hideButtons;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.request-card');
    }
}
