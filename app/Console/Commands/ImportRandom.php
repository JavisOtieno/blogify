<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use App\Models\Post;
use Illuminate\Database\QueryException;

class ImportRandom extends Command
{
    protected $signature = 'import:random {source}';
    protected $description = 'Import a single random item from a given source (jsonplaceholder|fakestore)';

    public function handle()
    {
        $source = $this->argument('source');

        $map = config('importers', []);

        if (!isset($map[$source])) {
            $this->error("Unknown source: {$source}");
            return 1;
        }

        $class = $map[$source];
        $importer = App::make($class);

        try {
            $payload = $importer->fetchAndTransform();
        } catch (\Exception $e) {
            $this->error("Fetch error: " . $e->getMessage());
            return 1;
        }

        // Optional pre-check
        if (Post::where('source', $payload['source'])->where('external_id', $payload['external_id'])->exists()) {
            $this->warn("Duplicate detected for source {$payload['source']} external_id {$payload['external_id']}. Skipping.");
            return 0;
        }

        try {
            $post = Post::create($payload);
            $this->info("Imported post #{$post->id} from {$payload['source']} (external_id={$payload['external_id']}).");
        } catch (QueryException $e) {
            // DB unique safeguard
            $this->warn("DB error or duplicate: " . $e->getMessage());
            return 0;
        }

        return 0;
    }
}
