export default  {
    path: '/pembelian',
    component:()=>import('../views/index.vue'),
    meta:{auth:true},

    children: [
        {
            path: '',
            name: 'pembelian.index',
            component:()=>import('../views/pembelian/index.vue'),
        },
        {
            path:':id/detail',
            name:'pembelian.detail',
            component:()=>import('../views/pembelian/detail.vue')
        },
        {
            path:':id/detail/:id_detail/edit',
            name:'pembelian.edit',
            component:()=>import('../views/pembelian/edit.vue')
        },
    ]
}
