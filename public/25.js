(window.webpackJsonp=window.webpackJsonp||[]).push([[25],{269:function(a,t,n){"use strict";n.r(t);var e=n(1),r=n.n(e);function s(a,t,n,e,r,s,i){try{var o=a[s](i),c=o.value}catch(a){return void n(a)}o.done?t(c):Promise.resolve(c).then(e,r)}var i,o,c={name:"lantai.create",mixins:[n(74).a],methods:{save:(i=r.a.mark((function a(){var t,n,e=this;return r.a.wrap((function(a){for(;;)switch(a.prev=a.next){case 0:return this.loading=!0,t="/"+(t=(t=window.location.pathname).split("/"))[1],(n=new FormData).append("lantai",this.lantai),n.append("ruangan",JSON.stringify(this.ruangans)),a.next=9,this.axios.post(t,n,this.config).then((function(a){console.log(a),e.setSnakbar({status:!0,pesan:a.data.message,color_snakbar:"success"}),e.$router.go(-1)})).catch((function(a){400==a.response.status?e.setSnakbar({color_snakbar:"red",status:!0,pesan:a.response.data.message}):e.setSnakbar({status:!0,color_snakbar:"red",pesan:"Terjadi Kesalahan"}),console.log(a.response)}));case 9:this.loading=!1;case 10:case"end":return a.stop()}}),a,this)})),o=function(){var a=this,t=arguments;return new Promise((function(n,e){var r=i.apply(a,t);function o(a){s(r,n,e,o,c,"next",a)}function c(a){s(r,n,e,o,c,"throw",a)}o(void 0)}))},function(){return o.apply(this,arguments)})}},l=n(2),u=Object(l.a)(c,(function(){var a=this,t=a.$createElement,n=a._self._c||t;return n("v-app",[n("v-container",[n("BtnJudul",{attrs:{text:"Tambah Data Lantai"}}),a._v(" "),n("v-card",{style:a.border,attrs:{tile:""}},[n("v-card-text",[n("v-container",[n("v-form",{ref:"form",attrs:{"lazy-validation":a.lazy},model:{value:a.valid,callback:function(t){a.valid=t},expression:"valid"}},[n("v-text-field",{attrs:{rules:a.nameRules,label:"Lantai",required:""},model:{value:a.lantai,callback:function(t){a.lantai=t},expression:"lantai"}}),a._v(" "),n("v-btn",{staticClass:"text-white",attrs:{tile:"",depressed:"",small:"",color:"success"},on:{click:function(t){return a.tambah_ruang()}}},[n("v-icon",{attrs:{dark:""}},[a._v("mdi-plus")]),a._v(" Tambah Ruangan\n                    ")],1),a._v(" "),a._l(a.ruangans,(function(t,e){return n("div",{key:e,staticClass:"ruangan",staticStyle:{position:"relative"}},[n("v-text-field",{attrs:{rules:a.nameRules,label:"Ruangan",required:""},model:{value:t.ruangan,callback:function(n){a.$set(t,"ruangan",n)},expression:"item.ruangan"}}),a._v(" "),a.ruangans.length>1?n("v-btn",{staticStyle:{position:"absolute",top:"0px",right:"0px",index:"1000"},attrs:{fab:"",dark:"","x-small":"",depressed:"",color:"red"},on:{click:function(t){return a.hapus_ruang(e)}}},[n("v-icon",{attrs:{dark:""}},[a._v("mdi-close")])],1):a._e()],1)})),a._v(" "),n("v-row",[n("v-col",{attrs:{cols:"12",align:"right"}},[n("v-btn",{attrs:{disabled:!a.valid,color:"success",tile:"",loading:a.loading},on:{click:function(t){return a.save()}}},[a._v("\n                            Simpan\n                            ")])],1)],1)],2)],1)],1),a._v(" "),n("v-card-actions",{})],1)],1)],1)}),[],!1,null,"182397e2",null);t.default=u.exports},74:function(a,t,n){"use strict";var e=n(0),r=n(7);function s(a,t){var n=Object.keys(a);if(Object.getOwnPropertySymbols){var e=Object.getOwnPropertySymbols(a);t&&(e=e.filter((function(t){return Object.getOwnPropertyDescriptor(a,t).enumerable}))),n.push.apply(n,e)}return n}function i(a,t,n){return t in a?Object.defineProperty(a,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):a[t]=n,a}t.a={data:function(){return{valid:!0,lazy:!1,loading:!1,lantai:"",ruangans:[{ruangan:""}],nameRules:[function(a){return!!a||"Tidak Boleh Kosong"}]}},methods:function(a){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?s(Object(n),!0).forEach((function(t){i(a,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(a,Object.getOwnPropertyDescriptors(n)):s(Object(n)).forEach((function(t){Object.defineProperty(a,t,Object.getOwnPropertyDescriptor(n,t))}))}return a}({},Object(e.b)({setSnakbar:"snakbar/setSnakbar"}),{tambah_ruang:function(){this.ruangans.push({ruangan:""})},hapus_ruang:function(a){this.ruangans.splice(a,1)}}),mixins:[r.a],created:function(){}}}}]);