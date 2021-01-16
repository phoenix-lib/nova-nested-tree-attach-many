<?php

namespace PhoenixLib\NovaNestedTreeAttachMany\Domain\Relation;

use DomainException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use PhoenixLib\NovaNestedTreeAttachMany\Domain\Relation\Handlers\RelationHandler;

class RelationHandlerResolver implements RelationHandlerFactory
{
    private $handlers;

    public function __construct(){
        $this->handlers = new Collection;
    }

    public function make( $relation ): RelationHandler
    {
        // at first search in registered handlers, user can register his own handlers
        $relationClass = get_class($relation);

        if($this->handlers->has($relationClass))
        {
            return $this->handlers->get($relationClass);
        }

        // then try to check is relation has instance of base relations
        $handler = $this->handlers->first(function (RelationHandler $handler) use ($relation){
            $handlerRelation = $handler->relation();
            return $relation instanceof $handlerRelation;
        });

        if($handler)
        {
            return $handler;
        }

        // oops, not registered relation
        throw new DomainException(sprintf('RelationHandler for relation: %s is not registered', $relationClass));
    }

    public function register( RelationHandler $handler ): void
    {
        $this->handlers->put($handler->relation(), $handler);
    }

    public function unregister( RelationHandler $handler ): void
    {
        if($this->handlers->has($handler->relation()))
        {
            $this->handlers->forget($handler->relation());
        }
    }

    public function registeredHandlers(): Collection
    {
        return $this->handlers;
    }

    public function unregisterAll(): void
    {
        $this->handlers = new Collection;
    }
}
