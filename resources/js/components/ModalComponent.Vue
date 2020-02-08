<template>
 <div class="row">
   <div class="col-12">
<h1>Componente Hijo 3</h1>
<h6>{{numero}}</h6>
<h6>{{VariableGlobal}}</h6>
<button @click="sumarglobal();"> aumentar</button>
<button @click="restarglobal();"> restar</button>


<button @click="traerarraycategoria();"> TraerCategoria</button>


   </div>
  
 </div>
  
</template>
<script>
 	import {mapState, mapMutations} from 'vuex';
    export default {
 data () {
   return  { mensaje12: 'Mensaje del hijo modal'}
   },
   props: ['numero'],

 

    computed:{
             ...mapState(['VariableGlobal'])

         },
  methods:{
      sumarglobal(){
        this.$store.commit('AumentarGlobal');
      },
        restarglobal(){
        this.$store.commit('DisminuirGlobal');
      },
      traerarraycategoria(){
       //  ...mapActions(['loadCategoriasAsync'])
          this.$store.dispatch({type:'loadCategoriasAsync'});
      },

     
   },

		created(){
           // this.$store.dispatch({type:'loadCategoriasAsync'});
	    },
 mounted(){
    this.$emit('datohijo',this.mensaje12);
  }

 

    }
  

</script>

