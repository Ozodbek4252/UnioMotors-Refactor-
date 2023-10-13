<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\BrendStoreRequest;
use App\Http\Requests\BrendUpdateRequest;
use App\Models\Brend;
use App\Models\Product;
use App\Services\BrendService;

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
     * @param BrendStoreRequest $request The validated request data.
     * @return \Illuminate\Http\RedirectResponse A redirect response.
     */
    public function store(BrendStoreRequest $request)
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

    public function update(BrendUpdateRequest $request, $id)
    {
        $result = (new BrendService())->update($request->validated(), $id);
        if ($result['status']) {
            return redirect()->route('dashboard.brend.index')->with('success', $result['message']);
        }
        return redirect()->route('dashboard.brend.index')->with('error', $result['message']);
    }

    public function destroy($id)
    {
        $this->fileDelete('\Brend', $id, 'photo');
        Brend::find($id)->delete();
        foreach (Product::where('brend_id', $id)->get() as $prod) {
            $this->productController->destroy($prod->id);
        }
        return back()->with('success', 'Data deleted.');
    }
}
