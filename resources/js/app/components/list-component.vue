<template>
  <li class="list-component__list">
    <slot></slot>
  </li>
</template>
<script>
export default {
  name: "list-component"
};
</script>
<style scoped="css">
.list-component__list {
  border: 1px solid #ddd;
  padding: 7px 10px;
  margin-bottom: 10px;
}
</style>