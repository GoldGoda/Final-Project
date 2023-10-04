<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user)
        {
            $cartItems = Cart::with('product')
                ->where('user_id', $user->id)
                ->get()
                ->groupBy('product.id')
                ->map(function ($groupedItems) {
                    $product = $groupedItems->first()->product;
                    $count = count($groupedItems);
                    $product->count = $count;
                    return $product;
                });

            if (!$request->ajax()) return view('cart.index', compact('cartItems'));
            return response()->json($cartItems, 200);
        }
        else
        {

            return view('home');
        }
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        if ($user)
        {
            $newItem = new Cart([ "user_id" => $user->id, "product_id" => $request->id ]);
            $newItem->save();
            return response()->json([], 200);
        }

        return response()->json([], 400);

    }

    public function destroy($id)
    {
        $user = Auth::user();

        if ($user) {
            // Buscar el primer elemento que coincida con user_id y product_id
            $cartItem = Cart::where('user_id', $user->id)
                ->where('product_id', $id)
                ->first();

            if ($cartItem) {
                // Si se encuentra el elemento, eliminarlo
                $cartItem->delete();
                return response()->json([], 200);
            }

            // Si no se encuentra el elemento, puedes manejarlo de alguna manera
            // o simplemente retornar una respuesta JSON vacía
            return response()->json([], 200);
        } else {
            return response()->json([], 400);
        }
    }

}
