<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\BrendRequest;
use App\Models\Brend;
use App\Models\Product;
use App\Services\BrendService;
use Illuminate\Http\RedirectResponse;

class BrendController extends BaseController
{
    /**
     * Create a new instance of BrendController.
     *
     * @param ProductController $productController
     */
    public function __construct(private ProductController $productController)
    {
    }

    /**
     * Display a list of Brends in descending order by ID.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $brends = Brend::orderBy('id', 'desc')->get();

        return view('dashboard.brend.crud', [
            'brends' => $brends
        ]);
    }

    /**
     * Store a new Brend record.
     *
     * @param BrendRequest $request The validated request data.
     * @return RedirectResponse A redirect response.
     */
    public function store(BrendRequest $request): RedirectResponse
    {
        try {
            // Create a new instance of the BrendService.
            $brendService = new BrendService();

            // Store the validated data using the service.
            $brendService->store($request->validated());

            return redirect()->route('dashboard.brend.index')
                ->with('success', 'Data uploaded successfully.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.brend.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Update a Brend record.
     *
     * @param BrendRequest $request The validated request data.
     * @param int $id The ID of the Brend record to update.
     * @return RedirectResponse A redirect response with a success or error message.
     */
    public function update(BrendRequest $request, $id): RedirectResponse
    {
        $brendService = new BrendService();

        try {
            $brendService->update($request->validated(), $id);
            $message = 'Data updated successfully.';
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return redirect()->route('dashboard.brend.index')->with('message', $message);
    }

    public function destroy($id)
    {
        $this->deleteFile('\Brend', $id, 'photo');
        Brend::find($id)->delete();
        foreach (Product::where('brend_id', $id)->get() as $prod) {
            $this->productController->destroy($prod->id);
        }
        return back()->with('success', 'Data deleted.');
    }
}
