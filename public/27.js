(window.webpackJsonp=window.webpackJsonp||[]).push([[27],{266:function(a,e,n){"use strict";n.r(e);var t=n(1),r=n.n(t);function i(a,e,n,t,r,i,o){try{var s=a[i](o),u=s.value}catch(a){return void n(a)}s.done?e(u):Promise.resolve(u).then(t,r)}var o,s,u={name:"barang.edit",mixins:[n(71).a],methods:{save:(o=r.a.mark((function a(){var e,n,t=this;return r.a.wrap((function(a){for(;;)switch(a.prev=a.next){case 0:return this.loading=!0,e="pengajuan/"+this.$route.params.id,(n=new FormData).append("total",this.total),n.append("tujuan_pengadaan",this.tujuan_pengadaan),n.append("keterangan",this.keterangan),n.append("tempat_pembelian",this.tempat_pembelian),n.append("perkiraan_harga",this.perkiraan_harga),n.append("_method","PUT"),a.next=11,this.axios.post(e,n,this.config).then((function(a){t.setSnakbar({status:!0,pesan:a.data.message,color_snakbar:"success"}),t.$router.go(-1)})).catch((function(a){400==a.response.status?t.setSnakbar({color_snakbar:"red",status:!0,pesan:a.response.data.message}):t.setSnakbar({status:!0,color_snakbar:"red",pesan:"Terjadi Kesalahan"}),console.log(a.response)}));case 11:this.loading=!1;case 12:case"end":return a.stop()}}),a,this)})),s=function(){var a=this,e=arguments;return new Promise((function(n,t){var r=o.apply(a,e);function s(a){i(r,n,t,s,u,"next",a)}function u(a){i(r,n,t,s,u,"throw",a)}s(void 0)}))},function(){return s.apply(this,arguments)}),go:function(){var a=this,e="pengajuan/"+this.$route.params.id+"/edit";this.axios.get(e,this.config).then((function(e){var n=e.data.pengajuan;a.barang=n.nama_barang,a.perkiraan_harga=n.perkiraan_harga,a.keterangan=n.keterangan,a.tempat_pembelian=n.tempat_pembelian,a.total=n.total,a.tujuan_pengadaan=n.tujuan_pengadaan,a.date_pengajuan=n.tanggal_pengajuan})).catch((function(a){return console.log(a.response)}))}},created:function(){this.go()}},l=n(2),c=Object(l.a)(u,(function(){var a=this,e=a.$createElement,n=a._self._c||e;return n("v-app",[n("v-container",[n("BtnJudul",{attrs:{text:"Edit Pengajuan Barang"}}),a._v(" "),n("v-card",{style:a.border,attrs:{tile:""}},[n("v-card-text",[n("v-container",[n("v-form",{ref:"form",attrs:{"lazy-validation":a.lazy},model:{value:a.valid,callback:function(e){a.valid=e},expression:"valid"}},[n("v-text-field",{attrs:{outlined:"",rules:a.nameRules,label:"Nama barang",required:"",disabled:""},model:{value:a.barang,callback:function(e){a.barang=e},expression:"barang"}}),a._v(" "),n("v-text-field",{attrs:{outlined:"",rules:a.perkiraanRules,label:"Perkiraan Harga",required:""},model:{value:a.harga,callback:function(e){a.harga=e},expression:"harga"}}),a._v(" "),n("v-text-field",{attrs:{outlined:"",rules:[a.numberRule],label:"Total",required:""},model:{value:a.total,callback:function(e){a.total=e},expression:"total"}}),a._v(" "),n("v-textarea",{attrs:{outlined:"",rules:a.nameRules,label:"Tujuan Pengadaan"},model:{value:a.tujuan_pengadaan,callback:function(e){a.tujuan_pengadaan=e},expression:"tujuan_pengadaan"}}),a._v(" "),n("v-textarea",{attrs:{outlined:"",rules:a.nameRules,label:"Keterangan"},model:{value:a.keterangan,callback:function(e){a.keterangan=e},expression:"keterangan"}}),a._v(" "),n("v-text-field",{attrs:{outlined:"",label:"tempat_pembelian",required:""},model:{value:a.tempat_pembelian,callback:function(e){a.tempat_pembelian=e},expression:"tempat_pembelian"}}),a._v(" "),n("v-row",[n("v-col",{attrs:{cols:"12",align:"right"}},[n("v-btn",{attrs:{disabled:!a.valid,color:"success",tile:"",loading:a.loading},on:{click:function(e){return a.save()}}},[a._v("\n                            Simpan\n                            ")])],1)],1)],1)],1)],1),a._v(" "),n("v-card-actions",{})],1)],1)],1)}),[],!1,null,"8988ccc0",null);e.default=c.exports},71:function(a,e,n){"use strict";var t=n(0),r=n(7);function i(a,e){var n=Object.keys(a);if(Object.getOwnPropertySymbols){var t=Object.getOwnPropertySymbols(a);e&&(t=t.filter((function(e){return Object.getOwnPropertyDescriptor(a,e).enumerable}))),n.push.apply(n,t)}return n}function o(a,e,n){return e in a?Object.defineProperty(a,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):a[e]=n,a}e.a={data:function(){return{valid:!0,lazy:!1,loading:!1,barang:"",perkiraan_harga:0,total:"",tujuan_pengadaan:"",tempat_pembelian:"",keterangan:"",nameRules:[function(a){return!!a||"Tidak Boleh Kosong"}],perkiraanRules:[function(a){return!!a||"Harus diisi"},function(a){return/^[0-9,]+$/.test(a)||"Format salah"},function(a){return a.split(",").join("")<=1e8||"Tidak boleh lebih dari 100 juta"}],numberRule:function(a){return 0==!a||(!isNaN(parseFloat(a))&&a>=0&&a<=999||"Number has to be between 0 and 999")}}},methods:function(a){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?i(Object(n),!0).forEach((function(e){o(a,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(a,Object.getOwnPropertyDescriptors(n)):i(Object(n)).forEach((function(e){Object.defineProperty(a,e,Object.getOwnPropertyDescriptor(n,e))}))}return a}({},Object(t.b)({setSnakbar:"snakbar/setSnakbar"}),{formatAsCurrency:function(a,e){return e=e||0,null===a?null:""+a.toFixed(e).replace(/(\d)(?=(\d\d\d)+(?!\d))/g,"$1,")}}),mixins:[r.a],computed:{harga:{get:function(){return this.formatAsCurrency(this.perkiraan_harga,0)},set:function(a){this.perkiraan_harga=Number(a.replace(/[^0-9\.]/g,""))}}},created:function(){}}}}]);