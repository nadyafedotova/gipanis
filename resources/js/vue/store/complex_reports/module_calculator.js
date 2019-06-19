import Vue from 'vue'
import {get,post,download} from '../../helpers/api.js'
import { mapGetters } from 'vuex';

export default {
    namespaced: true,

    state: {
        templateFile: null,
        uri: 'amz/calculator',
        table: {
            fields: {
                'base': {},
                'attributes': {},
                'custom_attributes': {},
                'merkal': {},
            },
            data: {},
        },
        exportFilters: {
            send_to_amazon: 1,
            without_in: 1,
            ama_logik: 1,
            hide: 1
        }
    },

    mutations: {
        SET_TABLE_FIELDS(state, payload) {
            state.table.fields = payload
        },

        SET_TABLE_DATA(state, payload) {
            state.table.data = payload
        }
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

        getExportFields: state => {

            return state.exportFilters;

        }
    },

    actions: {
        loadData({commit, state}) {
            return get(`${state.uri}`)
                .then(r => r.data)
                .then(data => {
                    commit('SET_TABLE_FIELDS', data.fields);
                    commit('SET_TABLE_DATA', data.data);
                    return data;
                }).catch((err) => {
                    console.error(err);
                    return err;
                });
        },
    }
}