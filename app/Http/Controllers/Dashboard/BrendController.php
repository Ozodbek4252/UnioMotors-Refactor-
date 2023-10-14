<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\BrendRequest;
use App\Models\Brend;
use App\Services\BrendService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class BrendController extends BaseController
{
    /**
     * Create a new instance of BrandService.
     *
     * @param BrendService $service The BrandService instance.
     */
    public function __construct(private BrendService $service)
    {
    }

    /**
     * Display a list of Brands in descending order by ID.
     *
     * @return View
     */
    public function index(): View
    {
        $brands = Brend::orderBy('id', 'desc')->get();

        return view('dashboard.brend.crud', [
            'brends' => $brands
        ]);
    }

    /**
     * Store a new Brand record.
     *
     * @param BrendRequest $request The validated request data.
     * @return RedirectResponse A redirect response.
     */
    public function store(BrendRequest $request): RedirectResponse
    {
        try {
            // Store the validated data using the service.
            $this->service->store($request->validated());

            return redirect()->route('dashboard.brend.index')
                ->with('success', 'Data uploaded successfully.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.brend.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Update a Brand record.
     *
     * @param BrendRequest $request The validated request data.
     * @param int $id The ID of the Brand record to update.
     * @return RedirectResponse A redirect response with a success or error message.
     */
    public function update(BrendRequest $request, $id): RedirectResponse
    {
        try {
            $this->service->update($request->validated(), $id);
            $message = 'Data updated successfully.';
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return redirect()->route('dashboard.brend.index')->with('message', $message);
    }

    /**
     * Delete a brand and its associated products.
     *
     * @param int $id The ID of the brand to delete.
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->service->delete($id);
            return back()->with('success', 'Brand deleted.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
