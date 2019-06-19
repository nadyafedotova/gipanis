<template>
    <div class="filter-table">
        <form class="form-inline">
            <div class="form-group" v-for="(filter, name) in getTableFilters">
                <filter-text v-if="filter.type === 'text'"
                             @input="handleFilterInput(arguments[0], name)"
                             @blur="doFilter"
                             :value="filter.value"
                             :values="filter.values"
                             :name="filter.name"
                             :label="filter.label"
                />
            </div>
            <div class="form-group">
                <button class="btn" @click.prevent="resetFilter">Reset</button>
            </div>
        </form>
    </div>
</template>

<script>
    import { mapState, mapGetters } from 'vuex'
    import FilterText from '@vue-components/utils/filters/FilterText'

    export default {
        name: "FilterTable",
        components: {
            'filter-text': FilterText
        },
        data () {
            return {

            }
        },
        methods: {
            doFilter () {
                this.$events.fire('filter-set')
            },
            resetFilter () {
                this.$events.fire('filter-reset')
            },
            handleFilterInput(value, filterName) {
                this.$emit('filterUpdate', {
                    value,
                    filterName,
                });
            },
        },
        computed: {
            ...mapGetters('complexReports', ['getTableFilters']),
        }
    }
</script>
