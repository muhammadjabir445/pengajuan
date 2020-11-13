export default  {
    path: '/lantai',
    component:()=>import('../views/index.vue'),
    meta:{auth:true},

    children: [
        {
            path: '',
            name: 'lantai.index',
            component:()=>import('../views/lantai/index.vue'),
        },
        {
            path:'create',
            name:'lantai.create',
            component:()=>import('../views/lantai/create.vue')
        },
        {
            path:':id/edit',
            name:'lantai.edit',
            component:()=>import('../views/lantai/edit.vue')
        },
    ]
}
