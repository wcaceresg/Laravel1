    
    @extends('principal')
    @section('contenido')
      
    <template v-if="menu==0">
    
    </template> 
 

    <template v-if="menu==1">
      <categoria></categoria>
      
    </template> 
    
    <template v-if="menu==2">
    <categoria2></categoria2>
    
    </template> 

    <template v-if="menu==3">
    <categoria3></categoria3>
    
    </template> 



@endsection        