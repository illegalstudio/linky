<?php

namespace Illegal\Linky\Traits\Livewire;

use Illegal\Linky\Models\Contentable\Link;

trait Sortable
{
    public string $sortDefaultField = "";

    public string $sortField = "";

    public string $sortDirection = 'desc';

    public array $sortFields = [];

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField     = $field;
            $this->sortDirection = 'asc';
        }
    }

    protected function getSort(): array
    {
        /**
         * Allow only fields that are in the $sortFields array and direction can only be asc or desc
         */
        $this->sortField     = in_array($this->sortField, $this->sortFields) ? $this->sortField : $this->sortDefaultField;
        $this->sortDirection = in_array($this->sortDirection, ['asc', 'desc']) ? $this->sortDirection : 'desc';

        return [$this->sortField, $this->sortDirection];
    }
}
