<?php

namespace App\Http\Controllers\Cp;

use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MoveSliderController extends Controller
{

    public function update(Request $request)
    {
        $currentSlider = Slider::findOrFail($request->id);
        $currentSliderOrder = $currentSlider->order;
        if ($request->type == 'up') {
            $previousSlider = $currentSlider->previous();
            $currentSlider->update([
                'order' => $previousSlider->order
            ]);
            $previousSlider->update([
                'order' => $currentSliderOrder
            ]);
        }

        if ($request->type == 'down') {
            $nextSlider = $currentSlider->next();
            $currentSlider->update([
                'order' => $nextSlider->order
            ]);
            $nextSlider->update([
                'order' => $currentSliderOrder
            ]);
        }

        return response()->json([
            'status' => 'Success'
        ]);
    }

}
