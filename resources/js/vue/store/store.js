
import Vue from 'vue'
import Vuex from 'vuex'
import moduleSimpleReports from './module_simple_reports'
import moduleComplexReports from './module_complex_reports'

Vue.use(Vuex)


export default new Vuex.Store({
    modules: {
        simpleReports: moduleSimpleReports,
        complexReports: moduleComplexReports
    }
})