import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from '../views/Auth/Login.vue'
// import Register from '../views/Auth/Register.vue'
import RecipeIndex from '../views/Recipe/Index.vue'
import RecipeShow from '../views/Recipe/Show.vue'
import RecipeForm from '../views/Recipe/Form.vue'
import NotFound from '../views/NotFound.vue'

import profile from '../views/profile/Profile.vue'

import dashboard from '../views/dashboard/dashboard.vue'

import member from '../views/member/Member.vue'
import roles from '../views/member/Role.vue'

import people from '../views/people/People.vue'
import storage from '../views/storage/Storage.vue'

import categoryingredients from '../views/ingredients/Categoryrm.vue'
import listingredients from '../views/ingredients/Listrm.vue'
import recordlistingredients from '../views/ingredients/Recordlistrm.vue'
import createingredients from '../views/ingredients/Createrm.vue'
import importingredients from '../views/ingredients/Importrm.vue'
import exportingredients from '../views/ingredients/Exportrm.vue'
import labellingingredients from '../views/ingredients/Labelling.vue'

import categoryproduct from '../views/product/Categoryp.vue'
import listproduct from '../views/product/Listp.vue'
import recordlistproduct from '../views/product/Recordlistp.vue'
import createproduct from '../views/product/Createp.vue'
import importproduct from '../views/product/Importp.vue'
import exportproduct from '../views/product/Exportp.vue'

import report from '../views/reports/Report-select.vue'
import reportingredients from '../views/reports/Reportrm.vue'
import reportproduct from '../views/reports/Reportp.vue'

import ViewUI from 'view-design';
Vue.use(ViewUI);

Vue.use(VueRouter)

const router = new VueRouter({
	mode: 'history',
	routes: [
		{ path: '/recipes', component: RecipeIndex, meta: { requiresAuth: true } },
		{ path: '/', component: dashboard, meta: { requiresAuth: true } },
		{ path: '/recipes/create', component: RecipeForm, meta: { mode: 'create' ,requiresAuth: true}},
		{ path: '/recipes/:id/edit', component: RecipeForm, meta: { mode: 'edit' ,requiresAuth: true}},
		{ path: '/recipes/:id', component: RecipeShow },
		// { path: '/register', component: Register },
		{ path: '/login', component: Login },
		{ path: '/not-found', component: NotFound },
		{ path: '*', component: NotFound },

		{
			path: '/dashboard',
			component: dashboard,
			name: 'dashboard',
			meta: { requiresAuth: true }
		},

		{
			path: '/member',
			component: member,
			name: 'member',
			meta: { requiresAuth: true }
		},
		// {
		// 	path: '/member/create',
		// 	component: member,
		// 	name: 'member'
		// },
		{
			path: '/member/roles',
			component: roles,
			name: 'role',
			meta: { requiresAuth: true }
		},

		{
			path: '/people',
			component: people,
			name: 'people',
			meta: { requiresAuth: true }
		},
		// {
		// 	path: '/people/create',
		// 	component: people,
		// 	name: 'people'
		// },
		{
			path: '/storage',
			component: storage,
			name: 'storage',
			meta: { requiresAuth: true }
		},
		// {
		// 	path: '/storage/create',
		// 	component: storage,
		// 	name: 'storage'
		// },

		{
			path: '/ingredients/category',
			component: categoryingredients,
			name: 'categoryingredients',
			meta: { requiresAuth: true }
		},
		{
			path: '/ingredients/list',
			component: listingredients,
			name: 'listingredients',
			meta: { requiresAuth: true }
		},
		{
			path: '/ingredients/recordlist',
			component: recordlistingredients,
			name: 'recordlistingredients',
			meta: { requiresAuth: true }
		},
		{
			path: '/ingredients/create',
			component: createingredients,
			name: 'createingredients',
			meta: { requiresAuth: true }
		},
		{
			path: '/ingredients/import',
			component: importingredients,
			name: 'importingredients',
			meta: { requiresAuth: true }
		},
		{
			path: '/ingredients/export',
			component: exportingredients,
			name: 'exportingredients',
			meta: { requiresAuth: true }
		},
		{
			path: '/ingredients/create-labelling',
			component: labellingingredients,
			name: 'labellingingredients',
			meta: { requiresAuth: true }
		},

		// *d 
		{
			path: '/product/category',
			component: categoryproduct,
			name: 'categoryProduct',
			meta: { requiresAuth: true }
		},
		{
			path: '/product/list',
			component: listproduct,
			name: 'listProduct',
			meta: { requiresAuth: true }
		},
		{
			path: '/product/recordlist',
			component: recordlistproduct,
			name: 'recordlistProduct',
			meta: { requiresAuth: true }
		},
		{
			path: '/product/create',
			component: createproduct,
			name: 'createProduct',
			meta: { requiresAuth: true }
		},
		{
			path: '/product/import',
			component: importproduct,
			name: 'importProduct',
			meta: { requiresAuth: true }
		},
		{
			path: '/product/export',
			component: exportproduct,
			name: 'exportProduct',
			meta: { requiresAuth: true }
		},

		{
			path: '/report',
			component: report,
			name: 'report',
			meta: { requiresAuth: true }
		},

		{
			path: '/report/ingredients',
			component: reportingredients,
			name: 'reportingredients',
			meta: { requiresAuth: true }
		},
		{
			path: '/report/products',
			component: reportproduct,
			name: 'reportproduct',
			meta: { requiresAuth: true }
		},

		{
			path: '/profile/:id',
			component: profile,
			name: 'profile',
			meta: { requiresAuth: true }
		},
		
	]
})
router.beforeEach((to, from, next) => {
	ViewUI.LoadingBar.start();
	if (to.matched.some(record => record.meta.requiresAuth)) {
			// this route requires auth, check if logged in
			// if not, redirect to login page.
			
			if (localStorage.getItem('api_token') === null) {
				ViewUI.LoadingBar.finish();

					next({ path: '/login' })
			} else {
				ViewUI.LoadingBar.finish();

					next() // go to wherever I'm going
			}
	} else {
			next() // does not require auth, make sure to always call next()!
	}
})
router.afterEach(route => {
	ViewUI.LoadingBar.finish();
});
	export default router
