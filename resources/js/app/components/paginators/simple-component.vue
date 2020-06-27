<template>
  <button class="button is-dark is-fullwidth" @click="handleOnClick">{{label}}</button>
</template>

<script>
export default {
  name: "paginator_simple-component",
  props: {
    label: {
      type: String,
      default: "Fetch data"
    }
  },
  methods: {
    handleOnClick(ev) {
      this.$emit("click", ev);
    }
  }
};
</script>

<style>
</style>