<template>
    <div class="container" :class="{'loading': loading}">
        <el-row :gutter="20">
            <el-col :span="4">

                <el-row class="form-row">
                    <el-col>
                        <label class="form-label">Name</label>
                        <el-input placeholder="Search by name" v-model="filterQuery.name"></el-input>
                    </el-col>
                </el-row>

                <el-row class="form-row" v-for="(filter, key) in filters.checkbox">
                    <el-col>
                        <label class="form-label">{{ filter.name }}</label>
                        <el-checkbox-group v-model="filterQuery[key]">
                            <el-checkbox v-for="value in filter.values" :label="value" :key="value">
                                {{ value }}
                            </el-checkbox>
                        </el-checkbox-group>
                    </el-col>
                </el-row>

                <el-row class="form-row">
                    <el-col>
                        <el-row>
                            <label class="form-label">Price min</label>
                        </el-row>
                        <el-row>
                            <el-input-number class="input-price" :size="'large'" name="min"
                                             v-model="filterQuery.price_min"></el-input-number>
                        </el-row>
                    </el-col>
                </el-row>

                <el-row class="form-row">
                    <el-col>
                        <el-row>
                            <label class="form-label">Price max</label>
                        </el-row>
                        <el-row>
                            <el-input-number class="input-price" :size="'large'" name="max"
                                             v-model="filterQuery.price_max"></el-input-number>
                        </el-row>
                    </el-col>
                </el-row>

                <el-row class="form-row">
                    <el-col>
                        <el-button :size="'large'" @click="loadProducts">Search</el-button>
                    </el-col>
                </el-row>

            </el-col>
            <el-col :span="16">
                <div class="row mt-4">
                    <el-table v-if="products.length"
                              :data="products"
                              style="width: 100%">
                        <el-table-column
                            prop="name"
                            label="Name">
                        </el-table-column>
                        <el-table-column
                            prop="bedrooms"
                            label="Bedrooms">
                        </el-table-column>
                        <el-table-column
                            prop="bathrooms"
                            label="Bathrooms">
                        </el-table-column>
                        <el-table-column
                            prop="storeys"
                            label="Storeys">
                        </el-table-column>
                        <el-table-column
                            prop="garages"
                            label="Garages">
                        </el-table-column>
                        <el-table-column
                            prop="price"
                            label="Price">
                        </el-table-column>
                    </el-table>
                    <div v-else>
                        <h4>No results found</h4>
                    </div>
                </div>
            </el-col>
        </el-row>
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
