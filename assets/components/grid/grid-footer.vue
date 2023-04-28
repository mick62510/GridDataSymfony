<template>
  <div class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5">
    <div class="text-xs+ grid grid-cols-2 gap-2">
      <div v-if="totalPages > 0">
        Page : {{ page }} / {{ totalPages }}
      </div>
      <div>
        Nombre d'éléments totaux : {{ count }}
      </div>
    </div>
    <grid-footer-paginator :page="page" :totalPages="totalPages"></grid-footer-paginator>
  </div>
</template>

<script>
import GridFooterPaginator from "./grid-footer-paginator";

export default {
  name: "grid-footer",
  components: {GridFooterPaginator},
  props: {
    totalPages: {type: Number, default: 0},
    page: {type: Number, default: 1},
    count: {type: Number, default: 0},
  },
}
</script>

<style scoped>

</style>
