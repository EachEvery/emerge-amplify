<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use CollectionSeeder;
use CategorySeeder;
use TextSeeder;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Tests\Fixtures\CreatePoemRequest as SaveFixture;
use App\Repositories\PoemRepository as Poems;
use App\Models\Poem;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp()
    {
        parent::setUp();

        $this->app->make(CollectionSeeder::class)->run();
        $this->app->make(CategorySeeder::class)->run();
        $this->app->make(TextSeeder::class)->run();

        factory(Poem::class, 5)->create();

        Notification::fake();
        Storage::fake('s3');

        $this->saveFixture = $this->app->make(SaveFixture::class);
        $this->poems = $this->app->make(Poems::class);
    }
}
