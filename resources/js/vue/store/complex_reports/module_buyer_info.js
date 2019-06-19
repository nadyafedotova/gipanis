
import Vue from 'vue'
import {get,post,download} from '../../helpers/api.js'
import { mapGetters } from 'vuex';

export default {
    namespaced: true,

    state: {
        templateFile: null,
        uri: 'amz/buyerinfo',
        table: {
            fields: {
                'base': {},
                'attributes': {},
                'custom_attributes': {},
                'merkal': {},
            },
            data: {},
        }
    },

    mutations: {

        SET_TABLE_DATA(state, payload) {
            state.table.data = payload
        }

    },

    getters: {

        getModuleBuyerInfo: state => {
            return state.table.data.data;
        }
    },

    actions: {

        loadData({commit, state}, page) {
            const params = {
                params: {
                    page:page
                },
            };
            return get(`${state.uri}`, params)
                .then(r => r.data)
                .then(data => {

                    commit('SET_TABLE_DATA', data);
                    return data;
                }).catch((err) => {
                    console.error(err);
                    return err;
                });
        },
    }
}