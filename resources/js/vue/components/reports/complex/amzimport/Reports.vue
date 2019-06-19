<template>
    <div>
        <import-form class="import-form"
            :tableUri="tableUri"
        ></import-form>
        <filter-table
                @filterUpdate="updateFilterValue"
        ></filter-table>
        <div class="table-responsive">
            <table class="table">
                <header-table></header-table>
                <body-table></body-table>
            </table>
            <pagination v-if="Object.keys(getPagination).length" :limit="10" :data="getPagination" @pagination-change-page="getResults"></pagination>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue'
    import {mapState, mapGetters, mapActions} from 'vuex'
    import ImportForm from './ImportForm.vue'
    import HeaderTable from './table/HeaderTable.vue'
    import BodyTable from './table/BodyTable.vue'
    import FiltersTable from './table/FiltersTable.vue'
    const Pagination = require('laravel-vue-pagination');
    console.log('pagination component', Pagination);
    export default {
        name: 'AmzImportTable',
        components: {
            'import-form': ImportForm,
            'header-table': HeaderTable,
            'body-table': BodyTable,
            'pagination': Pagination,
            'filter-table': FiltersTable,
        },
        props: {
            tableUri: String,
        },
        methods: {
            getResults(page = 1) {
                this.$store.dispatch('complexReports/amzImport/loadData',  page)
            },
            ...mapActions('complexReports/amzImport', ['updateFilterValue'])
        },
        mounted() {
            this.$store.dispatch('complexReports/amzImport/loadData')
        },
        computed: {
            ...mapGetters('complexReports', ['getPagination']),
        },
        events: {
            'filter-set' () {
                this.$store.dispatch('complexReports/amzImport/updateFilterValue');
                this.getResults(1)

            },
            'filter-reset' () {
                this.$store.dispatch('complexReports/resetFilterValues');
            }
        },
    }
</script>