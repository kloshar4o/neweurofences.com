<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\GoodsPhoto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\GoodsSize;
use App\Models\Lang;


class CartController extends Controller
{

    public function updateQuantity(Request $request)
    {

        $cart = session()->get('cart') ?: [];

        $category_id = $request->get('$category_key');
        $product_id = $request->get('$product_key');
        $size_id = $request->get('$size_key');
        $color_id = $request->get('$color_key');
        $quantity = $request->get('$event');


        $cart[$category_id] =
            $cart[$category_id] ?? [];

        $cart[$category_id][$product_id] =
            $cart[$category_id][$product_id] ?? [];

        $cart[$category_id]['category_url'] =
            $cart[$category_id]['category_url'] ?? $request->get('$category_url');

        $cart[$category_id][$product_id]['product_url'] =
            $cart[$category_id][$product_id]['product_url'] ?? $request->get('$product_url');

        if ($color_id) {

            $cart[$category_id][$product_id][$size_id] =
                $cart[$category_id][$product_id][$size_id] ?? [];

            $cart[$category_id][$product_id][$size_id][$color_id] =
                $cart[$category_id][$product_id][$size_id][$color_id] ?? [];

            if ($quantity)
                $cart[$category_id][$product_id][$size_id][$color_id]['quantity'] = $quantity;
            else {
                unset($cart[$category_id][$product_id][$size_id][$color_id]);

                if (count($cart[$category_id][$product_id][$size_id]) === 0) {
                    unset($cart[$category_id][$product_id][$size_id]);

                    if (count($cart[$category_id][$product_id]) === 1) {
                        unset($cart[$category_id][$product_id]);

                        if (count($cart[$category_id]) === 1) {
                            unset($cart[$category_id]);

                            if (count($cart) === 0)
                                $cart = null;


                        }

                    }

                }
            }


        }
        elseif ($size_id) {

            $cart[$category_id][$product_id][$size_id] = $cart[$category_id][$product_id][$size_id] ?? [];

            if ($quantity)
                $cart[$category_id][$product_id][$size_id]['quantity'] = $quantity;
            else {

                unset($cart[$category_id][$product_id][$size_id]);

                if (count($cart[$category_id][$product_id]) === 1) {
                    unset($cart[$category_id][$product_id]);


                    if (count($cart[$category_id]) === 1) {
                        unset($cart[$category_id]);


                        if (count($cart) === 0) {
                            $cart = null;

                        }
                    }
                }
            }

        }
        else {

            if ($quantity)
                $cart[$category_id][$product_id]['quantity'] = $quantity;
            else {
                unset($cart[$category_id][$product_id]);

                if (count($cart[$category_id]) === 1) {
                    unset($cart[$category_id]);

                    if (count($cart) === 0) {
                        $cart = null;

                    }
                }

            }
        }

        session()->put('cart', $cart);

        if ($request->get('miniCart')) {

            return response()->json(
                [
                    'status' => true,
                    'html' => view('front.minicart')->render(),
                    'cart_empty' => !$cart
                ]
            );
        }


        return response()->json(
            [
                'status' => true,
                'session' => $cart
            ]
        );
    }

    public function ajaxCart(Request $request)
    {
        $data = $request->all();

        $category_id = $data["category_id"];
        $product_id = $data["product_id"];
        $product_url = $data["product_url"];
        $category_url = $data["category_url"];
        $color_id = $data["color_id"];
        $quantity = $data["quantity"];
        $size_id = $data["size_id"];


        $cart = session()->get('cart') ?: [];


        // if cart is empty then this the first product
        if ($cart) {

            $cart[$category_id]['category_url'] = $category_url;
            $cart[$category_id][$product_id]['product_url'] = $product_url;

            if ($color_id) {

                if (!isset($cart[$category_id][$product_id][$size_id]))
                    $cart[$category_id][$product_id][$size_id] = [];

                if (!isset($cart[$category_id][$product_id][$size_id][$color_id]))
                    $cart[$category_id][$product_id][$size_id][$color_id] = [];


                if (isset($cart[$category_id][$product_id][$size_id][$color_id]['quantity'])) {
                    $oldQuantity = $cart[$category_id][$product_id][$size_id][$color_id]['quantity'];
                    $cart[$category_id][$product_id][$size_id][$color_id]['quantity'] = $oldQuantity + $quantity;
                } else {
                    $cart[$category_id][$product_id][$size_id][$color_id]['quantity'] = $quantity;
                }


            } elseif ($size_id) {

                if (!isset($cart[$category_id][$product_id][$size_id]))
                    $cart[$category_id][$product_id][$size_id] = [];

                if (isset($cart[$category_id][$product_id][$size_id]['quantity'])) {
                    $oldQuantity = $cart[$category_id][$product_id][$size_id]['quantity'];
                    $cart[$category_id][$product_id][$size_id]['quantity'] = $oldQuantity + $quantity;

                } else {

                    $cart[$category_id][$product_id][$size_id]['quantity'] = $quantity;
                }

            } else {

                if (isset($cart[$category_id][$product_id]['quantity'])) {
                    $oldQuantity = $cart[$category_id][$product_id]['quantity'];
                    $cart[$category_id][$product_id]['quantity'] = $oldQuantity + $quantity;
                } else {
                    $cart[$category_id][$product_id]['quantity'] = $quantity;
                }
            }

        } else {

            $cart[$category_id] = [];
            $cart[$category_id]['category_url'] = $category_url;

            $cart[$category_id][$product_id] = [];
            $cart[$category_id][$product_id]['product_url'] = $product_url;


            if ($color_id) {
                $cart[$category_id][$product_id][$size_id] = [];
                $cart[$category_id][$product_id][$size_id][$color_id] = [];
                $cart[$category_id][$product_id][$size_id][$color_id]['quantity'] = $quantity;

            } elseif ($size_id) {
                $cart[$category_id][$product_id][$size_id] = [];
                $cart[$category_id][$product_id][$size_id]['quantity'] = $quantity;

            } else {
                $cart[$category_id][$product_id]['quantity'] = $quantity;
            }
        }

        session()->put('cart', $cart);

        return response()->json(
            [
                'status' => true,
                'html' => view('front.minicart')->render(),
            ]
        );
    }

    public static function miniCart($lang_id, $cart)
    {

        $miniCart = [];


        foreach ($cart as $category_id => $products) {

            $category = getTableById('goods_subject', 'goods_subject_id', $category_id, $lang_id, 'first');

            if(!$category) continue;

            $miniCart[$category_id]['name'] = $category->name;
            $miniCart[$category_id]['url'] = $products['category_url'];

            foreach ($products as $product_id => $productValues) {
                if ($product_id == 'category_url') continue;

                $quantity = isset($productValues['quantity']) ? $productValues['quantity'] : null;
                $sizes = $quantity ? [] : $productValues;

                $product = getTableById('goods_item', 'goods_item_id.id', $product_id, $lang_id, 'first');
                $product->quantity = $quantity;
                $product->has_sizes = !$quantity;
                $product->url = $productValues['product_url'];

                $product->img = GoodsPhoto::where('goods_item_id', $product->id)
                    ->where('active', 1)
                    ->get()
                    ->first();

                if ($product->img)
                    $product->img = $product->img->img;


                $product->money = $product->price ? $product->money = money($product->price) : myTrans('Not_fixed');

                foreach (['id', 'sku', 'name', 'alias', 'price', 'money', 'img', 'quantity', 'url', 'has_sizes'] as $key) {
                    $miniCart[$category_id]['products'][$product_id][$key] = $product->{$key};
                }

                foreach ($sizes as $size_id => $sizeValues) {
                    if ($size_id == 'product_url') continue;


                    $quantity = isset($sizeValues['quantity']) ? $sizeValues['quantity'] : null;
                    $colors = $quantity ? [] : $sizeValues;


                    $size = GoodsSize::where('id', $size_id)->get()->first();
                    $size->quantity = $quantity;
                    $size->has_colors = !$quantity;
                    $size->label = sizeLabel($size);

                    $size->money = $size->price ? $size->money = money($size->price) : myTrans('Not_fixed');

                    foreach (['id', 'sku', 'width', 'height', 'gap', 'thickness', 'img', 'quantity', 'price', 'money', 'label', 'has_colors'] as $key) {
                        $miniCart[$category_id]['products'][$product_id]['sizes'][$size_id][$key] = $size->{$key};
                    }

                    foreach ($colors as $color_id => $colorArr) {
                        $color = getTableById('goods_colors', 'goods_colors_id', $color_id, $lang_id, 'first');

                        if (!$color) continue;

                        $color->quantity = $colorArr['quantity'];

                        foreach (['id', 'ral', 'hex', 'name', 'quantity'] as $key) {
                            $miniCart[$category_id]['products'][$product_id]['sizes'][$size_id]['colors'][$color_id][$key] = $color->{$key};
                        }
                    }
                }
            }
        }


        return $miniCart;
    }
}

