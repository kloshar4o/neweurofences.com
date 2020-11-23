<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Front\CartController;
use App\Models\Lang;
use Validator;
use App\Http\Controllers\Controller;
use App\Zoho\ZohoClient;
use Illuminate\Http\Request;

class ZohoController extends Controller
{

    protected $fake_cart;
    protected $fake_user_data;

    public function __construct()
    {

        $this->fake_cart = [
            [
                "name" => "Blocator Parcare",
                "url" => "/Blocator-Parcare",
                "products" => [
                    [
                        "id" => "23",
                        "name" => "Blocator de parcare manual 380x450 mm",
                        "alias" => "Blocator-De-Parcare-Manual-380x450-Mm",
                        "price" => "110.0",
                        "money" => "110 Lei",
                        "img" => "fdc22b6a5a6be9650c6fa947ea735c4785032382.jpg",
                        "quantity" => null,
                        "url" => "/Blocator-Parcare/Blocator-De-Parcare-Manual-380x450-Mm",
                        "has_sizes" => true,
                        "sizes" => [
                            [
                                "id" => 150,
                                "sku" => "BLO-DE-380",
                                "width" => "450",
                                "height" => "380",
                                "gap" => null,
                                "thickness" => null,
                                "img" => "",
                                "quantity" => null,
                                "price" => "110.00",
                                "money" => "110 Lei",
                                "label" => "380mmx450mm",
                                "has_colors" => true,
                                "colors" => [
                                    [
                                        "id" => "234",
                                        "ral" => "2004",
                                        "hex" => "#f13100",
                                        "name" => "ROŞU",
                                        "quantity" => "1"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                "name" => "Porti  Jaluzele",
                "url" => "/Porti/Porti-Jaluzele/Porti-Batante-Jaluzele",
                "products" => [
                    [
                        "id" => "61",
                        "name" => "Set Poartă cu Portiță Jaluze /80",
                        "alias" => "Set-Poarta-Cu-Porti-A-Jaluze-80",
                        "price" => null,
                        "money" => "Not fixed",
                        "img" => "c94f34e4ece109d0ab7494cb13b3c2ca33406575.jpg",
                        "quantity" => null,
                        "url" => "/Porti/Porti-Jaluzele/Porti-Batante-Jaluzele/Set-Poarta-Cu-Porti-A-Jaluze-80",
                        "has_sizes" => true,
                        "sizes" => [
                            [
                                "id" => 119,
                                "sku" => "SET-POA-185",
                                "width" => null,
                                "height" => "1850",
                                "gap" => null,
                                "thickness" => null,
                                "img" => "2c7459723cdbcbcf7642432d13fd8ec652393881.jpg",
                                "quantity" => null,
                                "price" => "7485.00",
                                "money" => "7485 Lei",
                                "label" => "1850mm/100mm",
                                "has_colors" => true,
                                "colors" => [
                                    [
                                        "id" => "227",
                                        "ral" => "7016",
                                        "hex" => "#4b5054",
                                        "name" => "ANTRACIT",
                                        "quantity" => "3"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->fake_user_data = [
            "email" => "john@email.com",
            "name" => "John Doe",
            "data" => [
                "contact" => [
                    "company_name" => "Lavincom SRL",
                    "contact_type" => "customer",
                    "notes" => "John Doe is a no name"
                ],
                "person" => [
                    "phone" => "+777777777777777"
                ]
            ]
        ];
    }

    private static function config()
    {

        return [
            'accessToken' => config('services.zoho.token'),
            'organizationId' => config('services.zoho.company_id'),
        ];
    }

    /**
     * @param string $email contact id to update
     * @param string $name
     * @param array $data
     * @return array
     * @see https://www.zoho.com/inventory/api/v1/
     */

    static function createUpdateContact($email, $name, $data = [])
    {

        $inventory = new ZohoClient(self::config());

        /*Display Name is Required */
        $data['contact']['contact_name'] = $data['contact']['company_name'] ?? $name;

        /*Display Name is Required */
        $data['contact']['website'] = $data['contact']['website'] ?? config('app.name');

        /* Set person name*/
        $names = explode(' ', $name);
        $data['person']['first_name'] = $person_data['first_name'] ?? $names[0] ?? null;
        $data['person']['last_name'] = $person_data['last_name'] ?? $names[1] ?? null;

        /*
         * If shipping address, and not billing address,
         * copy shipping address to billing address and vice versa
         */
        if ($data['person']) {
            $shipping_address = $data['person']['shipping_address'] ?? null;
            $billing_address = $data['person']['billing_address'] ?? null;

            if ($shipping_address && !$billing_address)
                $data['person']['billing_address'] = $shipping_address;

            if (!$shipping_address && $billing_address)
                $data['person']['shipping_address'] = $billing_address;
        }


        /*Email is set to the person, no to the contact*/
        $data['person']['email'] = $email;

        /*Search contact by email*/
        $contact = $inventory->retrieveContact(null, compact('email'))->contacts[0] ?? null;

        if ($contact) {

            /*search person by email*/
            $person = $inventory->retrieveContactPersons($contact->contact_id, compact('email'))->contact_persons[0]; // Get all contacts
            $inventory->updateContact($contact->contact_id, $data['contact']);
            $inventory->updateContactPerson($person->contact_person_id, $data['person']);

        } else {

            /*Primary contact details*/
            $data['person']['is_primary_contact'] = true;

            /*
             * To create contact and person in the same request,
             * we insert the person details
            */
            $data['contact']['contact_persons'] = [$data['person']];
            $contact = $inventory->createContact($data['contact'])->contact;
        }

        return [
            'success' => true,
            'contact' => $contact->contact_id
        ];
    }

    static function createUpdatePurchaseOrder($email, $name, $data = [], $cart)
    {

        $total = 0;

        foreach ($cart as $category_key => $category) {

            foreach ($category['products'] as $product_key => $product) {


                if ($product['quantity']) {

                    //Product/s without sizes

                    $total += $product['price'] * $product['quantity'];

                } else {

                    foreach ($product['sizes'] as $size_key => $size) {

                        /*No colors*/
                        if ($size['quantity']) {

                            $total += $size['price'] * $size['quantity'];
                        } else {
                            foreach ($size['colors'] as $color_key => $color) {
                                $total += $size['price'] * $color['quantity'];
                            }
                        }
                    }
                }
            }
        }

        return [
            'success' => true,
            'order' => 1
        ];
    }

    /**
     * For ajax requests
     * waiting for raw JSON body
     * Content-Type: application/json
     * @param Request $request
     * @return object
     * @see https://www.zoho.com/inventory/api/v1/
     */

    function postCreateUpdateContact(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors(), 400);

        $contact = $this->createUpdateContact(
            $request->get('email'),
            $request->get('name'),
            $request->get('data') // contact[], person[]
        );

        return response()->json($contact);
    }


    /**
     * For ajax requests
     * waiting for raw JSON body
     * Content-Type: application/json
     * @param Request $request
     * @return object
     * @see https://www.zoho.com/inventory/api/v1/
     */

    function postCreatePurchaseOrder(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required',
        ]);


        if ($validator->fails())
            return response()->json($validator->errors(), 400);

        $cart = session()->get('cart');

        if (!$cart)
            return response()->json(['error' => myTrans('Empty cart')], 400);

        $lang_id = $request->get('lang_id') ?: Lang::where('active', 1)
            ->where('default_lang', 1)
            ->first()
            ->id;

        //$cart_items = CartController::miniCart($lang_id, $cart);

        $cart_items = $this->fake_cart;


        $order = $this->createUpdatePurchaseOrder(
            $request->get('email'),
            $request->get('name'),
            $request->get('data'), // contact[], person[]
            $cart_items
        );

        return response()->json($order);
    }

}
