<template>
  <div class="col">
    <div class="card post-card">
      <!-- <img :src="post.coverImg ? post.coverImg : 'https://www.logistec.com/wp-content/uploads/2017/12/placeholder.png'" class="card-img-top" alt="..." /> -->
      <img :src="getpostCover(post)" class="card-img-top" alt="..." />
      <div class="card-body">
        <h5 class="card-title">{{ post.title }}</h5>
        <p class="card-text" v-html="post.content"></p>

        <!-- <em>
          Autore: {{ post.user.name }}; Data:
          {{ formatDate(post.created_at) }}
        </em> -->

        <!-- Categoria -->
        <div v-if="post.category">
          <span class="badge rounded-pill bg-primary">
            {{ post.category.code }}
          </span>
        </div>

        <!-- Tags -->
        <div v-if="post.tags">
          <span
            v-for="tag in post.tags"
            :key="tag.id"
            class="badge bg-secondary me-2"
            >{{ tag.name }}</span
          >
        </div>
      </div>

      <!-- <div class="card-footer text-end">
        <router-link :to="{ name:'post.show', params: { post: post.slug } }">Dettagli<i class="fas fa-chevron-right ms-2"></i></router-link>
      </div> -->
    </div>
  </div>
</template>

<script>
//import dayjs from "dayjs";
export default {
  props: {
    post: Object,
  },
  data() {
    return {};
  },
  methods: {
    getpostCover(post) {
      return (
        post.coverImg ??
        "https://www.logistec.com/wp-content/uploads/2017/12/placeholder.png"
      );
    },
    // formatDate(date) {
    //   console.log(date);
    //   return dayjs(date).format("DD/MM/YYYY HH:mm");
    // },
  },
};
</script>
<style lang="scss" scoped>
.post-card {
  min-height: 100%;
  .card-img-top {
    max-height: 250px;
    object-fit: cover;
  }
}
</style>