<template>
  <div>
      <the-card v-for="post of posts" :key="post.id" :post='post'/>
  </div>
 
</template>  
<script>
import axios from 'axios';
import TheCard from '../components/TheCard.vue';
export default 
{ components: 
    {TheCard}, 
    data(){
      return{
        posts: [],
      }

    },
    methods: {
      fetchPosts(){
        axios.get('/api/posts').then((resp)=>{
          console.log(resp.data);
          this.posts = resp.data;
        })
      },
    },
    mounted(){
      this.fetchPosts();
    }
};
</script>  

<style>

</style>