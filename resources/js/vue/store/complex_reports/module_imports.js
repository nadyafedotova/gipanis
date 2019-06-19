import {get,post,download} from '../../helpers/api.js'

export default {
    namespaced: true,
    state: {
        templateFile: null,
        uri: 'amz/import'

    },
    mutations: {
        SET_TEMPLATE_FILE (state, templateFile) {
            state.templateFile = templateFile
        }
    },

    getters: {
        getTemplateFileName: (state, getters) => {
            if(!getters.hasTemplateFile) {
                return ;
            }
            return `${state.templateFile.name}(uploaded ${state.templateFile.lastModifiedDate})`;
        },

        hasTemplateFile: state => {
            return (state.templateFile !== null && state.templateFile.name !== undefined) ? true : false;
        }

    },

    actions: {
        doCreate({state}){
            return download(`${state.uri}/download-products`)
                .then((response) => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'x04.xlsx'); //or any other extension
                    document.body.appendChild(link);
                    link.click();
                });
        },

        doStore({commit, state}, file) {
            var formData = new FormData();
            formData.append("template_file", file);

            return post(`${state.uri}/store-template`, formData)
                .then(r => r.data)
                .then(data => {
                    commit('SET_TEMPLATE_FILE', file);
                    return data;
                }).catch((err) => {
                    console.error(err);
                    return err;
                });
        },

        getTemplate({commit, state}) {
            return get(`${state.uri}/template-file`)
                .then(r => r.data)
                .then(data => {
                    commit('SET_TEMPLATE_FILE', data);
                    return data;
                }).catch((err) => {
                    console.error(err);
                    return err;
                });
        },

        loadData({commit, state, rootGetters}, page) {
            let filters = rootGetters['complexReports/getFiltersQuery']
            console.log('filters',filters);
            const params = {
                params: {
                    page: page,
                    ...filters
                },
            };

            return get(`${state.uri}`, params)
                .then(r => r.data)
                .then(data => {
                    commit('complexReports/SET_TABLE_FIELDS', data.fields, {root:true});
                    commit('complexReports/SET_TABLE_DATA', data.data, {root:true});
                    commit('complexReports/SET_PAGINATE', data.data, {root:true});
                    commit('complexReports/SET_TABLE_FILTERS', data.filters, {root:true});
                    return data;
                }).catch((err) => {
                    console.error(err);
                    return err;
                });
        },

        updateFilterValue ({state, commit}, params) {
            if (params && params instanceof Object ) {
                commit('complexReports/UPDATE_FILTER_VALUE', params, {root:true});
            }
        },
    }
}