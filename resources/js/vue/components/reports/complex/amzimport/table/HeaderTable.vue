<template>
    <thead>
        <tr>
            <th v-if="getTableFieldsByBlock('base')" :colspan="getTableFieldsLengthByBlock('base')">
                Base Info
            </th>
            <th v-if="getTableFieldsByBlock('attributes')" :colspan="getTableFieldsLengthByBlock('attributes')">
                Attributes
            </th>
            <th v-if="getTableFieldsByBlock('custom_attributes')" :colspan="getTableFieldsLengthByBlock('custom_attributes')">
                Custom Attributes
            </th>
            <th v-if="getTableFieldsByBlock('merkal')" :colspan="getTableFieldsLengthByBlock('merkal')">
                Merkal
            </th>
        </tr>
        <tr>
            <th v-for="base in getTableFieldsByBlock('base')" rowspan="2">
                {{base}}
            </th>
            <th v-for="(name, index) in getTableFieldsByBlock('attributes')">
                {{index}}
            </th>
            <th v-for="(name, index ) in getTableFieldsByBlock('custom_attributes')">
                {{index}}
            </th>
            <th v-for="(name, index ) in getTableFieldsByBlock('merkal')">
                {{name}}
            </th>
        </tr>
        <tr>
            <th v-for="name in getTableFieldsByBlock('attributes')">
                {{name}}
            </th>
            <th v-for="name in getTableFieldsByBlock('custom_attributes')">
                {{name}}
            </th>
            <th v-for="name in getTableFieldsByBlock('merkal')">
                {{name}}
            </th>
        </tr>
    </thead>
</template>

<script>
    import Vue from 'vue'
    import {mapGetters} from 'vuex'

    export default {

        computed: {
            ...mapGetters('complexReports', ['getTableFieldsByBlock', 'getTableFieldsLengthByBlock'])
        }
    }
</script>