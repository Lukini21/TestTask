<template>
    <div class="container" :class="{'loading': loading}">
        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" placeholder="Search by name" class="form-control" v-model="filterQuery.name">
                </div>
                <div class="mb-3" v-for="(filter, key) in filters.checkbox">
                    <label class="form-label">{{ filter.name }}</label>
                    <div class="form-group">
                        <div class="form-check form-check-inline" v-for="(value, index) in filter.values">
                            <input class="form-check-input" :name="index+key" type="checkbox"
                                   :id="'checkbox-' + key + index" :value="value" :key="value"
                                   v-model="filterQuery[key]">
                            <label class="form-check-label" :for="'checkbox-' + key + index">{{ value }}</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label class="form-label">Price min</label>
                            <input type="number" class="form-control" placeholder="Min" name="min"
                                   v-model="filterQuery.price_min">
                        </div>
                        <div class="col">
                            <label class="form-label">Price max</label>
                            <input type="number" class="form-control" placeholder="Max" name="max"
                                   v-model="filterQuery.price_max">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="button"
                            @click="loadProducts">Search
                    </button>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row mt-4">
                    <table class="table table-bordered" v-if="products.length">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Bedrooms</th>
                            <th>Bathrooms</th>
                            <th>Storeys</th>
                            <th>Garages</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="product in products">
                            <td>{{ product.name }}</td>
                            <td>{{ product.bedrooms }}</td>
                            <td>{{ product.bathrooms }}</td>
                            <td>{{ product.storeys }}</td>
                            <td>{{ product.garages }}</td>
                            <td>{{ product.price }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div v-else>
                        <h4>No results found</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            products: [],
            loading: true,
            filters: {},
            filterQuery: {
                bedrooms: [],
                bathrooms: [],
                storeys: [],
                garages: [],
                price_min: '',
                price_max: '',
                name: ''
            }
        }
    },

    mounted() {
        this.loadFilters();
        this.loadProducts();
    },

    methods: {
        loadProducts: function () {
            axios.post('/api/products',
                this.filterQuery
            )
                .then((response) => {
                    this.products = response.data.products;
                    this.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        loadFilters: function () {
            axios.get('/api/filters', {})
                .then((response) => {
                    this.filters = response.data.filters;
                    this.filterQuery.price_min = parseInt(this.filters.price.values.min_price);
                    this.filterQuery.price_max = parseInt(this.filters.price.values.max_price);
                    this.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }
}
</script>
