import axios from 'axios'

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
axios.defaults.headers.common['Accept'] = 'application/json';
axios.defaults.headers.common['Authorization'] = `Bearer ${window.token}`;
export function get(url, payload) {
    return axios({
        method: 'GET',
        url: '/api/'+url,
        ...payload,
    })
}
export function download(url, payload) {
    return axios({
        method: 'GET',
        url: '/api/'+url,
        responseType: 'blob',
        data: payload,
    })
}
/**
 * Create
 * @param url
 * @param payload
 * @returns {AxiosPromise}
 */
export function post(url, payload) {
    return axios({
        method: 'POST',
        url: '/api/'+url,
        data: payload,

    })
}
/**
 * Update
 * @param url
 * @param payload
 * @returns {AxiosPromise}
 */
export function patch(url, payload) {
    return axios({
        method: 'PATCH',
        url: '/api/'+url,
        data: payload,

    })
}
/**
 * Delete
 * @param url
 * @returns {AxiosPromise}
 */
export function del(url) {
    return axios({
        method: 'DELETE',
        url: '/api/'+url,

    })
}

export function interceptors(cbs,cbe) {
    axios.interceptors.response.use((res) => {
        window.pageData.title = res.data.title;
        window.pageData.iconClass = res.data.icon;
        cbs(res)
        return Promise.resolve(res);
    }, (err) => {
        cbe(err)
        return Promise.reject(err)
    })
}

