
import moduleAmzImport from './complex_reports/module_imports'
import moduleAmzCalculator from './complex_reports/module_calculator'
import moduleAmzBuyerInfo from './complex_reports/module_buyer_info'

import  {buildFiltersParams}  from '../helpers/filtersQuery.js';
import cloneObject from '../helpers/cloneObject';

let defaultFilters = {};

export default {
    namespaced: true,
    modules: {
        amzImport: moduleAmzImport,
        amzCalculator: moduleAmzCalculator,
        amzBuyerInfo: moduleAmzBuyerInfo
    },
    state: {
        table: {
            fields: {
                'base': {},
                'attributes': {},
                'custom_attributes': {},
                'merkal': {},
            },
            data: {},
            filters: {},
        },

        paginate: {},
    },

    getters: {
        getTableFields: state => {
            return state.table.fields;
        },

        getTableFieldsByBlock: state => block => {
            return state.table.fields[block];
        },

        getTableFieldsLengthByBlock: state => block => {

            return Object.keys(state.table.fields[block]).length;
        },

        getTableData: state => {
            return state.table.data.data;
        },

        getTableFilters: state => {
            return (state.table.filters)
        },

        getFiltersQuery: state => {
            return buildFiltersParams(state.table.filters)
        },

        getPagination: (state) => {
            return state.paginate;
        }
    },

    mutations: {

        SET_TABLE_FIELDS(state, payload) {
            state.table.fields = payload
        },

        SET_TABLE_DATA(state, payload) {
            state.table.data = payload
        },

        SET_TABLE_FILTERS (state, filters) {
            defaultFilters = cloneObject(filters);
            state.table.filters = filters
        },

        UPDATE_FILTER_VALUE(state, payload) {
            if(state.table.filters[payload.filterName])  {
                state.table.filters[payload.filterName].value = payload.value;
            }
        },

        SET_PAGINATE(state, payload) {
                state.paginate = payload
        },

        RESET_FILTER_VALUES(state) {
            state.table.filters = cloneObject(defaultFilters);
        }

    },

    actions: {
        resetFilterValues ({commit}) {
            commit('RESET_FILTER_VALUES');
        },
    }
}