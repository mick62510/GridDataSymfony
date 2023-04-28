<template>
  <Menu as="div" class="relative inline-block text-left ml-5 z-10">
    <MenuButton
        class="btn space-x-2 bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
      Affichage
      <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5" aria-hidden="true"/>
    </MenuButton>
    <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95"
                enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75"
                leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
      <MenuItems
          class="absolute mt-2 w-56 origin-top-right rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
        <div class="py-1">
          <MenuItem v-for="(column,index) in columns" :hidden="column.isHidden()">
            <button class="block px-4 py-2 hover:bg-gray-100 w-full" @click="traitementColumn(index)">
            <span class="grid grid-rows-1 grid-cols-6">
                 <svg class="w-6 h-6 text-green-600 col-span-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg" v-if="column.isDefault()">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              <div class="col-span-1" v-else></div>
                <span class="text-left col-span-5"> {{ column.getTitle() }}</span>
            </span>
            </button>
          </MenuItem>
        </div>
      </MenuItems>
    </transition>
  </Menu>
</template>
<script>

import {Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue'
import {ChevronDownIcon} from '@heroicons/vue/solid'

export default {
  name: "grid-display-column",
  components: {Menu, MenuButton, MenuItem, MenuItems, ChevronDownIcon},
  props: {
    columns: {type: Object},
  },
  methods: {
    traitementColumn: function (index) {
      this.$emit('update', index);
    },
  },
}
</script>

<style scoped>
</style>
