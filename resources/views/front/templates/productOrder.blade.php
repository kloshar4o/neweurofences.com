<form id="product_form" class="item_page_item_description">


    <div v-if="sizes.length" class="item-page-select-size">

        {{ myTrans('Select size') }}

        <slot v-for="size in sizes">
            <input type="radio" name="size" v-model="formData.size" :value="size" :id="'size_' + size.id">
            <label :for="'size_' + size.id" :title="size.title">

                <div class="item-page-check">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"/>
                    </svg>
                </div>
                <div class="item-page-size" v-text="size.label"></div>
                <div class="item-page-size-price"
                     v-text="size.price || '{{myTrans('Price')}}: {{myTrans('Not_fixed')}}'"></div>
            </label>
        </slot>


        <span class="validate" :class="validate.size && !formData.size ? 'show' : 'hide'">
            {{myTrans('Please select size')}}!
        </span>

    </div>

    <div v-if="colors.length" class="item-page-select-color">

        {{ myTrans('Colors') }}

        <div class="item-page-colors">
            <div v-for="color in colors" :class="colorNotInSize(color.id)">

                <input type="radio"
                       name="color"
                       v-model="formData.color"
                       :value="color"
                       :id="'color_' + color.id">

                <label class="hexagon"
                       :class="'ral_' + color.ral"
                       :for="'color_' + color.id"
                       :title="color.name + '(ral_' + color.ral + ')'">

                    <div class="ratio-1-1" :style="{backgroundColor: color.hex}"></div>
                    <div class="item-page-check">
                        <svg :style="{fill: color.hex}" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24">
                            <path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"/>
                        </svg>
                    </div>
                    <div class="item-page-text" v-text="color.name"></div>
                </label>

            </div>
        </div>

        <span class="validate" :class="validate.color && formData.size.colors ? 'show' : 'hide'">
            {{myTrans('Please select color')}}!
        </span>

    </div>

    <div>
        <div class="flex">

            <div class="item-page-select-quantity">
                <div :class="formData.quantity == 1 && 'disabled'">
                    <div class="btn" @click="formData.quantity > 1 && formData.quantity--">&#8722;</div>
                </div>
                <input type="number" :min="0" name="quantity" v-model="formData.quantity">
                <div class="btn" @click="formData.quantity++">&#43;</div>
            </div>

            <div @click="addToCart($event)">
                <div class="btn">
                    <svg>
                        <use xlink:href="{{ asset('front-assets/img/symbols.svg#shopping-basket') }}"></use>
                    </svg>
                    <div>Adaugă în Coș</div>
                </div>
            </div>

        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>

    let form = '#product_form';

    let $goods_subject = <?= json_encode($goods_subject); ?> ;
    let $goods_item = <?= json_encode($goods_item); ?> ;
    let $item_size_list = <?= json_encode($item_size_list); ?>;
    let $colors_list = <?= json_encode($colors_list); ?>;

    let product_form = new Vue({
        el: form,
        data: {
            sizes: $item_size_list,
            colors: $colors_list,
            formData: {
                $goods_subject,
                $goods_item,
                size: null,
                color: null,
                quantity: 1
            },
            validate: {
                size: false,
                color: false,
            }

        },
        watch: {
            'formData.size': function (size) {

                console.log(product_gallery, size);
                if (!product_gallery) return

                for (let i = 0; i < product_gallery.params.sliderDom.children.length; i++) {
                    let slide = product_gallery.params.sliderDom.children[i];
                    if (slide.dataset.size_id !== size.id.toString()) continue
                    product_gallery.active = i;
                }

            },
            'formData.color': function () {
                this.validate.color = false;
            }
        },
        methods: {
            addToCart: async function (event) {
                let valid = this.validateForm();

                if (!valid) return;

                let button = event.currentTarget;

                button.classList.add('disabled')

                await ajaxAddToCart(this.formData);

                button.classList.remove('disabled')


                $('.js-panel-cart').addClass('show-header-cart');

            },
            validateForm: function () {
                const data = this.formData;
                let sizeSelected = data.size;
                if (sizeSelected) {
                    let availableColors = sizeSelected.colors;
                    if (availableColors) {
                        if (!data.color) {
                            this.validate.color = true;
                            return false
                        }
                    }
                } else {
                    if (this.sizes.length) {

                        this.validate.size = true;
                        return false
                    }
                }


                return true;


            },
            colorNotInSize: function (colorId) {
                let data = this.formData;
                let thisColorNotInSize = true;

                if (data.size) {

                    let sizeColors = data.size.colors.split(', ');

                    thisColorNotInSize = !sizeColors.includes(colorId.toString());

                    let thisColorIsSelected = data.color && colorId === data.color.id

                    if (thisColorNotInSize && thisColorIsSelected) {
                        this.formData.color = null;
                    }
                }

                return thisColorNotInSize && 'disabled'

            }
        }

    })
</script>