<template>
  <div><ExampleComponentVue></ExampleComponentVue>
  </div>
</template>  
<script>
import ExampleComponent from '../../../vendor/laravel/ui/src/Presets/vue-stubs/ExampleComponent.vue';
import ExampleComponentVue from "../components/ExampleComponent.vue";
export default 
{ components: 
    { ExampleComponentVue, ExampleComponent } 
};
</script>  

<style>

</style>