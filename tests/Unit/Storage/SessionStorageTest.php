<?php

namespace Tests\Unit\Storage;

use App\Cart;
use Tests\TestCase;
use App\Support\Storage\SessionStorage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SessionStorageTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_check_if_storage_has_key()
    {
        $storage = new SessionStorage();

        session()->put(['cart.foo' => 'bar']);

        $this->assertTrue($storage->has('foo'));
    }

    /** @test */
    public function storage_can_get_value_by_key()
    {
        $storage = new SessionStorage();

        session()->put(['cart.foo' => 'bar']);

        $this->assertEquals('bar', $storage->get('foo'));
    }

    /** @test */
    public function it_can_get_all_items_from_storage()
    {
        $storage = new SessionStorage();
        $storage->put('first', 'bar');
        $storage->put('second', 'foo');

        $this->assertEquals(['first' => 'bar', 'second' => 'foo'], $storage->all());
    }

    /** @test */
    public function it_can_count_items_in_storage()
    {
        $storage = new SessionStorage();
        $storage->put('first', 'bar');
        $storage->put('second', 'foo');

        $this->assertEquals(2, $storage->count());
    }

    /** @test */
    public function it_can_put_item_to_the_storage()
    {
        $storage = new SessionStorage();

        $storage->put('foo', 'bar');

        $this->assertEquals('bar', $storage->get('foo'));
    }

    /** @test */
    public function it_can_delete_item_from_the_storage()
    {
        $storage = new SessionStorage();
        $storage->put('foo', 'bar');

        $storage->forget('foo');

        $this->assertFalse($storage->has('foo'));
    }

    /** @test */
    public function it_can_clear_storage()
    {
        $storage = new SessionStorage();
        $storage->put('first', 'bar');
        $storage->put('second', 'foo');

        $storage->clear();

        $this->assertEquals([], $storage->all());
    }
}
