<template>
    <div>
        <filter-bar
                :filters="filters"
        ></filter-bar>
        <reporting-table ref="vuetable"
                         :tableUri="tableUri"
                         :fields="fields"
        ></reporting-table>

    </div>
</template>

<script>
    import ReportingTable from '@vue-components/utils/ReportingTable'
    import Vue from 'vue'
    import FilterBar from '@vue-components/utils/FilterBar'
    import { mapState, mapActions } from 'vuex'

    Vue.component('filter-bar', FilterBar)
    export default {
        name: 'TableList',
        components: {
            'reporting-table': ReportingTable
        },
        props: {
            tableUri: String
        },
        computed: {
            filtersRoute() {
                return this.tableUri.search('amz') >= 0 ? 'amz-table-list' : 'jtl-table-list';
            },
            ...mapState('simpleReports', [
                'fields',
                'filters',
            ]),
        },
        watch: {
            tableUri: {
                handler() {
                    this.$store.dispatch('simpleReports/loadFilters', this.filtersRoute);
                },
                immediate: true,
            },
        },
        mounted() {
            this.$store.dispatch('simpleReports/loadFieldsTableList',  this.tableUri)
        },
        methods: {
            ...mapActions(['simpleReports/updateFilterValue']),
        }

    }
</script>
