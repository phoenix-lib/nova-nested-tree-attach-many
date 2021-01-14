<?php

Route::get('/{resource}/{resourceId}/attached/{relationship}/{idKey}', 'PhoenixLib\NovaNestedTreeAttachMany\Http\Controllers\NestedTreeController@attached');
