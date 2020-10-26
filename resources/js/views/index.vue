<template>
    <v-slide-y-transition mode="out-in">
          <router-view></router-view>
    </v-slide-y-transition>
</template>
<style lang="css">
    .table {
      border-collapse: collapse;

  }
    table, th, td {
    border: 1px solid #efefef;
    }
  /* .table tr td, .table tr th {
      padding: 10px;
      text-align: left;
  }
    .table tr th {
        background-color:#f5f5f5;
        color: black;
    } */
</style>
