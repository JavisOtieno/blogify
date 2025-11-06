<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImporterTest extends TestCase
{
    use RefreshDatabase;

    public function test_jsonplaceholder_importer_creates_post()
    {
        Http::fake([
            'jsonplaceholder.typicode.com/*' => Http::response(['id'=>1,'title'=>'t','body'=>'b'],200)
        ]);

        $this->artisan('import:random', ['source'=>'jsonplaceholder'])->assertExitCode(0);

        $this->assertDatabaseHas('posts', ['source'=>'jsonplaceholder','external_id'=>1,'title'=>'t']);
    }

    public function test_fakestore_importer_creates_post()
    {
        Http::fake([
            'fakestoreapi.com/*' => Http::response(['id'=>2,'title'=>'Prod','description'=>'Desc','price'=>10,'category'=>'cat'],200)
        ]);

        $this->artisan('import:random', ['source'=>'fakestore'])->assertExitCode(0);

        $this->assertDatabaseHas('posts', ['source'=>'fakestore','external_id'=>2,'title'=>'Prod']);
    }
}
