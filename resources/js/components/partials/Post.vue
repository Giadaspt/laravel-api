<template>
  <section class="singlePostSection">
    <div class="singlePost">
      <h4> {{postSingle.title}} </h4>
      <p> {{ this.getDate() }} </p>
      <p> {{ postSingle.content }} </p>
    </div>
  </section>
</template>

<script>
export default {
  name: "Post",

  props: {
    "postSingle": Object,
  },

  methods: {
    getDate(){
      let date = new Date (this.postSingle.created_at);
      
      let formatDate = date.toLocaleDateString('it', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
      })

      // let formatDate = 'dd-mm-YYYY'
      //   .replace("2-digit", date.getDay())
      //   .replace('mm', date.getMonth() + 1 )
      //   .replace('YYYY', date.getFullYear());

      return formatDate;
    }
  }
}
</script>

<style lang="sss" scoped>

</style>