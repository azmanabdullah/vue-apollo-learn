<template>
  <div class="field">
    <div class="control" :class="loading && 'is-loading'">
      <input
        class="input"
        :value="value"
        :type="type"
        placeholder="..."
        @keydown="onChange"
        @input="onInput"
        required
      />
    </div>
    <!-- <span class="is-block mt-1 px-2 py-1 is-radius has-text-white has-background-danger">Error</span> -->
  </div>
</template>
<script>
export default {
  name: "input-component",
  props: {
    loading: {
      type: Boolean,
      default: false
    },
    value: {
      type: String
    },
    type: {
      type: String,
      default: "text"
    }
  },
  data: () => ({
    valid: false
  }),
  methods: {
    onChange() {
      this.$emit("onChange");
    },
    onInput({ target }) {
      this.$emit("input", target.value);
    }
  }
};
</script>

<style lang="css" scoped>
.is-radius {
  border-radius: 3px;
}
</style>
