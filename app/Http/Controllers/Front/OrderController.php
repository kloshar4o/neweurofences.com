<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\API\ZohoController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\BasketId;
use App\Models\GoodsColorsId;
use App\Models\Brand;
use App\Models\GoodsItem;
use App\Models\GoodsItemComments;
use App\Models\GoodsItemId;
use App\Models\GoodsPhoto;
use App\Models\GoodsSubject;
use App\Models\GoodsSubjectId;
use App\Models\Orders;
use App\Models\OrdersUsers;
use App\Models\OrdersData;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    protected $provider;
    private $lang_id;
    private $lang;

    public function __construct()
    {
        $this->lang_id = $this->lang()['lang_id'];
        $this->lang = $this->lang()['lang'];
    }

    public function index()
    {
        $view = '';

        return view($view);
    }

    public function NewOrder()
    {

        $lang = Input::get('lang');
        $cart = session()->get('cart');

        if ($cart) {


            $my_email = showSettingBodyByAlias('email-phone', $this->lang_id);

            $form = Input::all();

            unset($form['lang']);
            unset($form['token']);

            $page = view('front.email.emailNewOrder', ['lang' => $lang, 'form' => $form])->render();

            sendEmail($my_email, $form['name'], $form['email'], "garduriMD.ro", $page, 'Comanda');

            $subject = "Comandă nouă GarduriMD.ro";

            Mail::send(
                'front.email.emailNewOrder',
                ['lang' => $lang, 'form' => $form, 'forClient' => true],
                function ($message) use ($form, $subject) {
                    $message->to($form['email']);
                    $message->subject($subject);
                    $message->from(showSettingBodyByAlias('send-email-from', $this->lang_id), 'GMD');

                });

            session()->forget('cart');

            ZohoController::createUpdateContact($form['email'], $form['name'], [
                'contact' => [
                    'notes' => $form['message'],
                    'billing_address' => [
                        'city' => $form['city'],
                        'address' => $form['address'],
                    ]
                ],
                'person' => [
                    "phone" => $form['phone']
                ]
            ]);

            return response()->json([
                'status' => true,
                'messages' => 'Email sent',
            ]);

        } else
            return response()->json([
                'status' => false,
                'messages' => 'Something was wrong',
            ]);


    }


    //PayPal
    public function getExpressCheckoutSuccess(Request $request)
    {
        $token = $request->get('token');
        $response = $this->provider->getExpressCheckoutDetails($token);
        $basket_id = BasketId::where('id', $request->get('inv'))
            ->first();
        if ($response) {
            if (!empty($basket_id)) {
                $order = Orders::where('basket_id', $basket_id->id)
                    ->where('deleted', 0)
                    ->where('paid', 0)
                    ->update(['paid' => 1]);

                $basket = Basket::where('basket_id', $basket_id->id)
                    ->get();

                $order_user = OrdersUsers::whereRaw('orders_id IN(  SELECT DISTINCT id FROM orders WHERE basket_id = ' . $basket_id->id . ')')->first();

                $order_total = OrdersData::whereRaw('orders_id IN(  SELECT DISTINCT id FROM orders WHERE basket_id = ' . $basket_id->id . ')')->first();

                $my_email = showSettingBodyByAlias('email-phone', $this->lang_id);
                $subject = "You have new order on O'blancShop.md";

                Mail::send('front.email.emailNewOrder', ['data_user' => $order_user, 'data_order' => $basket, 'data_total' => $order_total, 'order' => $order], function ($message) use ($my_email, $subject) {
                    $message->from(showSettingBodyByAlias('send-email-from', $this->lang_id), Input::get('name'));
                    $message->to($my_email);
                    $message->subject($subject);
                });


                return redirect($this->lang . '/Payment?s=true');
            }
        } else {
            return redirect($this->lang);
        }
    }

    protected function getCheckoutData()
    {
        $data = [];

        $order = Orders::where('basket_id', Cookie::get('basket'))
            ->first();
        if (!is_null($order)) {

            $basket_id = BasketId::where('id', Cookie::get('basket'))
                ->first();

            $basket = Basket::where('basket_id', Cookie::get('basket'))
                ->get();

            $total_count = 0;
            $total_price = 0;

            if (!$basket->isEmpty()) {
                foreach ($basket as $one_item) {
                    $total_price += $one_item->goods_price * $one_item->items_count;
                    $total_count += $one_item->items_count;
                }
            }
            $data1 = [
                'item_count' => $total_count,
                'total_pay' => $total_price,
            ];

            $items_array = [];
            foreach ($basket as $one_item) {
                $basket_items =
                    [
                        'name' => $one_item->goods_name . ' - Color: ' . $one_item->colors_name . ' - Size (' . $one_item->size_type . '): ' . $one_item->size_name . ' x ' . $one_item->items_count,
                        'price' => $one_item->goods_price,
                        'qty' => $one_item->items_count,
                    ];

                array_push($items_array, $basket_items);
            }

            $data['items'] = $items_array;

            $data['return_url'] = url($this->lang . '/paypal/ec-checkout-success?inv=' . $basket_id->id);
            $data['invoice_description'] = "Order " . $basket_id->id . '979' . rand(5, 15);
            $data['invoice_id'] = $basket_id->id;
            $data['cancel_url'] = url($this->lang . '/Payment?s=false');

            $total = 0;
            foreach ($data['items'] as $item) {
                $total += $item['price'] * $item['qty'];
            }

            $data['total'] = $total;

            Cookie::queue(Cookie::forget('basket'));

            return $data;
        }

    }

    //End PayPal
    protected function paymentResponse()
    {
        $view = 'front.pages.payment';

        $status = Input::get('s');
        if ($status == 'true') {
            $status_title = 'Оплата успешно совершена';
            $status_link = 'Продолжить покупки';
        } elseif ($status == 'false') {
            $status_title = 'Оплата не была совершена.';
            $status_link = 'Создать новый заказ';
        } else {
            return redirect($this->lang);
        }

        return view($view, compact('status', 'status_title', 'status_link'));
    }

    public function email()
    {
        Mail::send('front.email.em', ['user' => ''], function ($message) {
            $message->sender('no-replay@sender.com', "Company");
            $message->to('sapovalov322@gmail.com');
            $message->subject('=?utf-8?B?' . base64_encode('This is your Subject') . '?=');
            $message->getSwiftMessage();

        });

        return 'Message was send!!!';

    }
}

