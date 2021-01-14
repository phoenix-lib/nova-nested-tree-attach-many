<?php

namespace PhoenixLib\NovaNestedTreeAttachMany\Http\Controllers;

use Illuminate\Routing\Controller;
use Laravel\Nova\Http\Requests\NovaRequest;
use PhoenixLib\NovaNestedTreeAttachMany\Domain\Relation\RelationHandlerFactory;

class NestedTreeController extends Controller
{
    private $factory;

    public function __construct(RelationHandlerFactory $factory)
    {
        $this->factory = $factory;
    }

    public function attached(NovaRequest $request, $resource, $resourceId, $relationship, $idKey)
    {
        $model = $request->findResourceOrFail()->model();

        $relation = get_class($model->{$relationship}());

        $handler = $this->factory->make($relation);

        return $handler->retrieve($model, $relationship, $idKey);
    }
}
