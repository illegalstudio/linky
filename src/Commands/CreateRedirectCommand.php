<?php

namespace Illegal\Linky\Commands;

use Illegal\Linky\Enums\ContentType;
use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Redirect;
use Illuminate\Console\Command;

class CreateRedirectCommand extends Command
{
    /**
     * The signature of the console command.
     *
     * @var string
     */
    protected $signature = 'linky:create:redirect';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'Create a new redirect';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->info('Create a new redirect');

        $content = new Content();
        $content->forceFill([
            'type' => ContentType::Redirect,
            'slug' => \Str::random(),
        ]);
        $content->contentable()->associate(Redirect::forceCreate([]));
        $content->save();
    }
}
