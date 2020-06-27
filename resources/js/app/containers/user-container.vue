<template>
  <div>
    <form-component ref="form" method="post" @onSubmit="handleOnSubmit" v-slot="{ hasSubmit }">
      <input-component :loading="hasSubmit" v-model="name" />
    </form-component>
    <div class="mt-5">
      <ul>
        <list-component v-for="user in users.results" :key="user.id">{{user.name}}</list-component>
      </ul>
    </div>
    <div>
      <paginator-simple
        label="Fetching users"
        @click="handleOnPaginator"
        v-if="users.paginator.hasMorePages"
      />
    </div>
  </div>
</template>
<script>
import ListComponent from "../components/list-component";
import FormComponent from "../components/form-component";
import InputComponent from "../components/input-component";
import PaginatorSimple from "../components/paginators/simple-component";

import gpl from "graphql-tag";

export default {
  name: "user-container",
  components: {
    "list-component": ListComponent,
    "form-component": FormComponent,
    "input-component": InputComponent,
    "paginator-simple": PaginatorSimple
  },
  methods: {
    /**
     * paginator fetch more..
     */
    async handleOnPaginator({ target }) {
      target.classList.add("is-loading");
      const current = ++this.paginator.current;
      const limit = this.paginator.per_page * current;

      await this.$apollo.queries.users.fetchMore({
        variables: {
          first: limit,
          page: 1
        },
        updateQuery: (prevResult, { fetchMoreResult: { users } }) => {
          const newUsers = users.results;
          const paginator = users.paginator;

          return {
            users: {
              __typename: prevResult.users.__typename,
              results: newUsers,
              paginator
            }
          };
        }
      });
      target.classList.remove("is-loading");
    },
    async handleOnSubmit(ev) {
      await this.$apollo.mutate({
        mutation: gpl`
          mutation createUser($name: String!, $email: String!, $password: String!) {
            createUser(name: $name, email: $email, password: $password)
          }
        `,
        variables: {
          name: this.name,
          email: `${this.name}@mail.com`,
          password: "123"
        }
      });

      // reset form
      ev.target.reset();
      this.$refs.form.completed();
    }
  },
  data: () => ({
    users: {},
    name: "",
    paginator: {
      current: 1,
      total_page: 0,
      per_page: 3
    }
  }),
  apollo: {
    users: {
      query: gpl`      
        query users($first: Int!, $page: Int!) {
          users(first: $first, page: $page) {
            results:data {
              id
              name
            }
            paginator:paginatorInfo {            
              currentPage
              total
              perPage
              hasPages:hasMorePages
            }
          }
        }`,
      variables: {
        first: 3,
        page: 1
      }
    }
  }
};
</script>