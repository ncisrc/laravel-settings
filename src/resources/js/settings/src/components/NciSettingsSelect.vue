<template>
  <div class="NciComponent NciSelect">
    {{ title }} 
    {{ path }}
    {{ description }}

    <n-select v-model:value="value" :options="options" />
  </div>
</template>

<script>
import { NSelect } from "naive-ui";

export default {
  components: {
    NSelect,
  },
  props: {
    title: String,
    description: String,
    path: String,
    value: String,
    options: Array,
  },
};
</script>