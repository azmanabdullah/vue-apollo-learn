<template>
  <form :method="method" @submit.prevent="handleOnSubmit" :action="action" :enctype="enctype">
    {{errors}}
    <slot :hasSubmit="has_submit" :errors="errors"></slot>
  </form>
</template>
<script>
export default {
  name: "form-component",
  data() {
    return {
      has_submit: false,
      errors: []
    };
  },
  props: {
    method: {
      type: String,
      default: "get"
    },
    action: {
      type: String,
      default: ""
    },
    enctype: {
      type: String,
      default: "multipart/form-data"
    }
  },
  methods: {
    handleOnSubmit(ev) {
      this.has_submit = true;
      this.$emit("onSubmit", ev);
    },
    completed() {
      this.has_submit = false;
    }
  }
};
</script>