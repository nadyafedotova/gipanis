<template>
    <thead>
        <tr>
            <th v-for="item in getTableFieldsByBlock('base')">
                {{item}}
            </th>
        </tr>
    </thead>
</template>

<script>
    import Vue from 'vue'
    import {mapGetters} from 'vuex'

    export default {

        computed: {
            ...mapGetters('complexReports/amzImport', ['getTableFieldsByBlock', 'getTableFieldsLengthByBlock'])
        }
    }
</script>