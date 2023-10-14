<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\SliderRequest;
use App\Http\Requests\SliderUpdateRequest;
use App\Models\Slider;
use App\Services\SliderService;
use Illuminate\Http\RedirectResponse;

class SliderController extends BaseController
{
    /**
     * Create a new instance of SliderService.
     *
     * @param SliderService $service The SliderService instance.
     */
    public function __construct(private SliderService $service)
    {
    }

    /**
     * Display a list of Sliders in descending order by ID.
     *
     * @return View
     */
    public function index()
    {
        $sliders = Slider::orderBy('id', 'desc')->get();
        return view('dashboard.slider.crud', [
            'sliders' => $sliders
        ]);
    }

    /**
     * Store a new Slider record.
     *
     * @param SliderRequest $request The validated request data.
     * @return RedirectResponse A redirect response.
     */
    public function store(SliderRequest $request): RedirectResponse
    {
        try {
            // Store the validated data using the service.
            $this->service->store($request->validated());

            return redirect()->route('dashboard.slider.index')
                ->with('success', 'Data uploaded successfully.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.slider.index')
                ->with('error', $e->getMessage());
        }
    }

    public function update(SliderUpdateRequest $request, $id)
    {
        $result = (new SliderService())->update($request->validated(), $id, $request->file('photo'));
        if ($result['status']) {
            return redirect()->route('dashboard.slider.index')->with('success', $result['message']);
        }
        return redirect()->route('dashboard.slider.index')->with('error', $result['message']);
    }

    public function destroy($id)
    {
        $this->fileDelete('\Slider', $id, 'photo');
        Slider::find($id)->delete();
        return back()->with('success', 'Data deleted.');
    }
}
