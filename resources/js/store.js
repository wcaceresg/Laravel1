import Vue from 'vue';
import Vuex from 'vuex';
import Axios from 'axios';

Vue.use(Vuex)
export default new  Vuex.Store({

    state:{
      VariableGlobal:1250,
      arrayCategoria : [],
      Urlweb:'',

    },

    mutations:{
         SET_URL (state , data) {
            state.Urlweb = data;
          },
          GET_ARRAY_CATEGORIA (state,data) {
            state.arrayCategoria = data.categorias;
            
         },

         AumentarGlobal(state){
             state.VariableGlobal ++  ;
         },

         okglobal(state){
            state.VariableGlobal ++  ;
        },
         
         DisminuirGlobal(state){
             state.VariableGlobal= state.VariableGlobal-1;
        },



    },
    actions : {
        async loadCategoriasAsync({commit,state},data) {
            try {
               let response = await fetch(
                 state.Urlweb+'categoriaarray',
               );
               let responseJson = await response.json();
               console.log(responseJson);
               commit('GET_ARRAY_CATEGORIA',responseJson)
             } catch (error) {
               console.error(error);
             }
         }

    }


});


