<?php

namespace Illegal\Linky\View\Components;

use Illegal\Linky\Models\Content;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @param string $action The form action.
     * @param string $method The form method.
     * @param string $title The title of the form.
     * @param string $subtitle The subtitle of the form.
     * @param string $backUrl The back url.
     * @param Content|null $content The content.
     */
    public function __construct(
        public string $action,
        public string $method,
        public string $title,
        public string $subtitle,
        public string $backUrl,
        public ?Content $content = null
    )
    { }

    /**
     * Render the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('linky::components.content-form');
    }
}
