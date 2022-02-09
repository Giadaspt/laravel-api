<template>
  <section class="singlePostSection">
    <div class="singlePost">
      <h4> {{postSingle.title}} </h4>
      <p> {{ this.getDate() }} </p>
      <p> {{ cutContent }} </p>
    </div>
  </section>
</template>

<script>
export default {
  name: "Post",

  props: {
    "postSingle": Object,
  },

  computed: {
    cutContent(){
      return this.postSingle.content.substr(0, 75) + '...';
    }
  },

  methods: {
    getDate(){
      let date = new Date (this.postSingle.created_at);
      
      let formatDate = date.toLocaleDateString('it', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
      })

      return formatDate;
    }
  }
}
</script>

<style lang="sss" scoped>

</style>