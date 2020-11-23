<?php

namespace App\Providers;


use App\Models\GoodsSubjectId;
use App\Models\MenuId;
use App\Models\Lang;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\CartController;

class DefineElementsForFrontSite extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->app['view']->composer('*', function ($view) {


            $controller = new Controller();
            $lang_id = $controller->lang()['lang_id'];
            $lang = $controller->lang()['lang'];


            $front_top_menu = getMenuList($lang_id, 0, 1, 0, 1);

            $front_footer_menu = getMenuList($lang_id, 0, 1, 0);

            $lang_list = Lang::where('active', 1)->orderBy('position', 'asc')->get();


            $front_goods_subject_list2 = getTableById('goods_subject', 'p_id', 0, $lang_id);

            $front_goods_subject_list = GoodsSubjectId::where('p_id', 0)
                ->where('active', 1)
                ->join('goods_subject', 'goods_subject_id.id', '=', 'goods_subject.goods_subject_id')
                ->where('lang_id', $lang_id)
                ->limit(4)
                ->orderBy('position')
                ->get();

            $main_pdf = '';

            if (File::exists('upfiles/file_pdf/catalog_' . $lang . '.pdf')) {
                $main_pdf = 'upfiles/file_pdf/catalog_' . $lang . '.pdf';
            }

            $facebook = showSettingBodyByAlias('facebook', $lang_id);
            $chat = showSettingBodyByAlias('chat', $lang_id);
            $phone = showSettingBodyByAlias('phone', $lang_id);
            $company = showSettingBodyByAlias('company', $lang_id);

            $whatsapp1 = getSetting('whatsapp-1', $lang_id);
            $whatsapp2 = getSetting('whatsapp-2', $lang_id);



            $contact_parent = MenuId::query()->whereAlias('contacts')->first();
            $contacts = MenuId::where('p_id', $contact_parent->id)
                ->where('active', 1)
                ->where('deleted', 0)
                ->where('lang_id', $lang_id)
                ->join('menu', 'menu.menu_id', '=', 'menu_id.id')
                ->orderBy('position', 'asc')
                ->get()
                ->keyBy('name');

            $contacts_joined = join(', ', $contacts->keys()->toArray());



            // Breadcrumbs
            $segment_2 = request()->segment(2);
            $segment_3 = request()->segment(3);
            $segment_4 = request()->segment(4);

            $b_menu = null;
            $b_menu_2 = null;
            $b_menu_3 = null;


            if (!is_null($segment_2)) {
                $b_menu = getTableByAlias('goods_subject', $segment_2, $lang_id, 'first');
                if (empty($b_menu)) $b_menu = getTableByAlias('menu', $segment_2, $lang_id, 'first');
            }

            if (!is_null($segment_3)) {
                $b_menu_2 = getTableByAlias('goods_subject', $segment_3, $lang_id, 'first');
                if ($segment_2 == 'catalog') {
                    $b_menu_2 = getTableByAlias('goods_subject', $segment_3, $lang_id, 'first');
                }
                if ($segment_2 == 'gallery') {
                    $b_menu_2 = getTableByAlias('gallery_subject', $segment_3, $lang_id, 'first');
                }
                if (empty($b_menu_2)) $b_menu_2 = getTableByAlias('goods_item', $segment_4, $lang_id, 'first');
            }

            if (!is_null($segment_4)) {
                $b_menu_3 = getTableByAlias('goods_item', $segment_4, $lang_id, 'first');
                if ($segment_2 == 'catalog') {
                    $b_menu_3 = getTableByAlias('goods_item', $segment_4, $lang_id, 'first');
                }
            }


//            Meta titles
            $meta_title = env('APP_NAME');
            $meta_description = env('APP_NAME');
            $meta_page_img = asset('front-assets/img/share-logo.png');


            $meta_title = !empty(menuCurrPage($lang_id)) ? menuCurrPage($lang_id)['name'] : $meta_title;
            $meta_description = !empty(menuCurrPage($lang_id)) ? menuCurrPage($lang_id)['description'] : $meta_description;


            $meta_main_page = getTableByAlias('menu', 'main_page', $lang_id, 'first', 'position', 'asc', 0, 0);

            if (!empty($b_menu_3)) {
                $meta_title = !empty($b_menu_3->meta_title) ? $b_menu_3->meta_title : (!empty($b_menu_3->name) ? $b_menu_3->name : $meta_title);
                $meta_description = !empty($b_menu_3->meta_description) ? $b_menu_3->meta_description : $meta_description;
            } elseif (!empty($b_menu_2) && empty($b_menu_3)) {
                if ($segment_2 == 'gallery')
                    $meta_title = !empty($b_menu_2->name) ? $b_menu_2->name : $meta_title;
                else
                    $meta_title = $b_menu_2->meta_title ? $b_menu_2->meta_title : (!empty($b_menu_2->name) ? $b_menu_2->name : $meta_title);

                $meta_description = !empty($b_menu_2->meta_description) ? $b_menu_2->meta_description : $meta_description;
            } elseif (!empty($b_menu) && empty($b_menu_2)) {
                $meta_title = !empty($b_menu->meta_title) ? $b_menu->meta_title : (!empty($b_menu->name) ? $b_menu->name : $meta_title);
                $meta_description = !empty($b_menu->meta_description) ? $b_menu->meta_description : $meta_description;
            } elseif (empty(request()->segment(2)) && !empty($meta_main_page)) {
                $meta_title = !empty($meta_main_page->meta_title) ? $meta_main_page->meta_title : $meta_title;
                $meta_description = !empty($meta_main_page->meta_description) ? $meta_main_page->meta_description : $meta_description;
            }


            if (!empty($meta_description) && strlen($meta_description) > 300) {
                $firsts_characters = strpos($meta_description, ' ', 300);
                $meta_description = strip_tags(substr($meta_description, 0, $firsts_characters));

                if (($description = strstr($meta_description, '.', true)) !== false) {
                    $meta_description = $description;
                }
            }

            ////items on view////

            // Breadcrumbs
            $view->b_menu = $b_menu;
            $view->b_menu_2 = $b_menu_2;
            $view->b_menu_3 = $b_menu_3;

            //Header
            $view->front_top_menu = $front_top_menu;
            $view->lang_list = $lang_list;
            $view->main_pdf = $main_pdf;
            $view->facebook = $facebook;
            $view->chat = $chat;
            $view->phone = $phone;
            $view->company = $company;
            $view->whatsapp1 = $whatsapp1;
            $view->whatsapp2 = $whatsapp2;

            //Footer
            $view->front_footer_menu = $front_footer_menu;
            $view->contacts = $contacts;
            $view->contacts_joined = $contacts_joined;

            //Main
            $view->front_goods_subject_list2 = $front_goods_subject_list2;
            $view->front_goods_subject_list = $front_goods_subject_list;

            //Meta
            $view->meta_title = $meta_title;
            $view->meta_description = $meta_description;
            $view->meta_page_img = $meta_page_img;
            $view->meta_main_page = $meta_main_page;

            //cart
            $view->cartPage = isset($segment_2) ? $segment_2 === 'cart' : false;

            //class to the html tag
            $view->blade = str_replace('.', '_', $view->view);

            if(session()->has('cart')){

                $view->miniCart = CartController::miniCart($lang_id, session()->get('cart'));

            }



        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
