<script>
import {mapState} from "vuex"

export default {
  name: 'layoutGuest',
  metaInfo: {
    title: 'layoutGuest'
  },
  computed: {
    ...mapState('config', ['is_auth'])
  },
  mounted() {
    document.body.classList.remove('hidden-navigation')
    document.body.classList.add('form-membership')
  },
  /*watch: {
    is_auth: {
      handler() {
        if(this.is_auth) {
          this.$router.push({name: 'main'})
        }
      }
    }
  }*/
}
</script>
<template>
  <div>
    <div class="form-wrapper">
      <transition
        name="fade"
      >
        <router-view :key="`${$route.path}guest`" />
      </transition>
    </div>
  </div>
</template>
<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
  opacity: 0;
}
</style>
