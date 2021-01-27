<?php

namespace PhoenixLib\NovaNestedTreeAttachMany\Domain\Cache;

use Illuminate\Support\Collection;

interface Cache
{
    public function get( $tag ): Collection;

    public function put( $tag, $data ): void;

    public function has( $tag ): bool;
}
