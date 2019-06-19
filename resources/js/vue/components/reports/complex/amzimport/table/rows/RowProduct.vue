<template>
        <tr :class="classRow">
            <td v-for="key in getTableFieldsByBlock('base')">
                {{ baseVal(key) }}
            </td>
            <td v-for="(name, key) in getTableFieldsByBlock('attributes')">
                {{item[key]}}
            </td>
            <td v-for="(name, key ) in getTableFieldsByBlock('custom_attributes')">
                {{item[key]}}
            </td>
            <td v-for="(name, key ) in getTableFieldsByBlock('merkal')">
                {{item[key]}}
            </td>
        </tr>
</template>

<script>

    import Vue from 'vue'
    import {mapGetters} from 'vuex'
    import {baseBaseRow, baseMainRow, baseChilRow} from '../../../../../../helpers/reports/complex/tableRow'

    export default {
        props: {
            item:  {
                type: Object,
                required: true
            },
            type: {
                type: String,
                required: true
            },
            index: {
                type: Number,
                default:0,
                required: false
            }
        },

        methods: {
            baseVal(key) {
                switch(this.type) {
                    case 'base':
                        return baseBaseRow(key, this.item);
                    case 'main':
                        return baseMainRow(key, this.item);
                    case 'complex':
                        return baseChilRow(key, this.item, this.index);
                    case 'child':
                        return baseChilRow(key, this.item, this.index);
                    default:
                        return '';
                }
            }
        },
        computed: {
            classRow: function () {
                return this.type =='base' ? 'colorLine': '';
            },
            ...mapGetters('complexReports', ['getTableFieldsByBlock'])
        }
    }
</script>
