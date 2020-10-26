export default  {
    path: '/barang',
    component:()=>import('../views/index.vue'),
    meta:{auth:true},

    children: [
        {
            path: '',
            name: 'barang.index',
            component:()=>import('../views/barang/index.vue'),
        },
        {
            path:'create',
            name:'barang.create',
            component:()=>import('../views/barang/create.vue')
        },
        {
            path:':id/edit',
            name:'barang.edit',
            component:()=>import('../views/barang/edit.vue')
        },
    ]
}
