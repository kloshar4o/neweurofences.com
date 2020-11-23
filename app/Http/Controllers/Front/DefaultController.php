<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\API\ZohoController;
use App\Http\Controllers\Controller;
use App\Models\BannerTop;
use App\Models\BannerTopId;
use App\Models\Basket;
use App\Models\BasketId;
use App\Models\Brand;
use App\Models\Doc;
use App\Models\FeedForm;
use App\Models\GalleryItem;
use App\Models\GalleryItemId;
use App\Models\GallerySubject;
use App\Models\GallerySubjectId;
use App\Models\GoodsImages;
use App\Models\GoodsPhoto;
use App\Models\GoodsItem;
use App\Models\GoodsItemId;
use App\Models\GoodsItemIdSet;
use App\Models\GoodsColorsId;
use App\Models\GoodsColors;
use App\Models\GoodsItemColors;
use App\Models\GoodsSize;
use App\Models\GoodsSubject;
use App\Models\GoodsSubjectId;
use App\Models\Menu;
use App\Models\MenuId;
use App\Models\ModulesId;
use App\Models\Orders;
use App\Models\OrdersData;
use App\Models\OrdersUsers;
use App\Models\Services;
use App\Models\ServicesId;
use App\Models\ServicesTechnologies;
use App\Models\ServicesWorks;
use App\Models\Settings;
use App\Models\SettingsId;
use App\Models\Technologies;
use App\Models\TechnologiesId;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request as HttpRequest;


class DefaultController extends Controller
{
    private $lang_id;
    private $lang;
    public $cart;

    public function __construct()
    {
        $this->lang_id = $this->lang()['lang_id'];
        $this->lang = $this->lang()['lang'];
    }

    public function index()
    {
        $view = 'front.index';

        $lang_id = $this->lang_id;

        $main_gallery = getTableByAlias('gallery_subject', 'works', $lang_id, 'first');

        if (!empty($main_gallery))
            $gallery_subject_list = getTableById('gallery_subject', 'p_id', $main_gallery->gallery_subject_id, $lang_id);

        if (!empty($gallery_subject_list)) {
            foreach ($gallery_subject_list as $one_subject) {
                $photo[$one_subject->gallery_subject_id] = getGallerySubjPhoto($one_subject->gallery_subject_id);
            }
        }
        $google_map = showSettingBodyByAlias('google-map', $lang_id);

        return view($view, get_defined_vars());
    }

    public function menuElements($lang, $parent, $children = null, $item = null, $item2 = null)
    {

        $lang = $this->lang;
        $lang_id = $this->lang_id;

        $this->cart = '';

        $parent_menu = getTableByAlias('menu', $parent, $lang_id, 'first');

        $parent_subject = getTableByAlias('goods_subject', $parent, $lang_id, 'first');

        if (is_null($parent_menu) && is_null($parent_subject) && $parent != 'cart')
            return redirect($lang);

        if (!is_null($item2)) {

            /*Forth level page*/

            return $this->ItemPage($lang_id, $parent_subject, $children, $item, $item2);
        } elseif (!is_null($item)) {

            /*Third level page*/

            $children_subject = getTableByAlias('goods_subject', $item, $lang_id, 'first');
            if (!empty($children_subject) && CheckIfSubjectHasItems('goods', $children_subject->id)->isNotEmpty())
                return $this->ItemsList($lang_id, $parent_subject, $children, $item);
            else
                return $this->ItemPage($lang_id, $parent_subject, $children, $item);
        } elseif (!is_null($children)) {

            /*Second level page*/

            switch ($parent) {
                case 'catalog':
                    return $this->CatalogList($lang_id, $parent_menu);
                case 'gallery':
                    return $this->GalleryPage($lang_id, $parent_menu, $children);
                default:
                    $children_subject = getTableByAlias('goods_subject', $children, $lang_id, 'first');
                    if (empty($children_subject))
                        return $this->ItemPage($lang_id, $parent_subject, $parent, $children);
                    elseif (CheckIfSubjectHasItems('goods', $children_subject->id)->isNotEmpty())
                        return $this->ItemsList($lang_id, $parent_subject, $children);
                    else
                        return $this->CatalogList($lang_id, $children_subject, $children, $parent);
            }
        } else {

            /*First level page*/

            switch ($parent) {
                case 'cart':
                    return $this->Cart($lang_id);
                case 'contacts':
                    return $this->ContactsList($lang_id, $parent_menu);
                case 'about':
                    return $this->textPage($lang_id, $parent_menu);
                case 'gallery':
                    return $this->GalleryList($lang_id, $parent_menu);
                case 'catalog':
                    return $this->CatalogList($lang_id, $parent_menu);
                case 'instructions':
                    return $this->Instruction($lang_id, $parent_menu);
                default:
                    if (empty($children)) {
                        $children_subject = getTableByAlias('goods_subject', $parent, $lang_id, 'first');

                        if (!empty($children_subject) && CheckIfSubjectHasItems('goods', $children_subject->id)->isEmpty())
                            return $this->CatalogList($lang_id, $parent_subject);
                        else
                            return $this->ItemsList($lang_id, $children_subject, $parent);
                    }
                    return $this->CatalogList($lang_id, $parent_subject, $children);

            }
        }
    }

    public function CatalogList($lang_id, $parent, $children = null, $parent_alias = null)
    {

        $view = 'front.pages.catalog-list';

        $b_menu1 = isset($parent_alias) ? $parent_alias : $parent->alias;
        $b_menu2 = isset($children) ? $children : null;

        if ($b_menu2) {
            $level = 2;
            $url_new = "$b_menu1/$b_menu2";
            $url_parent = $b_menu2;
        } else {
            $level = 1;
            $url_new = $b_menu1;
            $url_parent = $b_menu1;
        }


        $child_goods_list = GoodsSubjectId::query()
            ->where('p_id', $parent->id)
            ->where('active', 1)
            ->where('deleted', 0)
            ->where('lang_id', $lang_id)
            ->join('goods_subject', 'goods_subject.goods_subject_id', '=', 'goods_subject_id.id')
            ->select('*', 'goods_subject_id.id AS id')
            ->orderBy('position', 'asc')
            ->get();

        $isGates = ($parent->alias == 'Porti');


        if ($isGates) {

            foreach ($child_goods_list as $key => $subCat) {

                $subCat['children'] = GoodsSubjectId::where('p_id', $subCat->id)
                    ->join('goods_subject', 'goods_subject.goods_subject_id', '=', 'goods_subject_id.id')
                    ->where('active', 1)
                    ->where('deleted', 0)
                    ->orderBy('position', 'asc')
                    ->get();


                $dontHasChilds = $subCat['children']->isEmpty();

                if ($dontHasChilds) {
                    $subCat->noChilds = true;

                    $subCat['children'] = GoodsSubjectId::where('good_group', $subCat->good_group)
                        ->where('goods_subject_id.id', '<>', $subCat->goods_subject_id)
                        ->join('goods_subject', 'goods_subject_id.id', '=', 'goods_subject.goods_subject_id')
                        ->where('active', 1)
                        ->where('deleted', 0)
                        ->get();

                    foreach ($subCat['children'] as $letsSortChildren) {
                        $next = false;

                        $idToSearch = $letsSortChildren->id;
                        foreach ($child_goods_list as $targetWithPosition) {
                            $targetChildren = $targetWithPosition['children'];

                            if (is_array($targetChildren) || is_object($targetChildren))
                                foreach ($targetChildren as $sameTargetItem) {

                                if(!$sameTargetItem->getOneImg)

                                    if ($sameTargetItem->id == $idToSearch && !$next) {
                                        $letsSortChildren->position = $targetWithPosition->position;
                                        $next = true;
                                    }
                                }
                        }
                    }

                }
            }
        }

        if ($level == 2) {

            $main_catalog_goods = $parent;

            $relatedQuery = GoodsSubjectId::where('good_group', $parent->good_group)
                ->where('goods_subject_id.id', '<>', $parent->goods_subject_id)
                ->where('active', 1)
                ->where('deleted', 0)
                ->where('p_id', '<>', 0)
                ->where('lang_id', $lang_id)
                ->join('goods_subject', 'goods_subject.goods_subject_id', '=', 'goods_subject_id.id')
                ->select('*', 'goods_subject_id.id AS id')
                ->orderBy('position', 'asc')
                ->get();


            if (!empty($relatedQuery)) {

                foreach ($relatedQuery as $relatedPage) {

                    $parentsUrl = '';


                    $relatedPage['parent'] = GoodsSubjectId::where('goods_subject_id', $relatedPage->p_id)
                        ->join('goods_subject', 'goods_subject.goods_subject_id', '=', 'goods_subject_id.id')
                        ->first();


                    if (!$relatedPage['parent'])
                        continue;

                    $relatedPage->parentsUrl = $relatedPage['parent']->alias;

                    if ($relatedPage['parent']->p_id) {
                        $relatedPage->parentsUrl = GoodsSubjectId::where('goods_subject_id', $relatedPage['parent']->p_id)
                                ->join('goods_subject', 'goods_subject.goods_subject_id', '=', 'goods_subject_id.id')
                                ->first()
                                ->alias . '/' . $relatedPage->parentsUrl;
                    }


                    $relatedPage['products'] = getPaginateTableById('goods_item', 'goods_subject_id', $relatedPage->goods_subject_id, $lang_id, 20);

                    if ($relatedPage['products']->isNotEmpty()) {
                        $dontSkip = true;
                    }

                    $relatedPage['subPages'] = GoodsSubjectId::where('goods_subject_id', $main_catalog_goods->id)
                        ->where('lang_id', $lang_id)
                        ->where('active', 1)
                        ->where('deleted', 0)
                        ->join('goods_subject', 'goods_subject.goods_subject_id', '=', 'goods_subject_id.p_id')
                        ->select('*', 'goods_subject_id.id AS id')
                        ->get();


                    foreach ($relatedPage['subPages'] as $subPage) {


                        $relatedPage[$subPage['alias']] = getTableByAlias('goods_subject', $subPage['alias'], $lang_id, 'first');
                        $relatedPage[$subPage['alias']]->products = getPaginateTableById('goods_item', 'goods_subject_id', $relatedPage[$subPage['alias']]->goods_subject_id, $lang_id, 20);


                        foreach ($relatedPage[$subPage['alias']]->products as $product) {
                            $related_catalog_image[$product->goods_item_id] = GoodsPhoto::where('goods_item_id', $product->goods_item_id)
                                ->where('active', 1)
                                ->orderBy('position', 'asc')
                                ->first();

                            $related_catalog_color[$product->goods_item_id] = GoodsColorsId::whereRaw('goods_colors_id.id IN(SELECT goods_colors_id FROM goods_item_colors WHERE goods_item_id = ' . $product->goods_item_id . ')')
                                ->join('goods_colors', 'goods_colors.goods_colors_id', '=', 'goods_colors_id.id')
                                ->where('lang_id', $lang_id)
                                ->orderBy('position')
                                ->get();
                        }


                    }

                    foreach ($relatedPage['products'] as $product) {
                        $related_catalog_image[$product->goods_item_id] = GoodsPhoto::where('goods_item_id', $product->goods_item_id)
                            ->where('active', 1)
                            ->orderBy('position', 'asc')
                            ->first();

                        $related_catalog_color[$product->goods_item_id] = GoodsColorsId::whereRaw('goods_colors_id.id IN(SELECT goods_colors_id FROM goods_item_colors WHERE goods_item_id = ' . $product->goods_item_id . ')')
                            ->join('goods_colors', 'goods_colors.goods_colors_id', '=', 'goods_colors_id.id')
                            ->where('lang_id', $lang_id)
                            ->orderBy('position')
                            ->get();
                    }

                }

            }

            if (!empty($item))
                $main_catalog_goods = getTableByAlias('goods_subject', $item, $lang_id, 'first');

            $catalog_item_list = getPaginateTableById('goods_item', 'goods_subject_id', $main_catalog_goods->goods_subject_id, $lang_id, 20);

            $catalog_image = [];

            if (!empty($catalog_item_list)) {
                foreach ($catalog_item_list as $one_catalog_item) {
                    $catalog_image[$one_catalog_item->goods_item_id] = GoodsPhoto::where('goods_item_id', $one_catalog_item->goods_item_id)
                        ->where('active', 1)
                        ->where('show_img', 1)
                        ->orderBy('position', 'asc')
                        ->first();

                    if (empty($catalog_image[$one_catalog_item->goods_item_id]))
                        $catalog_image[$one_catalog_item->goods_item_id] = GoodsPhoto::where('goods_item_id', $one_catalog_item->goods_item_id)
                            ->where('active', 1)
                            ->orderBy('position', 'asc')
                            ->first();

                    $colors_list[$one_catalog_item->goods_item_id] = GoodsColorsId::whereRaw('goods_colors_id.id IN(SELECT goods_colors_id FROM goods_item_colors WHERE goods_item_id = ' . $one_catalog_item->goods_item_id . ')')
                        ->join('goods_colors', 'goods_colors.goods_colors_id', '=', 'goods_colors_id.id')
                        ->where('lang_id', $lang_id)
                        ->orderBy('position')
                        ->get();
                }
            }

        }

        $parent_gallery_subjects = GallerySubject::where('used', 'like', "group_$parent->good_group")
            ->join('gallery_subject_id', 'gallery_subject.gallery_subject_id', '=', 'gallery_subject_id.id')
            ->where('active', 1)
            ->where('deleted', 0)
            ->get();


        if ($parent_gallery_subjects->isNotEmpty()) {

            foreach ($parent_gallery_subjects as $gallery_subject) {
                $galleries[] = GalleryItemId::where('active', 1)
                    ->where('deleted', 0)
                    ->where('gallery_subject_id', $gallery_subject->gallery_subject_id)
                    ->join('gallery_item', 'gallery_item.gallery_item_id', '=', 'gallery_item_id.id')
                    ->where('lang_id', $lang_id)
                    ->orderBy('position', 'asc')
                    ->get();

            }
        } else {
            $main_gallery = getTableByAlias('gallery_subject', 'works', $lang_id, 'first');

            if (!empty($main_gallery))
                $gallery_subject_list = getTableById('gallery_subject', 'p_id', $main_gallery->gallery_subject_id, $lang_id);

            if (!empty($gallery_subject_list)) {
                foreach ($gallery_subject_list as $one_subject) {
                    $photo[$one_subject->gallery_subject_id] = getGallerySubjPhoto($one_subject->gallery_subject_id);
                }
            }

        }

        return view($view, get_defined_vars());
    }

    public function ItemsList($lang_id, $parent, $children, $item = null)
    {

        $view = 'front.pages.catalog';


        $main_catalog_goods = [];

        $isGates = ($parent->alias == 'Porti');

        $child_goods_list = GoodsSubjectId::where('p_id', $parent->id)
            ->where('active', 1)
            ->where('deleted', 0)
            ->where('lang_id', $lang_id)
            ->join('goods_subject', 'goods_subject.goods_subject_id', '=', 'goods_subject_id.id')
            ->select('*', 'goods_subject_id.id AS id')
            ->orderBy('position', 'asc')
            ->get();

        if (!empty($children)) {

            $b_menu1 = $parent->alias;
            if ($parent->alias != $children) $b_menu2 = $children;
            if ($item != null) $b_menu3 = $item;

            $main_catalog_goods = getTableByAlias('goods_subject', $children, $lang_id, 'first');

            if (is_null($main_catalog_goods))
                return redirect(url($this->lang, $parent->alias));

            $interests_alias = getTableByAlias('goods_subject', $children, $lang_id, 'first');

            if ($main_catalog_goods->good_group !== "0") {

                $relatedQuery = GoodsSubjectId::where('good_group', $main_catalog_goods->good_group)
                    ->where('goods_subject_id.id', '<>', $main_catalog_goods->goods_subject_id)
                    ->where('active', 1)
                    ->where('deleted', 0)
                    ->where('lang_id', $lang_id)
                    ->join('goods_subject', 'goods_subject.goods_subject_id', '=', 'goods_subject_id.id')
                    ->select('*', 'goods_subject_id.id AS id')
                    ->orderBy('position', 'asc')
                    ->get();
            }

            $related_catalog_image = [];

            if (!empty($relatedQuery)) {
                foreach ($relatedQuery as $relatedPage) {

                    $parentsUrl = '';

                    $relatedPage['parent'] = GoodsSubjectId::where('goods_subject_id', $relatedPage->p_id)
                        ->join('goods_subject', 'goods_subject.goods_subject_id', '=', 'goods_subject_id.id')
                        ->first();

                    $relatedPage->parentsUrl = $relatedPage['parent']->alias;

                    if ($relatedPage['parent']->p_id) {
                        $relatedPage->parentsUrl = GoodsSubjectId::where('goods_subject_id', $relatedPage['parent']->p_id)
                                ->join('goods_subject', 'goods_subject.goods_subject_id', '=', 'goods_subject_id.id')
                                ->first()
                                ->alias . '/' . $relatedPage->parentsUrl;
                    }


                    $relatedPage['products'] = getPaginateTableById('goods_item', 'goods_subject_id', $relatedPage->goods_subject_id, $lang_id, 20);

                    if ($relatedPage['products']->isEmpty()) {

                        $relatedPage['subPages'] = GoodsSubjectId::where('goods_subject_id', $relatedPage->id)
                            ->where('lang_id', $lang_id)
                            ->where('active', 1)
                            ->where('deleted', 0)
                            ->join('goods_subject', 'goods_subject.goods_subject_id', '=', 'goods_subject_id.p_id')
                            ->select('*', 'goods_subject_id.id AS id')
                            ->get();


                        foreach ($relatedPage['subPages'] as $subPage) {


                            $relatedPage[$subPage['alias']] = getTableByAlias('goods_subject', $subPage['alias'], $lang_id, 'first');
                            $relatedPage[$subPage['alias']]->products = getPaginateTableById('goods_item', 'goods_subject_id', $relatedPage[$subPage['alias']]->goods_subject_id, $lang_id, 20);


                            foreach ($relatedPage[$subPage['alias']]->products as $product) {
                                $related_catalog_image[$product->goods_item_id] = GoodsPhoto::where('goods_item_id', $product->goods_item_id)
                                    ->where('active', 1)
                                    ->orderBy('position', 'asc')
                                    ->first();

                                $related_catalog_color[$product->goods_item_id] = GoodsColorsId::whereRaw('goods_colors_id.id IN(SELECT goods_colors_id FROM goods_item_colors WHERE goods_item_id = ' . $product->goods_item_id . ')')
                                    ->join('goods_colors', 'goods_colors.goods_colors_id', '=', 'goods_colors_id.id')
                                    ->where('lang_id', $lang_id)
                                    ->orderBy('position')
                                    ->get();
                            }


                        }


                    } else {

                        $dontSkip = true;

                        foreach ($relatedPage['products'] as $product) {
                            $related_catalog_image[$product->goods_item_id] = GoodsPhoto::where('goods_item_id', $product->goods_item_id)
                                ->where('active', 1)
                                ->orderBy('position', 'asc')
                                ->first();

                            $related_catalog_color[$product->goods_item_id] = GoodsColorsId::whereRaw('goods_colors_id.id IN(SELECT goods_colors_id FROM goods_item_colors WHERE goods_item_id = ' . $product->goods_item_id . ')')
                                ->join('goods_colors', 'goods_colors.goods_colors_id', '=', 'goods_colors_id.id')
                                ->where('lang_id', $lang_id)
                                ->orderBy('position')
                                ->get();
                        }
                    }

                }

            }
            if (!empty($item))
                $main_catalog_goods = getTableByAlias('goods_subject', $item, $lang_id, 'first');

            if (is_null($main_catalog_goods))
                return redirect(url($this->lang, $parent->alias));

            $catalog_item_list = getPaginateTableById('goods_item', 'goods_subject_id', $main_catalog_goods->goods_subject_id, $lang_id, 20);

            $catalog_image = [];

            if (!empty($catalog_item_list)) {
                foreach ($catalog_item_list as $one_catalog_item) {
                    $catalog_image[$one_catalog_item->goods_item_id] = GoodsPhoto::where('goods_item_id', $one_catalog_item->goods_item_id)
                        ->where('active', 1)
                        ->where('show_img', 1)
                        ->orderBy('position', 'asc')
                        ->first();

                    if (empty($catalog_image[$one_catalog_item->goods_item_id]))
                        $catalog_image[$one_catalog_item->goods_item_id] = GoodsPhoto::where('goods_item_id', $one_catalog_item->goods_item_id)
                            ->where('active', 1)
                            ->orderBy('position', 'asc')
                            ->first();

                    $colors_list[$one_catalog_item->goods_item_id] = GoodsColorsId::whereRaw('goods_colors_id.id IN(SELECT goods_colors_id FROM goods_item_colors WHERE goods_item_id = ' . $one_catalog_item->goods_item_id . ')')
                        ->join('goods_colors', 'goods_colors.goods_colors_id', '=', 'goods_colors_id.id')
                        ->where('lang_id', $lang_id)
                        ->orderBy('position')
                        ->get();
                }
            }
        };


        $parent_gallery_subjects = GallerySubject::where('used', 'like', "group_$main_catalog_goods->good_group")
            ->join('gallery_subject_id', 'gallery_subject.gallery_subject_id', '=', 'gallery_subject_id.id')
            ->where('active', 1)
            ->where('deleted', 0)
            ->get();


        if ($parent_gallery_subjects->isNotEmpty()) {
            foreach ($parent_gallery_subjects as $gallery_subject) {
                $galleries[] = GalleryItemId::where('active', 1)
                    ->where('deleted', 0)
                    ->where('gallery_subject_id', $gallery_subject->gallery_subject_id)
                    ->join('gallery_item', 'gallery_item.gallery_item_id', '=', 'gallery_item_id.id')
                    ->where('lang_id', $lang_id)
                    ->orderBy('position', 'asc')
                    ->get();

            }

        } else {
            $main_gallery = getTableByAlias('gallery_subject', 'works', $lang_id, 'first');

            if (!empty($main_gallery))
                $gallery_subject_list = getTableById('gallery_subject', 'p_id', $main_gallery->gallery_subject_id, $lang_id);

            if (!empty($gallery_subject_list)) {
                foreach ($gallery_subject_list as $one_subject) {
                    $photo[$one_subject->gallery_subject_id] = getGallerySubjPhoto($one_subject->gallery_subject_id);
                }
            }

        }


        return view($view, get_defined_vars());
    }

    public function ItemPage($lang_id, $parent, $children, $item, $item2 = null)
    {

        $view = 'front.pages.item-page-new';

        $b_menu1 = $parent->alias; //root id

        if ($item2 != null) {
            $b_menu2 = $children;
            $b_menu3 = $item;
            $b_menu4 = $item2;
        } elseif ($item != null) {
            if ($parent->alias == $children) $b_menu2 = $item;
            else $b_menu2 = $children;
            $b_menu3 = $item;
        }

        /*Products Category*/
        $goods_subject = getTableByAlias('goods_subject', $children, $lang_id, 'first');

        if (is_null($goods_subject))
            return redirect($this->lang . '/' . $b_menu1);


        /*Product object*/
        if (!empty($item2))
            $goods_item = getTableByAlias('goods_item', $item2, $lang_id, 'first');
        else
            $goods_item = getTableByAlias('goods_item', $item, $lang_id, 'first');

        if (is_null($goods_item))
            return redirect($this->lang . '/' . $parent->alias . '/' . $goods_subject->alias);


        $goods_item_photo = GoodsPhoto::where('goods_item_id', $goods_item->goods_item_id)
            ->where('active', 1)
            ->where('show_img', '!=', 1)
            ->orderBy('position', 'asc')
            ->get();

        $goods_item_size = GoodsSize::where('goods_item_id', $goods_item->goods_item_id)
            ->orderBy('position', 'asc')
            ->get();

        $item_size_list = GoodsSize::where('goods_item_id', $goods_item->goods_item_id)
            ->where('active', 1)
            ->get();

        foreach ($item_size_list as $one_size) {
            $title = '';
            $label = '';

            $dimensions = ['height', 'width', 'gap', 'model', 'thickness'];

            if ($one_size->height)
                $label .= convert_to_inches($one_size->height);
            if ($one_size->width)
                $label .= 'x' . convert_to_inches($one_size->width);
            if ($one_size->gap)
                $label .= '/' . convert_to_inches($one_size->gap);
            if ($one_size->model)
                $label .= '/' . convert_to_inches($one_size->model);
            if ($one_size->thickness)
                $label .= '(' . convert_to_inches($one_size->thickness) . ')';

            foreach ($dimensions as $dimension) {
                if ($one_size->{$dimension})
                    $title .= myTrans($dimension) . '-' . convert_to_inches($one_size->{$dimension}) . ' ';
            }


            $one_size->title = $title;
            $one_size->label = $label;
            $one_size->money = money($one_size->price);
        }


        $colors_list = GoodsColorsId::whereRaw('goods_colors_id.id IN(SELECT goods_colors_id FROM goods_item_colors WHERE goods_item_id = ' . $goods_item->goods_item_id . ')')
            ->join('goods_colors', 'goods_colors.goods_colors_id', '=', 'goods_colors_id.id')
            ->where('lang_id', $lang_id)
            ->get();



        if (!empty($goods_item->recomend)) {
            $recomend_array = explode(',', $goods_item->recomend);
            $goods_recomend = GoodsItemId::whereIn('goods_item_id.id', $recomend_array)
                ->where('active', 1)
                ->where('deleted', 0)
                ->where('goods_item_id', '!=', $goods_item->goods_item_id)
                ->join('goods_item', 'goods_item.goods_item_id', '=', 'goods_item_id.id')
                ->where('lang_id', $lang_id)
                ->inRandomOrder()
                ->limit(2)
                ->get();
        } else {
            $goods_recomend = GoodsItemId::where('active', 1)
                ->where('deleted', 0)
                ->where('goods_item_id', '!=', $goods_item->goods_item_id)
                ->join('goods_item', 'goods_item.goods_item_id', '=', 'goods_item_id.id')
                ->where('lang_id', $lang_id)
                ->inRandomOrder()
                ->limit(2)
                ->get();
        }


        if (!empty($goods_recomend)) {
            foreach ($goods_recomend as $one_recomend) {
                $photo_recomend[$one_recomend->goods_item_id] = GoodsPhoto::where('goods_item_id', $one_recomend->goods_item_id)
                    ->where('active', 1)
                    ->orderBy('position', 'asc')
                    ->first();

                $recomend_colors_list[$one_recomend->goods_item_id] = GoodsColorsId::whereRaw('goods_colors_id.id IN(SELECT goods_colors_id FROM goods_item_colors WHERE goods_item_id = ' . $one_recomend->goods_item_id . ')')
                    ->join('goods_colors', 'goods_colors.goods_colors_id', '=', 'goods_colors_id.id')
                    ->where('lang_id', $lang_id)
                    ->get();
            }
        }

        return view($view, get_defined_vars());
    }

    public function GalleryList($lang_id, $parent_menu)
    {

        $view = 'front.pages.gallery-list';

        $parent_gallery_subject = getTableByAlias('gallery_subject', 'works', $lang_id, 'first');

        $gallery_subject_list = getPaginateTableById('gallery_subject', 'p_id', $parent_gallery_subject->gallery_subject_id, $lang_id, 20);

        if (!empty($gallery_subject_list)) {
            foreach ($gallery_subject_list as $one_subject) {
                $photo[$one_subject->gallery_subject_id] = getGallerySubjPhoto($one_subject->gallery_subject_id);
            }
        }


        return view($view, get_defined_vars());
    }

    public function GalleryPage($lang_id, $parent_menu, $children)
    {

        $view = 'front.pages.gallery-page';

        $parent_gallery_subject = getTableByAlias('gallery_subject', $children, $lang_id, 'first');

        if (empty($parent_gallery_subject))
            return redirect(url($this->lang));

        $gallery_photos = GalleryItemId::where('active', 1)
            ->where('deleted', 0)
            ->where('gallery_subject_id', $parent_gallery_subject->gallery_subject_id)
            ->join('gallery_item', 'gallery_item.gallery_item_id', '=', 'gallery_item_id.id')
            ->where('lang_id', $lang_id)
            ->orderBy('position', 'asc')
            ->get();

        $used = explode(',', $parent_gallery_subject->used);

        if (!empty($used)) {
            foreach ($used as $one_used) {
                $used_goods[] = getTableByAlias('goods_subject', $one_used, $lang_id, 'first');
            }
        }

        return view($view, get_defined_vars());
    }

    public function ContactsList($lang_id, $parent_menu)
    {

        $view = 'front.pages.contacts';

        $cont = MenuId::where('p_id', $parent_menu->menu_id)
            ->where('active', 1)
            ->where('deleted', 0)
            ->join('menu', 'menu.menu_id', '=', 'menu_id.id')
            ->where('lang_id', $lang_id)
            ->orderBy('position', 'asc')
            ->get();

        return view($view, get_defined_vars());
    }

    public function textPage($lang_id, $parent_menu)
    {
        $view = 'front.pages.text-page';

        return view($view, get_defined_vars());
    }

    public function Cart($lang_id)
    {

        $view = 'front.pages.cart';

        $cookie_basket = Cookie::get('basket');

        $basket_items = Basket::where('basket_id', $cookie_basket)->get();

        $goods = [];
        if (!$basket_items->isEmpty()) {
            foreach ($basket_items as $one_basket_item) {
                $goods[$one_basket_item->id] = GoodsItemId::where('goods_item_id.id', $one_basket_item->goods_item_id)
                    ->where('active', 1)
                    ->where('deleted', 0)
                    ->join('goods_item', 'goods_item.goods_item_id', '=', 'goods_item_id.id')
                    ->where('lang_id', $lang_id)
                    ->first();

                if (!empty($goods[$one_basket_item->id])) {
                    $goods_subject[$one_basket_item->id] = GoodsSubjectId::where('id', $goods[$one_basket_item->id]->goods_subject_id)->first();

                    $goods_image[$goods[$one_basket_item->id]->goods_item_id] = GoodsPhoto::where('goods_item_id', $goods[$one_basket_item->id]->goods_item_id)
                        ->where('active', 1)
                        ->orderBy('position', 'asc')
                        ->first();
                    $set_items[$one_basket_item->id] = GoodsItemIdSet::where('goods_item_id', $goods[$one_basket_item->id]->goods_item_id)->get();

                    if (!empty($set_items[$one_basket_item->id])) {
                        foreach ($set_items[$one_basket_item->id] as $one_set_item) {
                            $set_goods[$one_set_item->id] = getTableById('goods_item', 'goods_item_id.id', $one_set_item->set_goods_item_id, $lang_id, 'first');

                            if (!empty($set_goods[$one_set_item->id]))
                                $set_subject[$one_set_item->id] = GoodsSubjectId::where('id', $set_goods[$one_set_item->id]->goods_subject_id)->first();
                        }
                    }
                }
            }
        }

        return view($view, get_defined_vars());
    }

    public function Instruction($lang_id, $parent_menu)
    {
        $view = 'front.instructions.index';

        $module_alias = 'menu';
        $module_id = ModulesId::whereAlias($module_alias)->first()->id;

        $children = MenuId::where('p_id', $parent_menu->menu_id)
            ->where('active', 1)
            ->where('deleted', 0)
            ->join('menu', 'menu.menu_id', '=', 'menu_id.id')
            ->where('lang_id', $lang_id)
            ->orderBy('position', 'asc')
            ->with('oneImage')
            ->get();

        $menu_docs = Doc::whereModuleId($module_id);

        $children->map( function($child) use ($menu_docs, $module_alias) {
            $child->docs = $menu_docs->where('element_id', $child->id)->get();
            $child->docs->map(function ($doc) use ($module_alias) {
                $doc->src = "/upfiles/$module_alias/$doc->element_id/$doc->file_name";
            });
        });

        return view($view, get_defined_vars());

    }

    public function ajaxCart($asd1, HttpRequest $requestt)
    {

        pp($asd1);
        pp($requestt->all());
        return //response()->json($request);

            $goods_id = Input::get('goods_id');
        $goods_color = Input::get('goods_color');
        $number = Input::get('number');
        $cookie_basket = Cookie::get('basket');

        if ($number <= 0)
            $number = 1;

        $goods_item_id = GoodsItemId::where('id', $goods_id)
            ->where('active', 1)
            ->where('deleted', 0)
            ->first();

        if (is_null($goods_item_id))
            return response()->json([
                'status' => false,
            ]);

        $has_color = GoodsItemColors::where('goods_item_id', $goods_item_id->id)->first();

        if (!empty($has_color) && empty($goods_color))
            return response()->json([
                'status' => false,
                'text' => ShowLabelById(75, $this->lang_id),
                'message' => 'empty_colors'
            ]);

        $goods_color_id = null;
        if (!empty($goods_color)) {
            $goods_color_id = GoodsColorsId::where('id', $goods_color)
                ->whereHas('GoodsColors', function ($q) {
                })
                ->first();

            if (is_null($goods_color_id))
                return response()->json([
                    'message' => trans('variables.order_color'),
                    'text' => ShowLabelById(76, $this->lang_id),
                    'item' => 'color',
                    'status' => false
                ]);
        }

        $goods_item_lang = GoodsItem::where('goods_item_id', $goods_item_id->id)
            ->where('lang_id', $this->lang_id)
            ->first();

        if (is_null($goods_item_lang))
            $goods_item_lang = GoodsItem::where('goods_item_id', $goods_item_id->id)->first();

        $basket = null;

        if (!is_null($cookie_basket)) {
            $basket = Basket::where('goods_item_id', $goods_item_id->id)
                ->where('goods_colors_id', !empty($goods_color_id) ? $goods_color_id->id : '')
                ->where('basket_id', $cookie_basket)
                ->first();
        }

        if (!is_null($basket)) {

            if ($basket->items_count > 0) {
                Basket::where('goods_item_id', $goods_item_id->id)
                    ->where('basket_id', $cookie_basket)
                    ->where('goods_colors_id', !empty($goods_color_id) ? $goods_color_id->id : '')
                    ->update(['items_count' => ($basket->items_count + $number)]);

                if (!is_null(Cookie::get('basket'))) {
                    Cookie::queue(Cookie::forget('basket'));
                }

                Cookie::queue('basket', $basket->basket_id, 45000);

                if (!empty($has_color))
                    $count_all_goods = Basket::where('basket_id', $cookie_basket)
                        ->where('goods_colors_id', $goods_color_id->id)
                        ->sum('items_count');
                else
                    $count_all_goods = Basket::where('basket_id', $cookie_basket)
                        ->sum('items_count');

                $all_basket_items = Basket::where('basket_id', $cookie_basket)
                    ->where('goods_item_id', $goods_id)
                    ->where('goods_colors_id', !empty($goods_color_id) ? $goods_color_id->id : '')
                    ->get();

                $total_price = 0;

                if (!$all_basket_items->isEmpty()) {
                    foreach ($all_basket_items as $one_item) {
                        $total_price += ($one_item->goods_price * $one_item->items_count);
                    }
                }

                return response()->json([
                    'status' => true,
                    'text' => ShowLabelById(74, $this->lang_id),
                    'basket_count' => $count_all_goods,
                    'total_price' => $total_price
                ]);
            }
        } else {
            if (!is_null($cookie_basket)) {
                $basket_id = BasketId::where('id', $cookie_basket)->first();

                if (!is_null($basket_id)) {
                    Basket::create([
                        'basket_id' => $basket_id->id,
                        'goods_item_id' => $goods_item_id->id,
                        'goods_colors_id' => !empty($goods_color_id) ? $goods_color_id->id : '',
                        'items_count' => $number,
                        'goods_price' => !empty($goods_item_id->price) ? $goods_item_id->price : 0,
                        'goods_name' => !is_null($goods_item_lang) ? $goods_item_lang->name : ''
                    ]);
                } else {
                    $basket_id = BasketId::create(['user_ip' => request()->ip()]);

                    Basket::create([
                        'basket_id' => $basket_id->id,
                        'goods_item_id' => $goods_item_id->id,
                        'goods_colors_id' => !empty($goods_color_id) ? $goods_color_id->id : '',
                        'items_count' => $number,
                        'goods_price' => !empty($goods_item_id->price) ? $goods_item_id->price : 0,
                        'goods_name' => !is_null($goods_item_lang) ? $goods_item_lang->name : ''
                    ]);
                }

                if (!is_null(Cookie::get('basket'))) {
                    Cookie::queue(Cookie::forget('basket'));
                }

                Cookie::queue('basket', $basket_id->id, 45000);
            } else {
                $basket_id = BasketId::create(['user_ip' => request()->ip()]);

                Basket::create([
                    'basket_id' => $basket_id->id,
                    'goods_item_id' => $goods_item_id->id,
                    'goods_colors_id' => !empty($goods_color_id) ? $goods_color_id->id : '',
                    'items_count' => $number,
                    'goods_price' => !empty($goods_item_id->price) ? $goods_item_id->price : 0,
                    'goods_name' => !is_null($goods_item_lang) ? $goods_item_lang->name : ''
                ]);

                if (!is_null(Cookie::get('basket'))) {
                    Cookie::queue(Cookie::forget('basket'));
                }

                Cookie::queue('basket', $basket_id->id, 45000);
            }

        }

        $all_goods = Basket::where('basket_id', $basket_id->id)->get();

        $count_all_goods = count($all_goods);

        $all_basket_items = Basket::where('basket_id', $cookie_basket)
            ->where('goods_item_id', $goods_id)
            ->get();

        $total_price = 0;

        if (!$all_basket_items->isEmpty()) {
            foreach ($all_basket_items as $one_item) {
                $total_price += ($one_item->goods_price * $one_item->items_count);
            }
        }

        return response()->json([
            'status' => true,
            'text' => ShowLabelById(74, $this->lang_id),
            'basket_count' => $count_all_goods,
            'total_price' => $total_price
        ]);

    }

    public function destroyItemCart()
    {

        $goods_id = Input::get('id');
        $goods_colors_id = Input::get('color_id');
        $cookie_basket = Cookie::get('basket');

        $basket = Basket::where('goods_item_id', $goods_id)
            ->where('goods_colors_id', $goods_colors_id)
            ->where('basket_id', $cookie_basket)
            ->first();

        if (is_null($basket) || is_null($cookie_basket))
            return response()->json([
                'status' => false
            ]);

        Basket::where('goods_item_id', $goods_id)
            ->where('goods_colors_id', $goods_colors_id)
            ->where('basket_id', $cookie_basket)
            ->delete();


        $basket_item_after_delete = Basket::where('basket_id', $cookie_basket)
            ->count();

        if ($basket_item_after_delete < 1) {
            BasketId::where('id', $cookie_basket)->delete();

            if (!is_null(Cookie::get('basket'))) {
                Cookie::queue(Cookie::forget('basket'));
            }
        }

        return response()->json([
            'status' => true,
            'item_id' => $basket->goods_item_id,
            'item_color_id' => $basket->goods_colors_id,
            'basket_count' => $basket_item_after_delete
        ]);

    }

    public function diffSumItemCart()
    {
        $goods_id = Input::get('id');
        $goods_color_id = Input::get('color_id');
        $number = Input::get('number');
        $cookie_basket = Cookie::get('basket');

        $basket = Basket::where('goods_item_id', $goods_id)
            ->where('basket_id', $cookie_basket)
            ->where('goods_colors_id', $goods_color_id)
            ->first();

        if (is_null($basket) || is_null($cookie_basket))
            return response()->json([
                'status' => false
            ]);

//		$one_item_price = $basket->goods_price * $basket->items_count;

        if ($number > 0) {

            $data = [
                'items_count' => $number
            ];

            Basket::where('goods_item_id', $goods_id)
                ->where('basket_id', $cookie_basket)
                ->where('goods_colors_id', $goods_color_id)
                ->update($data);

            $one_item_price = $number * $basket->GoodsItemId->price;

            return response()->json([
                'status' => true,
                'item_id' => $basket->goods_item_id,
                'color_id' => $basket->goods_colors_id,
                'basket_count' => $number,
                'item_price' => $one_item_price
            ]);
        } else
            return response()->json([
                'status' => false
            ]);
    }

    public function simpleFeedbackAjax()
    {


        //Email template edit
        //$data = ['name' => 'name', 'phone' => 'phone', 'id' => 'id', 'email' => 'email'] ;
        //return view('front.email.emailFeedback', ['data' => $data] );

        $validate_key = [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ];

        $item = Validator::make(Input::all(), $validate_key);

        if ($item->fails())
            return response()->json([
                'status' => false,
                'messages' => $item->messages(),
            ]);

        $data = [
            'name' => Input::get('name'),
            'phone' => Input::get('phone'),
            'email' => Input::get('email'),
            'ip' => request()->ip(),
            'active' => 0,
            'seen' => 0
        ];


        $feedform = FeedForm::create($data);

        if (!empty($feedform)) {


            $my_email = showSettingBodyByAlias('email-phone', $this->lang_id);
            $email_from = Input::get('email');
            $name_from = Input::get('name');
            $site_name = request()->getHost();
            $page = view('front.email.emailFeedback', ['data' => $feedform])->render();

            sendEmail($my_email, $name_from, $email_from, $site_name, $page, myTrans('Message'));

            //Mail::send('front.email.emailFeedback', ['data' => $feedform], function ($message) use ($my_email, $subject) {
            //    $message->from(showSettingBodyByAlias('send-email-from', $this->lang_id), Input::get('name'));
            //    $message->to($my_email);
            //    $message->subject(myTrans('Message') . ' | ' . $subject);
            //});

            ZohoController::createUpdateContact($email_from, $name_from, ['person' => ["phone" => $data['phone']]]);

            return response()->json([
                'status' => true,
                'text' => myTrans('Message sent successfully')
            ]);
        } else
            return response()->json([
                'status' => false,
                'text' => myTrans('Something was wrong')
            ]);
    }

}
