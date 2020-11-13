export default  {
    path: '/inventori',
    component:()=>import('../views/index.vue'),
    meta:{auth:true},

    children: [
        {
            path: '',
            name: 'inventori.index',
            component:()=>import('../views/inventori/index.vue'),
        },
        {
            path:'create',
            name:'inventori.create',
            component:()=>import('../views/inventori/create.vue')
        },
        {
            path:':id/edit',
            name:'inventori.edit',
            component:()=>import('../views/inventori/edit.vue')
        },
    ]
}
