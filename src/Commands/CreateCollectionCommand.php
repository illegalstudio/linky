<?php

namespace Illegal\Linky\Commands;

use Illegal\Linky\Repositories\CollectionRepository;
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

        $title = $this->ask('What is the title of the collection?');

        /**
         * Create the collection.
         */
        CollectionRepository::create([
            'title' => $title
        ]);
    }
}
