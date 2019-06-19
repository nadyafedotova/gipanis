import Vue from 'vue'
import {get,post,patch,del} from '../helpers/api.js'
import { DEFAULT_STORE_ID } from '../data/constants';
import { buildFiltersParams } from '../helpers/filtersQuery.js';
import cloneObject from '../helpers/cloneObject';

// Vue.use(Vuex)
let defaultFilters = {};

export default {
    namespaced: true,
    state: {
        mode: 'datatable',
        fields: [],
        filters: {},
        data: {},
        stores: {},
        defaultStoreId: DEFAULT_STORE_ID,
    },

    getters: {
        getFiltersQuery: state => {
            return buildFiltersParams(state.filters)
        }
    },
    actions: {
        loadData ({state, commit, getters}, params){
            const { uri, ...httpOptions } = params;

            var filtersParams = getters.getFiltersQuery;

            let paramsObject = {
                ...httpOptions.params,
                ... filtersParams,
            }
            return get(uri, {
                params: paramsObject
            }).then((res) => {
                return res;
            });
        },
        loadFieldsTableList ({commit}, uri) {
            return get(`${uri}/fields`)
                .then(r => r.data)
                .then(data => {
                    commit('SET_FIELDS', data.fields)
                    return data.fields;
                }).catch((err) => {
                    console.error(err);
                    return err;
                });
        },
        loadStores ({commit}) {
            return get('stores')
                .then(r =>  r.data)
                .then(data => {
                    commit('SET_STORES', data);
                    return data;
                }).catch((err) => {
                    console.error(err);
                    return err;
                });
        },
        loadFilters ({commit}, uri)  {
            return get(`filters/${uri}`)
                .then(r =>  r.data)
                .then(data => {
                    defaultFilters = cloneObject(data.filters);
                    commit('SET_FILTERS', data.filters);
                    return data;
                }).catch((err) => {
                    console.error(err);
                    return err;
                });
        },
        resetFilterValues ({commit}) {
            commit('RESET_FILTER_VALUES');
        },
        updateFilterValue ({state, commit}, params) {
            if (params && params instanceof Object && params.filterName && state.filters[params.filterName]) {
                commit('UPDATE_FILTER_VALUE', params);
            }
        },
    },
    mutations: {
        SET_FIELDS (state, fields) {
            state.fields = fields
        },
        SET_STORES (state, data) {
            state.stores = data.stores
        },
        SET_FILTERS (state, filters) {
            state.filters = filters
        },
        UPDATE_FILTER_VALUE(state, params) {
            state.filters[params.filterName].value = params.value;
        },
        RESET_FILTER_VALUES(state) {
            state.filters = Object.assign({} , defaultFilters);
        }
    },

}
