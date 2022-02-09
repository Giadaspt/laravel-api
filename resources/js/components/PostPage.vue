<template>
  <main class="container">
    <h2>
      Tutti i post
    </h2>
    <Post
       v-for="post in posts"
       :key="post.id"
       :postSingle="post"
    />
  </main>
</template>

<script>
import Post from './partials/Post';

export default {
  name: "PostPage",

  components:{
    Post
  },

  data(){
    return {
      apiUrl: "http://127.0.0.1:8000/api/posts",
      posts: [],
    }
  },

  mounted(){
    this.getPosts();
  },

  methods: {
    getPosts(){
      axios.get(this.apiUrl)
        .then(res => {
          this.posts = res.data;
          console.log(this.posts);
        });
    }
  }
}
</script>

<style scoped lang="scss">

</style>