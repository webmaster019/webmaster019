<?php

namespace Lefuturiste\LocalStorage;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Adbar\Dot;

class LocalStorage
{

    /**
     * @var string
     */
    private $path;

    /**
     * @var Dot
     */
    private $state;

    public function __construct(string $path)
    {
        $this->path = $path;
        $this->read();
    }

    private function read(): void
    {
        if (!file_exists($this->path)) {
            $state = [];
        } else {
            $contents = json_decode(file_get_contents($this->path), true);
            $state = $contents == NULL ? [] : $contents;
        }
        $this->state = new \Adbar\Dot($state);
    }

    public function write(): self
    {
        file_put_contents($this->path, json_encode($this->state->all()));

        return $this;
    }

    public function save(): self
    {
        return $this->write();
    }

    public function persist(): self
    {
        return $this->write();
    }

    public function getState()
    {
        return $this->state->get();
    }

    public function getAll($details = false): array
    {
        $all = [];
        $flat = $this->state->flatten();
        foreach ($flat as $key => $value) {
            if (strpos($key, '.at') !== false) {
                continue;
            }
            $key = str_replace('.value', '', $key);
            if ($details) {
                $all[$key] = [
                    'value' => $value,
                    'at' => $flat[$key . '.at']
                ];
            } else {
                $all[$key] = $value;
            }
        }
        return $all;
    }

    public function exists(string $key): bool
    {
        return $this->state->has($key);
    }

    public function exist(string $key): bool
    {
        return $this->state->has($key);
    }

    public function has(string $key): bool
    {
        return $this->state->has($key);
    }

    public function get(string $key, $default = NULL)
    {
        $item = $this->state->get($key, NULL);
        if ($item === NULL) {
            return $default;
        }
        return $item['value'];
    }

    public function set(string $key, $value, $withDate = true): self
    {
        $context = [
            'value' => $value,
            'at' => $withDate ? (new Carbon())->toDateTimeString() : NULL
        ];
        $this->state->set($key, $context);

        return $this;
    }

    public function del(string $key): self
    {
        $this->state->delete($key);

        return $this;
    }

    public function delete(string $key): self
    {
        return $this->del($key);
    }

    public function remove(string $key): self
    {
        return $this->del($key);
    }

    public function deleteOlderThan(CarbonInterval $duration): self
    {
        $toCompare = new Carbon();
        $toCompare->add($duration->invert());
        foreach ($this->getAll(true) as $key => $item)
        {
            $dateItem = new Carbon($item['at']);
            if (!$dateItem->greaterThan($toCompare)){
                $this->state->delete($key);
            }
        }

        return $this;
    }

    public function clear(): self
    {
        $this->state->clear();

        return $this;
    }

    public function reset(): self
    {
        return $this->clear();
    }

    public function isEmpty(): bool
    {
        return $this->state->count() === 0;
    }

    /**
     * Delete the json storage file
     */
    public function unlinkStorage(): self
    {
        unlink($this->path);

        return $this;
    }

    public function getCount(): int
    {
        return count($this->state);
    }

    public function getCreationDateTime(string $key)
    {
        return $this->state->has($key) ? $this->state->get($key)['at'] : NULL;
    }

    public function getPath()
    {
        return $this->path;
    }
}
