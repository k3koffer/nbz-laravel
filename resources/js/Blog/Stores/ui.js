// resources/js/Blog/Stores/ui.js
import { defineStore } from 'pinia';

// defineStore('имя_хранилища', { ... })
export const useUiStore = defineStore('ui', {
  // state() — это функция, которая возвращает начальное состояние
  state: () => ({
    isSearchVisible: false,
  }),

  // actions — это методы, которые изменяют состояние
  actions: {
    toggleSearch() {
      this.isSearchVisible = !this.isSearchVisible;
    },
  },
});