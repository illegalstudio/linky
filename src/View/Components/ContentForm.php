<?php

namespace Illegal\Linky\View\Components;

use Illegal\Linky\Models\Content;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentForm extends Component
{
    public function __construct(
        public string $action,
        public string $method,
        public string $title,
        public string $subtitle,
        public string $backUrl,
        public ?Content $content = null
    )
    { }

    public function render(): View
    {
        return view('linky::components.content-form');
    }
}
