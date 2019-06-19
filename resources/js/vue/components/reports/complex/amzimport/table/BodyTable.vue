<template>
    <tbody>
    <template v-for="item in getTableData">
        <product-row :item="item.base" :type="'base'"> </product-row>
        <product-row :item="item.base" :type="'main'"> </product-row>
        <template v-for="(complex, index) in item.complex">
            <product-row  :item="complex" :type="'complex'" :index="index"> </product-row>
        </template>
        <product-row v-if ="item.child" :item="item" :type="'child'"> </product-row>
    </template>
    </tbody>
</template>

<script>
    import Vue from 'vue'
    import {mapGetters} from 'vuex'
    import RowProduct from './rows/RowProduct.vue'

    export default {
        components: {
            'product-row': RowProduct
        },
        computed: {
            ...mapGetters('complexReports', ['getTableData'])
        },
    }
</script>