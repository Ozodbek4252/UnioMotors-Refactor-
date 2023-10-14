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

    /**
     * Update a Slider record.
     *
     * @param SliderRequest $request The validated request data.
     * @param int $id The ID of the Slider record to update.
     * @return RedirectResponse A redirect response with a success or error message.
     */
    public function update(SliderRequest $request, $id): RedirectResponse
    {
        try {
            $this->service->update($request->validated(), $id);
            $message = 'Data updated successfully.';
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return redirect()->route('dashboard.slider.index')->with('message', $message);
    }

    /**
     * Delete a slider and its associated products.
     *
     * @param int $id The ID of the slider to delete.
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->service->delete($id);
            return back()->with('success', 'Slider deleted.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
