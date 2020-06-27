<template>
  <div>
    <section class="hero is-primary">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">Vue js</h1>
          <h2 class="subtitle">GraphQL</h2>
        </div>
      </div>
    </section>
    <div class="container mt-6">
      <div class="columns">
        <div class="column is-4 is-offset-4">
          <user-container></user-container>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import BookContainer from "./containers/user-container";

export default {
  name: "app",
  components: {
    "user-container": BookContainer
  }
};
</script>