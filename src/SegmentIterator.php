<?php
declare(strict_types=1);

namespace Inforisorse\OdtPhp;

class SegmentIterator implements \RecursiveIterator
{
    private $ref;
    private $key;

    public function __construct(array $ref)
    {
        $this->ref = $ref;
        $this->key = 0;
        $this->keys = array_keys($this->ref);
    }

    public function hasChildren()
    {
        return $this->valid() && $this->current() instanceof Segment;
    }

    public function current()
    {
        return $this->ref[$this->keys[$this->key]];
    }

    public function getChildren()
    {
        return new self($this->current()->children);
    }

    public function key()
    {
        return $this->key;
    }

    public function valid()
    {
        return array_key_exists($this->key, $this->keys);
    }

    public function rewind()
    {
        $this->key = 0;
    }

    public function next()
    {
        $this->key ++;
    }
}
