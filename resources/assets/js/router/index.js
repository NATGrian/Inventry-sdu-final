import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from '../views/Auth/Login.vue'

import NotFound from '../views/NotFound.vue'

import profile from '../views/profile/Profile.vue'

import dashboard from '../views/dashboard/dashboard.vue'

import member from '../views/member/Member.vue'
import roles from '../views/member/Role.vue'

import people from '../views/people/People.vue'
import rolesp from '../views/people/Role.vue'
import storage from '../views/storage/Storage.vue'

import categoryingredients from '../views/ingredients/Categoryrm.vue'
import listingredients from '../views/ingredients/Listrm.vue'
import recordlistingredients from '../views/ingredients/Recordlistrm.vue'
import createingredients from '../views/ingredients/Createrm.vue'
import importingredients from '../views/ingredients/Importrm.vue'
import exportingredients from '../views/ingredients/Exportrm.vue'
import labellingingredients from '../views/ingredients/Labelling.vue'

import categorypackage from '../views/package/Categorypa.vue'
import listpackage from '../views/package/Listpa.vue'
import recordlistpackage from '../views/package/Recordlistpa.vue'
import createpackage from '../views/package/Createpa.vue'
import importpackage from '../views/package/Importpa.vue'
import exportpackage from '../views/package/Exportpa.vue'
import labellingpackage from '../views/package/Labellingpa.vue'

import categoryproduct from '../views/product/Categoryp.vue'
import listproduct from '../views/product/Listp.vue'
import recordlistproduct from '../views/product/Recordlistp.vue'
import createproduct from '../views/product/Createp.vue'
import importproduct from '../views/product/Importp.vue'
import exportproduct from '../views/product/Exportp.vue'

import report from '../views/reports/Report-select.vue'
import reportingredients from '../views/reports/Reportrm.vue'
import reportpackage from '../views/reports/Reportpa.vue'
import reportproduct from '../views/reports/Reportp.vue'

import ViewUI from 'view-design';
Vue.use(ViewUI);

Vue.use(VueRouter)

const router = new VueRouter({
	mode: 'history',
	routes: [
		{
			path: '/',
			component: dashboard,
			name: 'หน้าหลัก1',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | หน้าหลัก'
			}
		},

		{
			path: '/login',
			component: Login,
			name: 'ล็อกอิน',
			meta: {
				redirectIfLogged: true,
				title: 'ระบบคงคลังออนไลน์ | ล็อกอิน'
			}
		},
		{
			path: '/not-found',
			component: NotFound,
			meta: {
				title: 'ระบบคงคลังออนไลน์ | ไม่พบหน้านี้'
			}
		},
		{
			path: '*',
			component: NotFound,
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | ไม่พบหน้านี้'
			}
		},

		{
			path: '/dashboard',
			component: dashboard,
			name: 'หน้าหลัก',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | หน้าหลัก'
			}
		},

		{
			path: '/member',
			component: member,
			name: 'เจ้าหน้าที่ดูแลระบบ',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | เจ้าหน้าที่ดูแลระบบ'
			}
		},

		{
			path: '/member/roles',
			component: roles,
			name: 'ตำแหน่ง',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | ตำแหน่งสำหรับเจ้าหน้าที่ดูแลระบบ'
			}
		},

		{
			path: '/people',
			component: people,
			name: 'เจ้าหน้าที่ที่เกี่ยวข้อง',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | เจ้าหน้าที่ที่เกี่ยวข้อง'
			}
		},
		{
			path: '/people/roles',
			component: rolesp,
			name: 'ตำแหน่งเจ้าหน้าที่เกี่ยวข้อง',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | ตำแหน่งสำหรับเจ้าหน้าที่เกี่ยวข้อง'
			}
		},

		{
			path: '/storage',
			component: storage,
			name: 'สถานที่เก็บของ',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | สถานที่เก็บของ'
			}
		},

//*ddd

		{
			path: '/ingredients/category',
			component: categoryingredients,
			name: 'ประเภทของ วัตถุดิบ',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | ประเภทของ วัตถุดิบ'
			}
		},
		{
			path: '/ingredients/list',
			component: listingredients,
			name: 'รายการวัตถุดิบ',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | รายการวัตถุดิบ'
			}
		},
		{
			path: '/ingredients/recordlist',
			component: recordlistingredients,
			name: 'ภาพรวมการบันทึก นำเข้า - จ่ายออกวัตถุดิบ',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | ภาพรวมการบันทึก นำเข้า - จ่ายออกวัตถุดิบ'
			}
		},
		{
			path: '/ingredients/create',
			component: createingredients,
			name: 'สร้างวัตถุดิบ',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | สร้างวัตถุดิบ'
			}
		},
		{
			path: '/ingredients/import',
			component: importingredients,
			name: 'บันทึกการนำเข้า-วัตถุดิบ',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | บันทึกการนำเข้า-วัตถุดิบ'
			}
		},
		{
			path: '/ingredients/export',
			component: exportingredients,
			name: 'บันทึกการจ่ายออก-วัตถุดิบ',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | บันทึกการจ่ายออก-วัตถุดิบ'
			}
		},
		{
			path: '/ingredients/create-labelling',
			component: labellingingredients,
			name: 'สร้างฉลากวัตถุดิบ',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | สร้างฉลาก'
			}
		},

		{
			path: '/package/category',
			component: categorypackage,
			name: 'ประเภทของ บรรจุุภัณฑ์',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | ประเภทของ บรรจุุภัณฑ์'
			}
		},
		{
			path: '/package/list',
			component: listpackage,
			name: 'รายการบรรจุุภัณฑ์',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | รายการบรรจุุภัณฑ์'
			}
		},
		{
			path: '/package/recordlist',
			component: recordlistpackage,
			name: 'ภาพรวมการบันทึก นำเข้า - จ่ายออกบรรจุุภัณฑ์',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | ภาพรวมการบันทึก นำเข้า - จ่ายออก'
			}
		},
		{
			path: '/package/create',
			component: createpackage,
			name: 'สร้างบรรจุุภัณฑ์',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | สร้างบรรจุุภัณฑ์'
			}
		},
		{
			path: '/package/import',
			component: importpackage,
			name: 'บันทึกการนำเข้า-บรรจุุภัณฑ์',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | บันทึกการนำเข้า-บรรจุุภัณฑ์'
			}
		},
		{
			path: '/package/export',
			component: exportpackage,
			name: 'บันทึกการจ่ายออก-บรรจุุภัณฑ์',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | บันทึกการจ่ายออก-บรรจุุภัณฑ์'
			}
		},
		{
			path: '/package/create-labelling',
			component: labellingpackage,
			name: 'สร้างฉลากบรรจุุภัณฑ์',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | สร้างฉลาก'
			}
		},

		// *d 
		{
			path: '/product/category',
			component: categoryproduct,
			name: 'ประเภทของ ผลิตภัณฑ์',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | ประเภทของ ผลิตภัณฑ์'
			}
		},
		{
			path: '/product/list',
			component: listproduct,
			name: 'รายการผลิตภัณฑ์',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | รายการผลิตภัณฑ์'
			}
		},
		{
			path: '/product/recordlist',
			component: recordlistproduct,
			name: 'ภาพรวมการบันทึก นำเข้า - จ่ายออก(ผลิตภัณฑ์)',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | ภาพรวมการบันทึก นำเข้า - จ่ายออก'
			}
		},
		{
			path: '/product/create',
			component: createproduct,
			name: 'สร้างผลิตภัณฑ์',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | สร้างผลิตภัณฑ์'
			}
		},
		{
			path: '/product/import',
			component: importproduct,
			name: ' บันทึกการนำเข้า-ผลิตภัณฑ์',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ |  บันทึกการนำเข้า-ผลิตภัณฑ์'
			}
		},
		{
			path: '/product/export',
			component: exportproduct,
			name: 'บันทึกการจ่ายออก-ผลิตภัณฑ์',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | บันทึกการจ่ายออก-ผลิตภัณฑ์'
			}
		},

		{
			path: '/report',
			component: report,
			name: 'สต็อกการ์ด',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | สต็อกการ์ด'
			}
		},

		{
			path: '/report/ingredients',
			component: reportingredients,
			name: 'สต็อกการ์ด-วัตถุดิบ',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | สต็อกการ์ด-วัตถุดิบ'
			}
		},
		{
			path: '/report/package',
			component: reportpackage,
			name: 'สต็อกการ์ด-บรรจุภัณฑ์',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | สต็อกการ์ด-บรรจุภัณฑ์'
			}
		},
		{
			path: '/report/products',
			component: reportproduct,
			name: 'สต็อกการ์ด-ผลิตภัณฑ์',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | สต็อกการ์ด-ผลิตภัณฑ์'
			}
		},

		{
			path: '/profile/:id',
			component: profile,
			name: 'โปรไฟล์ส่วนตัว',
			meta: {
				requiresAuth: true,
				title: 'ระบบคงคลังออนไลน์ | โปรไฟล์ส่วนตัว'
			}
		},

	]
})

router.beforeEach((to, from, next) => {
	ViewUI.LoadingBar.start();
	document.title = to.meta.title
	if (to.matched.some(record => record.meta.requiresAuth)) {
		if (localStorage.getItem('api_token') === null) {
			next({
				path: '/login'
			})
		} else {
			next()
		}
	} else if (to.matched.some(record => record.meta.redirectIfLogged)) {
		if (localStorage.getItem('authenticated')) {
			next({
				path: '/dashboard'
			})
		} else {
			next()
		}
	} else {
		next()
	}
})
router.afterEach(route => {
	ViewUI.LoadingBar.finish();
});
export default router