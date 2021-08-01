<?php

class LocalStorageTest extends \PHPUnit\Framework\TestCase
{
    public function getInstance(): \Lefuturiste\LocalStorage\LocalStorage
    {
        return new \Lefuturiste\LocalStorage\LocalStorage(dirname(__DIR__) . '/tmp/data.json');
    }

    public function testNested()
    {
        $instance =
            $this->getInstance()
                ->clear()
                ->set('foo.bar', 'value')
                ->set('item.fr.slug-slug', ['foo' => 'bar']);
        
        $this->assertEquals('value', $instance->get('foo.bar'));
        $this->assertEquals(['foo' => 'bar'], $instance->get('item.fr.slug-slug'));
        $this->assertEquals(NULL, $instance->get('level1.level2'));
        $this->assertEquals(false, $instance->exists('level1.level2'));
    }

    public function testLocalStorage()
    {
        $localStorage = $this->getInstance();
        $localStorage->clear();
        $localStorage->persist();
        $localStorage = $this->getInstance();
        $this->assertEquals([], $localStorage->getAll());
        $localStorage->set('key', 'value');
        $this->assertNull($localStorage->get('foo'));
        $this->assertEquals('value', $localStorage->get('key'));
        $this->assertEquals(['key' => 'value'], $localStorage->getAll());
        $this->assertEquals(['key' => ['value' => 'value', 'at' => (new \Carbon\Carbon())->toDateTimeString()]], $localStorage->getState());
        $localStorage->save();
        $localStorage = $this->getInstance();
        $this->assertEquals(['key' => 'value'], $localStorage->getAll());
        $localStorage->clear();
        $localStorage->persist();
        $this->assertEquals([], $localStorage->getAll());
        $localStorage = $this->getInstance();
        $this->assertEquals([], $localStorage->getAll());
        $localStorage->set('foo', ['foo' => 'bar']);
        $localStorage->persist();
        $localStorage = $this->getInstance();
        $this->assertEquals(['foo' => 'bar'], $localStorage->get('foo'));
        $this->assertFalse($localStorage->isEmpty());
        $this->assertEquals(1, $localStorage->getCount());
        $localStorage->del('foo');
        $this->assertEquals([], $localStorage->getAll());
        $localStorage->write();
        $localStorage = $this->getInstance();
        $this->assertEquals([], $localStorage->getAll());
        $this->assertTrue($localStorage->isEmpty());
        $this->assertEquals(0, $localStorage->getCount());
    }

    public function testIfExist()
    {
        $localStorage = $this->getInstance();
        $localStorage->set('foo', 'bar');
        $this->assertTrue($localStorage->exist('foo'));
        $this->assertFalse($localStorage->exist('hello'));
        $localStorage->save();
        $localStorage = $this->getInstance();
        $this->assertTrue($localStorage->exist('foo'));
        $this->assertFalse($localStorage->exist('hello'));
        $localStorage->remove('foo');
        $localStorage->set('hello','world');
        $localStorage->save();
        $localStorage = $this->getInstance();
        $this->assertFalse($localStorage->exist('foo'));
        $this->assertTrue($localStorage->exist('hello'));
        $localStorage->clear();
        $localStorage->save();
    }

    public function testFileUnlink()
    {
        $localStorage = $this->getInstance();
        $localStorage->set('foo', 'bar');
        $this->assertEquals('bar', $localStorage->get('foo'));
        $localStorage->save();
        $localStorage = $this->getInstance();
        $this->assertTrue($localStorage->exist('foo'));
        $this->assertTrue(file_exists($localStorage->getPath()));
        $localStorage->unlinkStorage();
        $this->assertFalse(file_exists($localStorage->getPath()));
        $localStorage = $this->getInstance();
        $this->assertTrue($localStorage->isEmpty());
    }

    public function testDeleteDatetimeSecondScale()
    {
        $localStorage = $this->getInstance();
        $localStorage->set('to_expire', 'foo');
        sleep(1);
        $localStorage->set('to_expire2', 'bar');
        sleep(1);
        $localStorage->deleteOlderThan(\Carbon\CarbonInterval::seconds(2));
        $this->assertNull($localStorage->get('to_expire'));
        $this->assertNotNull($localStorage->get('to_expire2'));
        $this->assertEquals('bar', $localStorage->get('to_expire2'));
    }

    public function testChainability()
    {
        $localStorage = $this->getInstance()
            ->clear()
            ->save()
            ->set('key', 'value')
            ->save();
        $this->assertInstanceOf(\Lefuturiste\LocalStorage\LocalStorage::class, $localStorage);
        $this->assertEquals('value', $localStorage->get('key'));
        $localStorage = $localStorage->remove('key')->save();
        $this->assertNull($localStorage->get('key'));
    }

    public function testDeleteDatetimeMinuteScaleWithWrite()
    {
        $localStorage = $this->getInstance();
        $localStorage->set('key', 'value');
        $this->assertEquals('value', $localStorage->get('key'));
        $this->assertEquals((new \Carbon\Carbon())->toDateTimeString(), $localStorage->getCreationDateTime('key'));
        $localStorage->persist();
        fwrite(STDERR, print_r("\n > Enter in an expected sleep mode (10s) \n", true));
        sleep(10);
        fwrite(STDERR, print_r("\n > Exited a expected sleep mode \n", true));
        $localStorage = $this->getInstance();
        $this->assertEquals('value', $localStorage->get('key'));
        $localStorage->deleteOlderThan(\Carbon\CarbonInterval::seconds(10));
        $this->assertNull($localStorage->get('key'));
    }
}
