<script>
import {mapState} from 'vuex'

export default {
  name: "CouponsIndex",
  data: () => ({
    showCreateForm: false,
    createForm: {
      position_id: null
    }
  }),
  computed: {
    ...mapState('coupon', ['coupons', 'search'])
  },
  methods: {
    loadCoupons() {
      this.$store.dispatch('coupon/index', this.search)
    }
  },
  watch: {
    search: {
      handler() {
        this.loadCoupons()
      },
      deep: true,
      immediate: true
    }
  }
}
</script>
<template>
  <div>
    <div class="page-header d-md-flex justify-content-between align-items-center">
      <div>
        <h3 class="mb-0">Купоны</h3>
      </div>
      <div class="mt-2 mt-md-0">
        <div class="d-inline ml-2">
          <button href="#" class="btn btn-primary" @click="showCreateForm = !showCreateForm">
            <feather type="plus"/>
          </button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 my-2" v-for="coupon in coupons.data" :key="coupon.id">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <span>{{ coupon.type_string }}</span>
              <div class="">
                <button class="btn btn-primary btn-sm">
                  <feather type="edit"/>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <p class="card-text">
              {{ coupon.description }}
            </p>
            <p class="card-text">
              <small class="text-muted">
                {{ coupon.status ? 'Действует' : 'Выключен или закончились коды' }}
              </small>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>