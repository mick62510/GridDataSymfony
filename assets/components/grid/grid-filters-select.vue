<template>
  <div class="grid grid-cols-2">
    <div class="flex justify-center items-center">
      {{ title }}
    </div>
    <div>
      <select :id="selectId"
              class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
        <option></option>
        <option v-for="(value,valueId) in options" :value="valueId">{{ value }}</option>
      </select>
    </div>
  </div>
</template>

<script>

export default {
  name: "grid-filters-select",
  props: {
    options: Object,
    selectId: String,
    title: String,
  },
}
</script>

<style scoped>

</style>
