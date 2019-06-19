<template>
    <div>
        <filter-bar
                @filterUpdate="updateFilterValue"
                :filters="filters"
        ></filter-bar>
        <reporting-table
                  :tableUri="tableUri"
                  :fields="fields"
        ></reporting-table>
    </div>
</template>

<script>
    import ReportingTable from '@vue-components/utils/ReportingTable'
    import Vue from 'vue'
    import FilterBar from '@vue-components/utils/FilterBar'
    import { mapState , mapActions} from 'vuex'

    export default {
        name: 'AmzRatingTable',
        components: {
            'reporting-table': ReportingTable,
            FilterBar
        },
        props: {
            tableUri: String
        },
        mounted() {
            this.$store.dispatch('simpleReports/loadFieldsTableList',  this.tableUri)
            this.$store.dispatch('simpleReports/loadFilters',  'amz-rating')
        },
        computed: {
            ...mapState('simpleReports', [
                'fields',
                'filters',
            ]),
        },

        methods: {
            ...mapActions('simpleReports', ['updateFilterValue']),
        }
    }
</script>