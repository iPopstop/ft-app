<script>
export default {
  name: 'NotFound',
  metaInfo: {
    title: 'NotFound'
  },
  mounted() {
    document.body.classList.remove('hidden-navigation')
    document.body.classList.add('error-page')
  },
  beforeDestroy() {
    document.body.classList.add('hidden-navigation')
    document.body.classList.remove('error-page')
  }
}
</script>
<template>
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <img class="img-fluid" src="@/assets/images/404.svg" alt="Страница не найдена">
      <h3>Страница не найдена</h3>
      <p class="text-muted">
        Страница, которую Вы ищете, не найдена или недоступна
      </p>
      <router-link :to="{name: 'main'}" class="btn btn-primary">Вернуться на главную</router-link>
    </div>
  </div>
</template>
<style src='@/assets/styles/pages/contacts/index.scss' lang='scss'></style>
