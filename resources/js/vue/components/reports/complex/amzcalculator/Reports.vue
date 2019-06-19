<template>
    <div class="table-responsive">
        <table class="table">
            <header-table></header-table>
            <body-table></body-table>
        </table>
    </div>
</template>

<script>
    import Vue from 'vue'
    import {mapState, mapGetters} from 'vuex'
    import HeaderTable from './table/HeaderTable.vue'
    import BodyTable from './table/BodyTable.vue'

    export default {
        name: 'AmzCalcTable',

        components: {
            'header-table': HeaderTable,
            'body-table': BodyTable
        },

        props: {
            tableUri: String
        },

        mounted() {
            this.$store.dispatch('complexReports/amzCalculator/loadData')
        }
    }
</script>