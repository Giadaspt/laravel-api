<template>
  <section class="singlePostSection">
    <div class="singlePost">
      <h4> {{postSingle.title}} </h4>
      <p> {{ postSingle.created_at }} </p>
      <p> {{ postSingle.content }} </p>
    </div>
  </section>
</template>

<script>
export default {
  name: "Post",

  props: {
    "postSingle": Object,
  }
}
</script>

<style lang="sss" scoped>

</style>