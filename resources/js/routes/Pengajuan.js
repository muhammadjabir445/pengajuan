export default  {
    path: '/pengajuan',
    component:()=>import('../views/index.vue'),
    meta:{auth:true},

    children: [
        {
            path: '',
            redirect: {
              name: 'pengajuan-parent.index'
            }
          },
        {
            path: ':id_parent',
            name: 'pengajuan.index',
            component:()=>import('../views/pengajuan/index.vue'),
        },
        {
            path:':id_parent/create',
            name:'pengajuan.create',
            component:()=>import('../views/pengajuan/create.vue')
        },
        {
            path:':id_parent/:id/edit',
            name:'pengajuan.edit',
            component:()=>import('../views/pengajuan/edit.vue')
        },
    ]
}
