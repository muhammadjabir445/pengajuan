(window.webpackJsonp=window.webpackJsonp||[]).push([[21],{233:function(a,n,t){"use strict";var e=t(72);t.n(e).a},234:function(a,n,t){(a.exports=t(11)(!1)).push([a.i,"\n.sembunyi[data-v-823c0834] {\n    display: none;\n}\n.tampil[data-v-823c0834] {\n    display: block;\n}\n.list-barang[data-v-823c0834]{\n    background-color:white;\n    position:relative;\n    left:0px;\n    bottom:30px;\n    width:100%;\n    -webkit-box-shadow: 4px 6px 5px -4px rgba(0,0,0,0.75);\n    -moz-box-shadow: 4px 6px 5px -4px rgba(0,0,0,0.75);\n    box-shadow: 4px 6px 5px -4px rgba(0,0,0,0.75);\n    z-index: 100;\n}\n.list-barang ul li[data-v-823c0834] {\n\n    padding-top: 15px;\n    padding-bottom: 15px;\n    padding-left: 10px;\n}\n.list-barang ul[data-v-823c0834] {\n    list-style: none;\n    padding: 0px;\n}\n.list-barang ul li[data-v-823c0834]:hover {\n    cursor:pointer;\n     background-color:rgb(233, 233, 233);\n}\n",""])},265:function(a,n,t){"use strict";t.r(n);var e=t(1),r=t.n(e);function i(a,n,t,e,r,i,o){try{var s=a[i](o),l=s.value}catch(a){return void t(a)}s.done?n(l):Promise.resolve(l).then(e,r)}function o(a){return function(){var n=this,t=arguments;return new Promise((function(e,r){var o=a.apply(n,t);function s(a){i(o,e,r,s,l,"next",a)}function l(a){i(o,e,r,s,l,"throw",a)}s(void 0)}))}}var s,l,u={name:"masterdata.edit",data:function(){return{data_barang:[]}},mixins:[t(71).a],methods:{save:(l=o(r.a.mark((function a(){var n,t,e=this;return r.a.wrap((function(a){for(;;)switch(a.prev=a.next){case 0:return this.loading=!0,n="/"+(n=(n=window.location.pathname).split("/"))[1],(t=new FormData).append("barang",this.barang),t.append("total",this.total),t.append("tujuan_pengadaan",this.tujuan_pengadaan),t.append("keterangan",this.keterangan),t.append("tempat_pembelian",this.tempat_pembelian),t.append("perkiraan_harga",this.perkiraan_harga),t.append("id_parent",this.$route.params.id_parent),a.next=14,this.axios.post(n,t,this.config).then((function(a){console.log(a),e.setSnakbar({status:!0,pesan:a.data.message,color_snakbar:"success"}),e.$router.go(-1)})).catch((function(a){400==a.response.status?e.setSnakbar({color_snakbar:"red",status:!0,pesan:a.response.data.message}):e.setSnakbar({status:!0,color_snakbar:"red",pesan:"Terjadi Kesalahan"}),console.log(a.response)}));case 14:this.loading=!1;case 15:case"end":return a.stop()}}),a,this)}))),function(){return l.apply(this,arguments)}),get_barang:(s=o(r.a.mark((function a(){var n=this;return r.a.wrap((function(a){for(;;)switch(a.prev=a.next){case 0:this.axios.get("pengajuan/create?keyword="+this.barang,this.config).then((function(a){a.data.barang.length>0?n.data_barang=a.data.barang:n.data_barang=[]})).catch((function(a){console.log(a.response)}));case 1:case"end":return a.stop()}}),a,this)}))),function(){return s.apply(this,arguments)}),select_barang:function(a){this.barang=a,this.data_barang=[]}}},c=(t(233),t(2)),p=Object(c.a)(u,(function(){var a=this,n=a.$createElement,t=a._self._c||n;return t("v-app",[t("v-container",[t("BtnJudul",{attrs:{text:"Tambah Pengajuan Barang"}}),a._v(" "),t("v-card",{style:a.border,attrs:{tile:""}},[t("v-card-text",[t("v-container",[t("v-form",{ref:"form",attrs:{"lazy-validation":a.lazy},model:{value:a.valid,callback:function(n){a.valid=n},expression:"valid"}},[t("div",{staticStyle:{position:"relative",width:"100%"}},[t("v-text-field",{staticStyle:{position:"relative"},attrs:{outlined:"",rules:a.nameRules,label:"Nama barang",required:""},on:{keyup:a.get_barang},model:{value:a.barang,callback:function(n){a.barang=n},expression:"barang"}}),a._v(" "),a.data_barang.length>0?t("div",{staticClass:"list-barang"},[t("ul",a._l(a.data_barang,(function(n){return t("li",{key:n.id,on:{click:function(t){return a.select_barang(n.nama)}}},[a._v(a._s(n.nama))])})),0)]):a._e()],1),a._v(" "),t("v-text-field",{attrs:{outlined:"",rules:a.perkiraanRules,label:"Perkiraan Harga",required:""},model:{value:a.harga,callback:function(n){a.harga=n},expression:"harga"}}),a._v(" "),t("v-text-field",{attrs:{outlined:"",rules:[a.numberRule],label:"Total",required:""},model:{value:a.total,callback:function(n){a.total=n},expression:"total"}}),a._v(" "),t("v-textarea",{attrs:{outlined:"",rules:a.nameRules,label:"Tujuan Pengadaan"},model:{value:a.tujuan_pengadaan,callback:function(n){a.tujuan_pengadaan=n},expression:"tujuan_pengadaan"}}),a._v(" "),t("v-textarea",{attrs:{outlined:"",rules:a.nameRules,label:"Keterangan"},model:{value:a.keterangan,callback:function(n){a.keterangan=n},expression:"keterangan"}}),a._v(" "),t("v-text-field",{attrs:{outlined:"",label:"tempat_pembelian",required:""},model:{value:a.tempat_pembelian,callback:function(n){a.tempat_pembelian=n},expression:"tempat_pembelian"}}),a._v(" "),t("v-row",[t("v-col",{attrs:{cols:"12",align:"right"}},[t("v-btn",{attrs:{disabled:!a.valid,color:"success",tile:"",loading:a.loading},on:{click:function(n){return a.save()}}},[a._v("\n                            Simpan\n                            ")])],1)],1)],1)],1)],1),a._v(" "),t("v-card-actions",{})],1)],1)],1)}),[],!1,null,"823c0834",null);n.default=p.exports},71:function(a,n,t){"use strict";var e=t(0),r=t(7);function i(a,n){var t=Object.keys(a);if(Object.getOwnPropertySymbols){var e=Object.getOwnPropertySymbols(a);n&&(e=e.filter((function(n){return Object.getOwnPropertyDescriptor(a,n).enumerable}))),t.push.apply(t,e)}return t}function o(a,n,t){return n in a?Object.defineProperty(a,n,{value:t,enumerable:!0,configurable:!0,writable:!0}):a[n]=t,a}n.a={data:function(){return{valid:!0,lazy:!1,loading:!1,barang:"",perkiraan_harga:0,total:"",tujuan_pengadaan:"",tempat_pembelian:"",keterangan:"",nameRules:[function(a){return!!a||"Tidak Boleh Kosong"}],perkiraanRules:[function(a){return!!a||"Harus diisi"},function(a){return/^[0-9,]+$/.test(a)||"Format salah"},function(a){return a.split(",").join("")<=1e8||"Tidak boleh lebih dari 100 juta"}],numberRule:function(a){return 0==!a||(!isNaN(parseFloat(a))&&a>=0&&a<=999||"Number has to be between 0 and 999")}}},methods:function(a){for(var n=1;n<arguments.length;n++){var t=null!=arguments[n]?arguments[n]:{};n%2?i(Object(t),!0).forEach((function(n){o(a,n,t[n])})):Object.getOwnPropertyDescriptors?Object.defineProperties(a,Object.getOwnPropertyDescriptors(t)):i(Object(t)).forEach((function(n){Object.defineProperty(a,n,Object.getOwnPropertyDescriptor(t,n))}))}return a}({},Object(e.b)({setSnakbar:"snakbar/setSnakbar"}),{formatAsCurrency:function(a,n){return n=n||0,null===a?null:""+a.toFixed(n).replace(/(\d)(?=(\d\d\d)+(?!\d))/g,"$1,")}}),mixins:[r.a],computed:{harga:{get:function(){return this.formatAsCurrency(this.perkiraan_harga,0)},set:function(a){this.perkiraan_harga=Number(a.replace(/[^0-9\.]/g,""))}}},created:function(){}}},72:function(a,n,t){var e=t(234);"string"==typeof e&&(e=[[a.i,e,""]]);var r={hmr:!0,transform:void 0,insertInto:void 0};t(12)(e,r);e.locals&&(a.exports=e.locals)}}]);