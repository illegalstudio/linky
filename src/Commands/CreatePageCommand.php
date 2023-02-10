<?php

namespace Illegal\Linky\Commands;

use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Page;
use Illuminate\Console\Command;

class CreatePageCommand extends Command
{
    /**
     * The signature of the console command.
     *
     * @var string
     */
    protected $signature = 'linky:create:page';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'Create a new page';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->info('Create a new page');

        $content = new Content();
        $content->forceFill([
            'type' => ContentType::Page,
            'slug' => \Str::random(),
        ]);
        $content->contentable()->associate(Page::forceCreate([]));
        $content->save();
    }
}
