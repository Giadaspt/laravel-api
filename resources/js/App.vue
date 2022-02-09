<template>
  <div class="container-fluid">

  <Header/>

  <PostPage />

  <Footer/>


  </div>
</template>

<script>
import Header from './components/partials/Header';
import Footer from './components/partials/Footer';
import PostPage from './components/PostPage';


export default {
  name: "App",

  components: {
    Header,
    Footer,
    PostPage,
  }
}
</script>

<style scoped lang="scss">


</style>