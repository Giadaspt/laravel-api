<template>
  <main class="allPosts">
      <h2>
        Tutti i post
      </h2>

      <Post
        v-for="post in posts"
        :key="post.id"
        :postSingle="post"
      />
      
      <div>
          <button
            @click="getPosts(paginate.current - 1) "
            :disabled = "paginate.current === 1"
          >
          &#60;
          </button>

          <button
            v-for="page in paginate.last"
            :key="page"
            @click="getPosts(page)"
            :disabled = "paginate.current === page"> 
            {{page}}
          </button>

          <button
            @click="getPosts(paginate.current + 1)"
            :disabled = "paginate.current === paginate.last"
          >
            &#62;
          </button>
      </div>
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
      apiUrl: "http://127.0.0.1:8000/api/posts?page=",
      posts: [],
      paginate: {},
    }
  },

  mounted(){
    this.getPosts();
  },

  methods: {
    getPosts(page=1){
      axios.get(this.apiUrl + page)
        .then(res => {
          this.posts = res.data.data;
          this.paginate = {
            current: res.data.current_page,
            last: res.data.last_page
          }
          console.log(this.paginate);
        });
    }
  }
}
</script>

<style scoped lang="scss">

</style>