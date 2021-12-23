<script>

export default {
  name: 'App',
}
</script>
<template>
  <div>
    <transition
      name="fade"
    >
      <router-view :key="$route.path"/>
    </transition>
  </div>
</template>