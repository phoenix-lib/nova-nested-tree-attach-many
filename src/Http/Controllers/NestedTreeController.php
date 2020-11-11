<?php

namespace PhoenixLib\NovaNestedTreeAttachMany\Http\Controllers;

use Illuminate\Routing\Controller;
use Laravel\Nova\Http\Requests\NovaRequest;

class NestedTreeController extends Controller
{
    public function attached(NovaRequest $request, $parent, $parentId, $relationship)
    {
        return $request->findResourceOrFail()
            ->model()
            ->{$relationship}
            ->pluck('id');
    }
}