<!-- component template -->
<script type="text/x-template" id="table-template">
    <div class="vue_table">

        <div class="scrollTable">

            <table v-show="filtered_rows.length" :id="tabCode + '_table'">
                <thead>
                <tr>
                    <th v-for="(value, key) in rows.attributes"
                        @click="sortBy(key)"
                        :class="{ active: sortKey == key }">
                        <span class="arrow" v-text="value" :class="sortOrders[key] > 0 ? 'asc' : 'dsc'"></span>
                    </th>
                    <th>{{__('Ed.')}}</th>
                    <th>{{__('Del.')}}</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="row in filtered_rows">
                    <td v-for="(value, key) in rows.attributes" :class="key">
                        <div v-if="key === 'id'" class="checkbox">
                            <input type="checkbox"
                                   v-model="selected"
                                   :value="tabCode + '_' +  row.id"
                                   :id="tabCode + '_' +  row.id">

                            <label :for="tabCode + '_' +  row.id" v-text="row[key]"></label>
                        </div>
                        <div v-else v-html="row[key]"></div>
                    </td>
                    <td>
                        <div class="icon_wrap edit" @click="$emit('edit-click', row.id)">
                            <i class="fas fa-pen"></i>
                        </div>
                    </td>
                    <td>
                        <div class="icon_wrap close" @click="deleteItems(row.id)">
                            <svg class="icon">
                                <i class="fas fa-times"></i>
                            </svg>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <p v-show="!filtered_rows.length">{{__('Nothing found')}}</p>

        </div>

        <div class="d-flex">

            <div class="table_delete" v-if="selected.length" @click="deleteItems($event, selected)">
                <div class="submit_btn">
                    {{__('Delete')}} <span v-text="selected.length"></span>
                </div>
            </div>

            <div class="table_delete" v-if="selected.length" @click="selected = []">
                <div class="submit_btn">
                    {{__('Clear')}}
                </div>
            </div>
        </div>
    </div>
</script>
<!-- component template -->

<script>
    // register the grid component
    Vue.component("table-template", {
        template: "#table-template",
        props: {
            rows: Array,
            filterKey: String,
            tabCode: String,
        },
        data() {
            const sortOrders = {};
            const attributes = this.rows.attributes;
            for (const attribute in attributes)
                if (attributes.hasOwnProperty(attribute))
                    sortOrders[attribute] = 1;
            return {
                selected: [],
                sortKey: "id",
                sortOrders: sortOrders,
            };
        },
        computed: {
            filtered_rows() {
                let {sortKey, filterKey, sortOrders, rows: {data}} = this;
                if (filterKey) {
                    data = data.filter(row =>
                        Object.values(row).some(row_value =>
                            String(row_value).includes(filterKey)
                        )
                    )
                }
                data = data.sort((a, b) =>
                    (a[sortKey] === b[sortKey] ? 0 : a[sortKey] > b[sortKey] ? 1 : -1) * sortOrders[sortKey] || 1
                );
                return data;
            }
        },
        methods: {
            sortBy(key) {
                this.sortKey = key;
                this.sortOrders[key] = this.sortOrders[key] * -1;
            },
            deleteItems(selected) {
                let {tabCode} = this;
                let ids = null;
                let notSingleId = isNaN(selected);
                if (!confirm(`{{__('Are you sure you want to delete')}}`)) return;
                if (notSingleId)
                    ids = selected.map(id => id.replace(`${tabCode}_`, ''));
                else
                    ids = [selected];
                this.deleteRequest(ids, tabCode);
            },
            deleteRequest: async function (ids, tabCode) {
                let url = `/api/${tabCode}/delete`;
                let {res} = await deleteFetch(url, ids);
                if (res.ok) {
                    this.selected = [];
                    snax.msg('{{__('Success')}} !', 'success')
                } else {
                    snax.msg('{{__('Error')}} !', 'error')
                }
                this.$emit('refresh');
                this.$forceUpdate();
            }
        },
    });
</script>

<style>


    table {
        width: 100%;
        overflow: hidden;
    }

    thead{
        position: sticky;
        z-index: 1;
    }

    th {
        padding: 22px 10px;
        font-size: 15px;
        color: #59d554;
        line-height: 1.4;
        text-transform: uppercase;
        cursor: pointer;
        border-bottom: solid 1px grey;
        flex-grow: 1;
        max-height: 70px;
    }

    th:hover {
        border-bottom: solid 1px green;
    }

    th.active {
        border-bottom: solid 1px #59d554;
    }

    td {
        padding: 10px;
        font-size: 15px;
        color: gray;
        line-height: 1.4;
        text-align: center;
    }
    td:first-child {
        text-align: left;
    }

    td:last-child {
        text-align: right;
    }

    td.id {
        width: 0;
        text-align: left;
    }

    .close:hover svg {
        color: #f44;
    }

    .edit:hover svg {
        color: #59d554;
    }

    .table_delete {
        margin-top: 20px;
        margin-right: 10px;
    }

    .table_loadeing {
        position: relative;
    }

    .table_not_loadeing:after {
        content: '';
        position: absolute;
        z-index: 9999;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        background: white;
        opacity: 0;
        visibility: hidden;
        transition: visibility 0s, all .2s;
    }

    .table_loadeing:after {
        opacity: .5;
        visibility: inherit;
    }

    .icon_wrap {
        display: flex;
        margin: auto;
        width: 24px;
        height: 24px;
        border: 2px solid #fff;
        border-radius: 50%;
        cursor: pointer;
        justify-content: center;
        align-items: center;
        transition: .2s linear;
    }

    .icon_wrap svg {
        display: block;
        width: 10px;
        height: 10px;
        transition: .2s linear;
        color: #fff;
    }

    .icons-nav {
        display: flex;
        justify-content: flex-end;
        flex: 1;
        align-items: center;
    }
</style>