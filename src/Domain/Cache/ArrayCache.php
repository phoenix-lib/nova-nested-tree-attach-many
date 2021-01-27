<?php

namespace PhoenixLib\NovaNestedTreeAttachMany\Domain\Cache;

use Illuminate\Support\Collection;

class ArrayCache implements Cache
{
    /** @var $cache Collection*/
    private $cache;

    public function __construct(){
        $this->cache = Collection::make();
    }

    public function get( $tag ): Collection
    {
        return $this->cache->get($tag);
    }

    public function put( $tag, $data ): void
    {
        $this->cache->put($tag, $data);
    }

    public function has($tag): bool
    {
        return $this->cache->has($tag);
    }
}
