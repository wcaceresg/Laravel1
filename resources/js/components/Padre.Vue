<template>
 <div class="row">
   <div class="col-12">
<h1>Componente Hijo</h1>
<h1>{{numero}}</h1>

   </div>
  
 </div>
  
</template>
<script>
	import {mapState, mapMutations} from 'vuex';
    export default {
 data () {
   return  { mensaje12: '55444222'}
   },
   props: ['numero']
    }
</script>

