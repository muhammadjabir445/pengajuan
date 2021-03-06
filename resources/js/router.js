import Vue from 'vue'
import Router from 'vue-router'
import store from './stores'
import axios from 'axios'

import UserRouter from './routes/users'
import MasterDataRouter from './routes/Masterdata'
import MenuRouter from './routes/Menu'
import RoleManagementRouter from './routes/RoleManagement'
import BarangRouter from './routes/Barang'
import PengajuanRouter from './routes/Pengajuan'
import PengajuanParentRouter from './routes/ParentPengajuan'
import LantaiRouter from './routes/Lantai'
import PembelianRouter from './routes/Pembelian'
import InventoriRouter from './routes/Inventori'
// import Vuetify from 'vuetify'
// Vue.use(Vuetify)
import './plugins/vuetify.js'
Vue.use(Router)
const router = new Router({
  mode: 'history',
  routes: [
    {
        path:'',
        name:'index',
        component:()=>import('./views/index.vue'),
        children:[
            {
                path: '/',
                redirect: {
                  name: 'login'
                }
            },
            {
                path: '/dahsboard',
                name: 'dashboard',
                component:()=>import('./views/dahsboard/index.vue'),
                meta:{auth:true}

            },


            UserRouter,
            MasterDataRouter,
            MenuRouter,
            RoleManagementRouter,
            BarangRouter,
            PengajuanRouter,
            PengajuanParentRouter,
            LantaiRouter,
            PembelianRouter,
            InventoriRouter,
            {
                path: '/color',
                name: 'color',
                component:()=>import('./views/setting/color.vue'),
                meta:{auth:true}

            },
        ]

    },

    {
        path: '/login',
        name: 'login',
        component:()=>import('./views/Login.vue')
    },
    {
        path: '/404',
        name: 'notfound',
    },

    {
      path: '*',
      redirect: {
        name: 'notfound'
      }
    },

  ]
})



router.beforeEach(async (to,from,next) => {
    if( to.name != 'login') store.dispatch('BeforeUrl/setUrl',to.path)
    if (to.matched.some(record => record.meta.auth)) {

        if (store.getters['auth/user']) {
            next()
        }else{
            next('/login')
        }
    }else if(to.name == 'login'){
        if (!store.getters['auth/user']) {
            next()
        }else{
            router.push(store.getters['BeforeUrl/url'])

        }
    }else{
        next()
    }
})
// router.beforeEach((to,from,next) =>{
//     if(to.matched.some(record => record.meta.auth)){
//         //cek jika ada users maka kehalaman yg di tuju
//         if (store.getters['auth/user']) {
//             next()
//         }else{
//             next('/login')
//         }
//     }else if(to.name == 'login'){
//         //cek jika tidak ada users maka kehalaman login
//         if (!store.getters['auth/user']) {
//             next()
//         }else{

//             next('/dashboard')
//         }
//     }
//     else{
//         next()
//     }
// })
export default router
