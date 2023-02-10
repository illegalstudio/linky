<?php

namespace Illegal\Linky\Commands;

use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Collection;
use Illuminate\Console\Command;

class CreateCollectionCommand extends Command
{
    /**
     * The signature of the console command.
     *
     * @var string
     */
    protected $signature = 'linky:create:collection';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'Create a new collection';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->info('Create a new collection');

        $content = new Content();
        $content->forceFill([
            'type' => ContentType::Collection,
            'slug' => \Str::random(),
        ]);
        $content->contentable()->associate(Collection::forceCreate([]));
        $content->save();
    }
}
