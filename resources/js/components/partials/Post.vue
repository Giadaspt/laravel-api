<template>
  <section class="singlePostSection">
    <div class="singlePost">
      <h4> {{postSingle.title}} </h4>
      <p
        v-if="postSingle.category" >
        {{ postSingle.category.name }}
      </p>
      <div>
        <span
        v-for="tag in postSingle.tags"
        :key="`${tag.id}`">
        {{tag.name}}
        </span>
      </div>
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
      return this.postSingle.content.substr(0, 100) + '...';
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