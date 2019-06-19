<template>
    <div>
        <component v-bind:is="currentView" :tableUri="vueTableUri"></component>
    </div>
</template>

<script type="text/javascript">
    import AmzRating from './components/reports/simple/amzrating/Reports.vue'
    import TableList from './components/reports/simple/table_list/Reports.vue'
    import AmzImport from './components/reports/complex/amzimport/Reports.vue'
    import AmzCalculator from './components/reports/complex/amzcalculator/Reports.vue'
    import AmzBuyerInfo from './components/reports/complex/amzbuyerinfo/Reports.vue'

    export default {
        props: {
            vueTableUri: String,
            vueTableTemplate: String,
        },

        data() {
            return {};
        },

        mounted() {
        },

        methods: {
        },

        computed: {
            currentView(){
                switch(this.vueTableTemplate) {
                    case 'amzraring':
                        return AmzRating;
                    case 'amzimport':
                        return AmzImport;
                    case 'amzbuyerinfo':
                        return AmzBuyerInfo;
                    case 'amzcalc':
                        return AmzCalculator;
                    default :
                        return TableList;
                }
            }
        }
    };
</script>