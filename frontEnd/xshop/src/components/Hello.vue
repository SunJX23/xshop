<template>
  <div class="hello">
    <a :href="login()">{{ title }}</a>
    <h2>{{ contact }}</h2>
  </div>
</template>

<script>
export default {
  name: 'hello',
  data () {
    return {
      title: 'Welcome to My X-shop App',
      contact: 'sun.23@outlook.com'
    }
  },
  methods: {
    login: function () {
      return window.FRONT_DOMAIN + 'login';
    }
  }
}
</script>

<style scoped>
.hello {
  width: 100%;
  height: 100%;
  text-align:center;
  color: #E5E9F2;
  position: absolute;
}

a {
  margin-top: 25%;
  display: block;
  font-size: 2em;
  font-weight: bold;
  color: #E5E9F2;
}
[is-moblie="1"] a {
  margin-top: 50%;
}

h2 {
  margin-top: 10%;
}
</style>
