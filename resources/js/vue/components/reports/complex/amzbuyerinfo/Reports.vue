<template>
    <div>

    </div>
</template>

<script>
    import Vue from 'vue'
    import {mapState, mapGetters} from 'vuex'

    export default {
        name: 'AmzBuyerInfoTable',
        components: {

        },
        props: {
            tableUri: String
        },
        methods: {
            getResults(page = 1) {
                this.$store.dispatch('complexReports/amzBuyerInfo/loadData',  page)

            }
        },
        mounted() {
            this.$store.dispatch('complexReports/amzBuyerInfo/loadData')
        },
        computed: {
            ...mapGetters('complexReports/module_buyer_info', ['getter_iz_module_buyer_info'])
        },
    }

</script>