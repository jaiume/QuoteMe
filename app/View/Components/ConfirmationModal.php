<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * Class ConfirmationModal
 * @package App\View\Components
 */
class ConfirmationModal extends Component
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $formSelector;

    /**
     * @var string
     */
    public string $title;

    /**
     * @var string
     */
    public string $description;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $formSelector
     * @param string $title
     * @param string $description
     */
    public function __construct(string $name, string $formSelector, string $title, string $description)
    {
        $this->name = $name;
        $this->formSelector = $formSelector;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.confirmation-modal');
    }
}
