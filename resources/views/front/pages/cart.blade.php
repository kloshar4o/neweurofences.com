@extends('front.front-app')

@include('front.header')

@section('container')

    <div class="container" id="checkout_form">

        @include('front.templates.breadcrumbs')


        @isset($miniCart)

            <div class="new_checkout" v-if="!thank_you">

                <div class="cart_section">

                    <div class="title">{{ ShowLabelById(16,$lang_id) }}</div>

                    <div class="ul-header-cart-wrapitem"
                         v-for="($category, $category_key) in miniCart">

                        <a :href="'/{{$lang}}' + $category.url" class="category_title" v-text="$category.name"></a>

                        <ul class="header-cart-wrapitem">

                            <li class="header-cart-item" v-for="($product, $product_key) in $category.products">

                                <div class="img desktop">
                                    <img data-fancybox="gallery"
                                         :data-src="'/upfiles/gallery/' + $product.img"
                                         :src="'/upfiles/gallery/s/' + $product.img">
                                </div>

                                <div class="header-cart-item-wrapper" :class="!$product.sizes && 'no_sizes'">

                                    <div class="header-cart-item-img">
                                        <div class="img mobile">
                                            <img data-fancybox="gallery"
                                                 :data-src="'/upfiles/gallery/' + $product.img"
                                                 :src="'/upfiles/gallery/s/' + $product.img">
                                        </div>
                                        <a :href="'/{{$lang}}' + $product.url" class="header-cart-item-name"
                                           v-text="$product.name"></a>
                                    </div>

                                    <div v-if="!$product.has_sizes" class="header-cart-item-txt">

                                        <div class="header-cart-item-info d-flex">
                                            <div class="size_price">
                                                <div class="price" v-text="$product.money"></div>

                                                <input-quantity
                                                        :item="$product"
                                                        @quantity-change="quantityChange($event, $product.url, $category.url, $category_key, $product_key)">
                                                </input-quantity>

                                            </div>

                                        </div>
                                    </div>

                                    <div v-if="$product.has_sizes" class="header-cart-item-txt cart_sizes">

                                        <div class="header-cart-item-info" v-for="($size, $size_key) in $product.sizes">

                                            <div v-if="!$size.has_colors" class="header-cart-item-info d-flex">

                                                <div v-text="$size.label"></div>

                                                <div class="size_price">
                                                    <div class="size_price">

                                                        <div class="price" v-text="$size.money"></div>

                                                        <input-quantity
                                                                :item="$size"
                                                                @quantity-change="quantityChange($event, $product.url, $category.url, $category_key, $product_key, $size_key)">
                                                        </input-quantity>

                                                    </div>
                                                </div>

                                            </div>

                                            <div v-if="$size.has_colors" class="header-cart-item-info cart_colors">

                                                <div class="d-flex"
                                                     v-for="($color, $color_key) in $size.colors">

                                                    <div>
                                                        <span class="color"
                                                              :style="{backgroundColor: $color.hex}"></span>
                                                        <span v-text="$size.label"></span>
                                                    </div>

                                                    <div class="size_price">

                                                        <div class="price" v-text="$size.money"></div>

                                                        <input-quantity
                                                                :item="$color"
                                                                @quantity-change="quantityChange($event, $product.url, $category.url, $category_key, $product_key, $size_key, $color_key)">

                                                        </input-quantity>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </li>

                        </ul>

                    </div>

                    <div>
                        <div class="header-cart-total" v-if="session">
                            Total: <span class="price"
                                         v-text="total() ? total() + ' Lei cu TVA inclus ' : '{{myTrans('Not fixed')}}'"></span>
                        </div>
                    </div>


                </div>

                <div class="split_border"></div>

                <div class="form_section">
                    <form method="POST" class="cart" @submit="confirmOrder" action="{{ url($lang,'newOrder') }}">

                        <div class="title">{{ ShowLabelById(38,$lang_id) }}</div>

                        <label for="name"><sub>{{ ShowLabelById(39,$lang_id) }}*</sub></label>
                        <input type="text" name="name" id="name" v-model="form_data.name" required>

                        <label for="phone"><sub>{{ ShowLabelById(13,$lang_id) }}*</sub></label>
                        <input type="text" name="phone" id="phone" v-model="form_data.phone" required>

                        <label for="email"><sub>Email*</sub></label>
                        <input type="text" name="email" id="email" v-model="form_data.email"
                               @input="not_valid.email = false" required>
                        <span class="validate"
                              :class="not_valid.email ? 'show' : 'hide'">{{myTrans('Email not valid')}}</span>

                        <label for="city"><sub>{{myTrans('City')}}*</sub></label>
                        <input type="text" name="city" id="city" v-model="form_data.city" required>

                        <label for="city"><sub>{{myTrans('Address')}}*</sub></label>
                        <input type="text" name="address" id="address" v-model="form_data.address" required>

                        {{--

                                                <label for="pay"><sub>{{myTrans("Pay method")}}:</sub></label>
                                                <div class="pay_method">
                                                    <input type="radio" name="pay" value="cash" id="cash" checked><label for="cash">Plata prin
                                                        ramburs</label>
                                                    <input type="radio" name="pay" value="nocash" id="nocash"><label for="nocash">Ordin de
                                                        plata</label>
                                                </div>
                        --}}

                        <label for="message"><sub>{{ ShowLabelById(42,$lang_id) }} ({{myTrans('optional')}})</sub></label>
                        <textarea name="message" id="message" v-model="form_data.message"></textarea>

                        <div :class="!session && 'disabled'">

                            <button class="btn" data-form-id="new_order"
                                    type="submit">{{ ShowLabelById(38,$lang_id) }}</button>

                        </div>

                        <div class="feedback_response ">{{ ShowLabelById(43,$lang_id) }}</div>


                    </form>

                </div>

            </div>

            <div v-if="thank_you" class="thank_you d-flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"></path></svg>

                <div>
                    <h1>Succes</h1>
                    <p>Comanda dvs. a avut succes <br> Vă vom contacta în curând</p>
                    <a href="/">Acasa</a>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/vue"></script>

            <script>

                let form = '#checkout_form';

                let miniCart = JSON.parse(<?= json_encode(isset($miniCart) ? json_encode($miniCart) : []); ?>);
                let session = <?= json_encode(session()->get('cart')); ?>;

                Vue.component('input-quantity', {
                    props: ['item'],
                    data() {
                        return {
                            confirm: {
                                text: '{{myTrans('Are you sure you want to delete?')}}',
                                yes: '{{myTrans('Yes')}}',
                                cancel: '{{myTrans('cancel')}}',
                                show: false,
                            }
                        }
                    },
                    watch: {
                        'item.quantity': function (q) {
                            let quantity = parseInt(q) < 0 ? 0 : parseInt(q);
                            this.confirm.show = quantity === 0;

                            if (quantity !== 0)
                                this.$emit('quantity-change', quantity)
                        }
                    },
                    template:
                        `<div class="checkout-select-quantity">

                            <div @click="item.quantity--" >−</div>
                            <input type="number" min="0" v-model="item.quantity">
                            <div @click="item.quantity++">+</div>

                            <div class="confirm" :class="confirm.show && 'show'">
                                <div class="overlay">
                                    <p v-text="confirm.text"></p>
                                    <div class="btn" @click="item.quantity = null"  v-text="confirm.yes"></div>
                                    <div class="btn" @click="item.quantity = 1" v-text="confirm.cancel" ></div>
                                </div>
                            </div>

                            <div v-if="item.quantity === null" @click="item.quantity = 1" class="delete-overlay"></div>

                        </div>`
                });

                new Vue({
                    el: form,
                    data: {
                        form_data: {
                            token: "{{ csrf_token() }}"
                        },
                        not_valid: {},
                        thank_you: false,
                        miniCart,
                        session,
                    },
                    methods: {
                        quantityChange: async function ($event, $product_url, $category_url, $category_key, $product_key, $size_key = null, $color_key = null) {

                            $event = $event || null;

                            let res = await ajaxUpdateQuantity({
                                $event,
                                $product_url,
                                $category_url,
                                $category_key,
                                $product_key,
                                $size_key,
                                $color_key
                            });

                            if (res.status)
                                this.session = res.session
                        },

                        total: function () {

                            let sum = 0;

                            for (let cat_id in miniCart) {

                                if (!miniCart.hasOwnProperty(cat_id)) continue;

                                Object
                                    .values(miniCart[cat_id].products)
                                    .forEach(({price, quantity, has_sizes, sizes}) => {

                                        if (!has_sizes) {
                                            sum += (parseInt(price) || 0) * (parseInt(quantity) || 0)
                                        }

                                        if (has_sizes)
                                            sum += Object
                                                .values(sizes)
                                                .reduce((sumSize, {price, quantity, has_colors, colors}) => {

                                                    if (has_colors)
                                                        quantity = Object
                                                            .values(colors)
                                                            .reduce((sumColorQuantity, {quantity: ColorQuantity}) => {

                                                                return sumColorQuantity + parseInt(ColorQuantity)
                                                            }, 0);

                                                    sumSize += (parseInt(price) || 0) * (parseInt(quantity) || 0);

                                                    return sumSize
                                                }, 0);
                                    });
                            }

                            return sum
                        },

                        validEmail: function (email) {
                            let re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                            return re.test(email);
                        },

                        confirmOrder: async function (e) {
                            e.preventDefault();

                            let data = this.form_data;
                            let not_valid = this.not_valid;
                            let {email} = data;

                            not_valid.email = !this.validEmail(email);

                            this.$forceUpdate();

                            for (let input in not_valid) {
                                if (not_valid.hasOwnProperty(input))
                                    if (not_valid[input]) return
                            }

                            document.getElementById('loader').classList.add('fade_in_half');

                            let res = await newOrder(data);

                            document.getElementById('loader').classList.remove('fade_in_half');

                            if (res.status === true) {
                                this.thank_you = true;
                            }

                        }
                    }
                })


            </script>

        @endisset

        @empty($miniCart)


            <div class="title text-center">{{myTrans('The cart is empty')}}</div>

        @endempty

    </div>




@stop

@include('front.footer')