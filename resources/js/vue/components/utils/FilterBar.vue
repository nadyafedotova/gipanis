<template>
    <div class="filter-bar">
        <form class="form-inline">
            <div class="form-group" v-for="(filter, name) in filters">
                <filter-select v-if="filter.type === 'select'"
                               @input="handleFilterInput(arguments[0], name)"
                               @change="doFilter"
                               :value="filter.value"
                               :values="filter.values"
                               :name="filter.name"
                               :label="filter.label"
                />
                <filter-text v-if="filter.type === 'text'"
                             @input="handleFilterInput(arguments[0], name)"
                             @blur="doFilter"
                             :value="filter.value"
                             :values="filter.values"
                             :name="filter.name"
                             :label="filter.label"
                />
                <filter-checkbox v-if="filter.type === 'checkbox'"
                         @input="handleFilterInput(arguments[0], name)"
                               @change="doFilter"
                               :value="filter.value"
                               :values="filter.values"
                               :name="filter.name"
                               :label="filter.label"
                />
                <filter-radio v-if="filter.type === 'radio'"
                             @input="handleFilterInput(arguments[0], name)"
                             @change="doFilter"
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
    import { mapState } from 'vuex'
    import FilterSelect from './filters/FilterSelect.vue'
    import FilterText from './filters/FilterText.vue'
    import FilterCheckbox from './filters/FilterCheckbox.vue'
    import FilterRadio from './filters/FilterRadio.vue'

    export default {
        name: "FilterBar",
        components: {
            'filter-select': FilterSelect,
            'filter-text': FilterText,
            'filter-checkbox': FilterCheckbox,
            'filter-radio': FilterRadio
        },
        props: {
            filters: {
                type: Object,
                default: () => ({})
            }
        },
        data () {
            return {

            }
        },
        methods: {
            doFilter () {
                this.$events.fire('filter-set', this.filters)
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
        }
    }
</script>
