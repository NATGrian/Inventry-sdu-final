import Vue from 'vue'
import store from './store/index'
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
import TH from 'view-design/dist/locale/th-TH';
import VueI18n from 'vue-i18n';
import App from './App.vue'
import router from './router'
Vue.use(VueI18n);
Vue.use(ViewUI);

Vue.locale = () => {};

const messages = {
	TH: Object.assign({ message: 'hello' }, TH),
};


const i18n = new VueI18n({
    locale: 'TH',  
    messages  
});

const app = new Vue({
	el: '#root',
	template: `<app></app>`,
	components: { App },
	router,
	store,
	i18n
})
