export default  {
    path: '/pengajuan-parent',
    component:()=>import('../views/index.vue'),
    meta:{auth:true},

    children: [
        {
            path: '',
            name: 'pengajuan-parent.index',
            component:()=>import('../views/pengajuan-parent/index.vue'),
        },
        {
            path:'create',
            name:'pengajuan-parent.create',
            component:()=>import('../views/pengajuan-parent/create.vue')
        },
    ]
}
