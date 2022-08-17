<?php

namespace App\View\Components;

use App\Models\Response;
use Illuminate\View\Component;

class ResponseCard extends Component
{
    /**
     * @var Response
     */
    public Response $response;

    /**
     * @var string
     */
    public string $class;

    /**
     * Create a new component instance.
     *
     * @param Response $response
     * @param string $class
     */
    public function __construct(Response $response, string $class = '')
    {
        $this->response = $response;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.response-card');
    }
}
