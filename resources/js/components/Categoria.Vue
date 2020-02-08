<template>
        <!-- Contenido Principal -->
       <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Categorías
                        <button type="button" class="btn btn-secondary" @click="AbrirModal('categoria','registrar')" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" id="opcion" name="opcion">
                                      <option value="nombre">Nombre</option>
                                      <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="categorias1  in arrayCategoria" :key="categorias1.id">
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm"  @click="AbrirModal('categoria','actualizar',categorias1)" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;

                                        <template v-if="categorias1.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarCategoria(categorias1.id)" >
                                               <i class="icon-trash"></i>
                                        </button>

                                       </template>

                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarCategoria(categorias1.id)" >
                                               <i class="icon-trash"></i>
                                               activar
                                        </button>

                                       </template>

                                        
                                    </td>
                                    <td v-text="categorias1.nombre"></td>
                                    <td  v-text="categorias1.descripcion"></td>
                                    <td>
                                         <div v-if="categorias1.condicion==1">
                                            <span class="badge badge-success">Activo</span>
                                        </div>  
                                         <div v-else>
                                               <span class="badge badge-danger">Desactivado</span>
                                         </div>
                                        
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#">Ant</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">4</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" :class="{'mostrar' : modal}"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="titulomodal">Ag</h4>
                            <button type="button" class="close" @click="CerrarModal();">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre"  id="nombre" name="nombre" class="form-control" placeholder="Nombre de categoría">
                                        <span class="help-block">(*) Ingrese el nombre de la categoría</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="descripcion" id="descripcion" name="descripcion" class="form-control" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div v-show="errorCategoria" class="form-group row div-error">
                                    <div class="text-center text-error">
                                         <div v-for="error in errorCategoriaMensaje" :key="error" v-text="error">

                                         </div>

                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="CerrarModal();">Cerrar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="registrarCategoria();" >Guardar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="actualizarCategoria();">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            <!-- Inicio del modal Eliminar -->
            <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Eliminar Categoría</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Estas seguro de eliminar la categoría?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- Fin del modal Eliminar -->
            

            
        </main>
        <!-- /Fin del contenido principal -->
  


</template>

<script>
    export default {

        data (){
             return {
                 categoriaid:0,
                 nombre : '',
                 descripcion : '',
                 arrayCategoria : [],
                 modal:0, // ocultar o mostrar ventana modal
                 titulomodal :'',
                 tipoAccion: 0 ,
                 errorCategoria : 0,
                 errorCategoriaMensaje : [],
                 pagination:{
                       'total' :0,
                       'current_page' :0,
                       'per_page'  :0,
                       'last_pag'  :0,
                        'from'  :0,
                        'to'  :0,
                 },
                 offset:3,
                criterio : 'nombre',
                buscar : ''
             }

        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },

        methods: {
            listarCategoria (){
               let me=this;
              axios.get('/categoria')

              .then(function (response) {

             // handle success
              console.log(response);
              me.arrayCategoria=response.data;
              })
              .catch(function (error) {
               // handle error
             console.log(error);
             })             
                
            },

            registrarCategoria (){

                if(this.validarCategoria()){
                    return;
                }



                let me=this;
              axios.post('/categoria/Registrar', {
                  nombre: this.nombre,
                 descripcion: this.descripcion
                 })
              .then(function (response) {
               console.log(response);
               me.CerrarModal();
               me.listarCategoria();
               })
               .catch(function (error) {
                console.log(error);
                });             


            },

            actualizarCategoria (){

                if(this.validarCategoria()){
                    return;
                }



                let me=this;
              axios.put('/categoria/Actualizar', {
                  nombre: this.nombre,
                  descripcion: this.descripcion,
                  id : this.categoriaid
                 })
              .then(function (response) {
               console.log(response);
               me.CerrarModal();
               me.listarCategoria();
               })
               .catch(function (error) {
                console.log(error);
                });             


            },


            CerrarModal(){
                this.modal=0;
                this.titulomodal='';
                this.nombre='';
                this.descripcion='';
            },

            desactivarCategoria(idcategoria){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.value) {

                                    let me=this;
                                axios.put('/categoria/desactivar', {
                                    
                                    
                                    id : idcategoria
                                    })
                                .then(function (response) {
                                console.log(response);
                                me.listarCategoria();
                                  Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                    )
                                })
                                .catch(function (error) {
                                    console.log(error);
                                    });   

                        
                    }
                    })
            },

          activarCategoria(idcategoria){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.value) {

                                    let me=this;
                                axios.put('/categoria/activar', {
                                    
                                    
                                    id : idcategoria
                                    })
                                .then(function (response) {
                                console.log(response);
                                me.listarCategoria();
                                  Swal.fire(
                                    'activado!',
                                    'estado activado.',
                                    'success'
                                    )
                                })
                                .catch(function (error) {
                                    console.log(error);
                                    });   

                        
                    }
                    })
            },


            validarCategoria(){
                this.errorCategoria=0;
                this.errorCategoriaMensaje = [];

                if(!this.nombre) this.errorCategoriaMensaje.push('el nombre de la categoria no tiene que estar vacio');
                if(this.errorCategoriaMensaje.length) this.errorCategoria=1;
                

                return this.errorCategoria;
            },


            AbrirModal(modelo,accion, data =[]){
                switch (modelo){
                    case "categoria" :
                        {
                            switch(accion){
                                case "registrar":
                                { 
                                    this.modal=1;
                                    this.nombre='';
                                    this.descripcion='';
                                    this.titulomodal='Registrar Nueva Categoria';
                                    this.tipoAccion=1;
                                    break;

                                }
                                case "actualizar":
                                {  
                                   this.modal=1;
                                   this.titulomodal='Actualizar Categoria';
                                   this.tipoAccion=2;
                                    this.nombre= data.nombre;
                                    this.descripcion=data.descripcion;
                                    this.categoriaid=data.id;
                                   console.log(data);
                                   break;
                                }


                            }


                        }

                }

            }


        },





        mounted() {
            //console.log('Component mounted.')
            this.listarCategoria();
        }
    }



</script>
<style scoped>
 .modal-content{
      width: 100% !important;
      position: absolute !important;
 }
 .mostrar{
     display: list-item !important;
     opacity: 1 !important;
     position : absolute !important;
     background-color: #3c29297a !important;

 }

 .div-error{

     display:flex;
     justify-content: center;
 }

 .text-error{
      color:red !important;
      font-weight: bold;
 }
</style>