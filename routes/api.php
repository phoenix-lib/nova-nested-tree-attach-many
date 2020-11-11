<?php

Route::get('/{resource}/{resourceId}/attached/{relationship}', 'PhoenixLib\NovaNestedTreeAttachMany\Http\Controllers\NestedTreeController@attached');