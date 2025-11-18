<?php

namespace App\Http\Controllers;

use App\Models\DeliveryFee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DeliveryController extends Controller
{
    public function index(): View
    {
        return view('admin.delivery.index', [
            'fees' => DeliveryFee::orderBy('wilaya')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.delivery.create');
    }

    public function store(Request $request): RedirectResponse
    {
        DeliveryFee::create($this->validateData($request));

        return redirect()->route('admin.livraison.index')->with('success', 'Frais ajoutés.');
    }

    public function edit(DeliveryFee $deliveryFee): View
    {
        return view('admin.delivery.edit', [
            'fee' => $deliveryFee,
        ]);
    }

    public function update(Request $request, DeliveryFee $deliveryFee): RedirectResponse
    {
        $deliveryFee->update($this->validateData($request));

        return redirect()->route('admin.livraison.index')->with('success', 'Frais mis à jour.');
    }

    public function destroy(DeliveryFee $deliveryFee): RedirectResponse
    {
        $deliveryFee->delete();
        return back()->with('success', 'Frais supprimés.');
    }

    public function showFee(Request $request): JsonResponse
    {
        $request->validate([
            'wilaya' => ['required', 'string'],
            'delivery_type' => ['required', 'in:home,office'],
        ]);

        $fee = DeliveryFee::where('wilaya', $request->input('wilaya'))->first();

        if (! $fee) {
            return response()->json(['message' => 'Wilaya non configurée.'], 404);
        }

        return response()->json([
            'fee' => $fee->getFeeForType($request->input('delivery_type')),
        ]);
    }

    protected function validateData(Request $request): array
    {
        return $request->validate([
            'wilaya' => ['required', 'string', 'max:150'],
            'fee_home' => ['required', 'numeric', 'min:0'],
            'fee_office' => ['required', 'numeric', 'min:0'],
        ]);
    }
}
