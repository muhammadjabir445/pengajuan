(window.webpackJsonp=window.webpackJsonp||[]).push([[32],{250:function(t,e,o){"use strict";o.r(e);o(7);var r=o(0);function c(t,e){var o=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),o.push.apply(o,r)}return o}function n(t){for(var e=1;e<arguments.length;e++){var o=null!=arguments[e]?arguments[e]:{};e%2?c(Object(o),!0).forEach((function(e){l(t,e,o[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(o)):c(Object(o)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(o,e))}))}return t}function l(t,e,o){return e in t?Object.defineProperty(t,e,{value:o,enumerable:!0,configurable:!0,writable:!0}):t[e]=o,t}var s={name:"users",data:function(){return{color:"",swatches:[["#FF0000","#AA0000","#550000"],["#FFFF00","#AAAA00","#555500"],["#00FF00","#00AA00","#005500"],["#00FFFF","#00AAAA","#005555"],["#0000FF","#0000AA","#000055"]],snackbar:!1,text:"My timeout is set to 2000.",timeout:2e3}},methods:n({},Object(r.b)({setColor:"color/setColor"}),{inputColor:function(){this.setColor(this.color);var t=this.color.replace("#","%23");this.axios.get("/setting-color?color=".concat(t)).then((function(t){})).catch((function(t){console.log(t.response)}))}}),computed:n({},Object(r.c)({color_get:"color/color"})),created:function(){this.color=this.color_get}},i=o(2),a=Object(i.a)(s,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("v-app",[o("v-container",[o("v-row",[o("v-col",{attrs:{cols:"12",align:"center"}},[o("v-color-picker",{staticClass:"ma-2",attrs:{"show-swatches":""},on:{input:function(e){return t.inputColor()}},model:{value:t.color,callback:function(e){t.color=e},expression:"color"}})],1)],1)],1)],1)}),[],!1,null,null,null);e.default=a.exports}}]);