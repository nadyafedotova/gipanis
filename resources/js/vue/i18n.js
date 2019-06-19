import Vue from 'vue';
import VueI18n from 'vue-i18n';
import {langs} from './langs/i18n.js';
Vue.use(VueI18n);

const i18n = new VueI18n({
    locale: 'en',
    messages: langs
});

//$t in template to translate
export default i18n;


