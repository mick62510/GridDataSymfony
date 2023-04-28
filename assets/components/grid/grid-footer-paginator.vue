<template>
  <ol class="pagination">
    <li class="rounded-l-full bg-slate-150 dark:bg-navy-500" v-if="this.isNotFirstPage()">
      <button @click="changePage(1)"
              class="flex h-8 w-8 items-center justify-center rounded-full text-slate-500 transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:text-navy-200 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="w-4 h-4">
          <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5"/>
        </svg>
      </button>
    </li>
    <li class="bg-slate-150 dark:bg-navy-500" v-if="this.isNotFirstPage()">
      <button @click="changePage(this.page - 1)"
              class="flex h-8 min-w-[2rem] items-center justify-center rounded-full px-3 leading-tight transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="w-4 h-4">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
        </svg>
      </button>
    </li>
    <li class="bg-slate-150 dark:bg-navy-500" v-for="item in this.initPagesToShow()">
      <button v-if="isSamePage(item)" disabled
              class="flex h-8 min-w-[2rem] items-center justify-center rounded-full bg-primary px-3 leading-tight text-white transition-colors hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
        {{ item }}
      </button>
      <button v-else :data-id="getDataPageId(item)" :disabled="disabledButton(item)" @click="changePage(item)"
              class="flex h-8 min-w-[2rem] items-center justify-center rounded-full px-3 leading-tight transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
        {{ item }}
      </button>
    </li>
    <li class="bg-slate-150 dark:bg-navy-500" v-if="this.isNotLastPage()">
      <button @click="changePage(this.page + 1)"
              class="flex h-8 min-w-[2rem] items-center justify-center rounded-full px-3 leading-tight transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="w-4 h-4">
          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
        </svg>
      </button>
    </li>
    <li class="rounded-r-full bg-slate-150 dark:bg-navy-500" v-if="this.isNotLastPage()">
      <button @click="changePage(this.totalPages)"
              class="flex h-8 w-8 items-center justify-center rounded-full text-slate-500 transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:text-navy-200 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="w-4 h-4">
          <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5"/>
        </svg>
      </button>
    </li>
  </ol>
</template>

<script>

export default {
  name: "grid-footer-paginator",
  props: {
    page: {type: Number},
    totalPages: {type: Number},
  },
  methods: {
    changePage: function (page) {
      this.$parent.$parent.changePage(page);
    },
    getDataPageId(page) {
      return Number.isInteger(page) ? page : '';
    },
    disabledButton(page) {
      return !Number.isInteger(page);
    },
    initPagesToShow() {
      let pagesToShow = [];
      if (this.totalPages < 5) {
        for (let i = 1; i < this.totalPages + 1; i++) {
          pagesToShow.push(i);
        }
      } else if (this.page < 5) {
        pagesToShow = [1, 2, 3, 4, 5, '...'];
      } else if (this.page === this.totalPages) {
        pagesToShow = ['...', this.page - 2, this.page - 1, this.page];
      } else {
        pagesToShow = ['...', this.page - 2, this.page - 1, this.page, this.page + 1];
        if (this.totalPages >= this.page + 2) {
          pagesToShow.push(this.page + 2);
          if (this.totalPages >= this.page + 3) {
            pagesToShow.push('...');
          }
        }
      }

      return pagesToShow;
    },
    isSamePage(page) {
      return this.page === page;
    },
    isNotFirstPage() {
      return this.page > 1;
    },
    isNotLastPage() {
      return this.page < this.totalPages;
    },
  },
}
</script>

<style scoped>

</style>
