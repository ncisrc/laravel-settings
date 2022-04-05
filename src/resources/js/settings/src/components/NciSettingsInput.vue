<template>
  <div class="NciComponent NciInput">
    {{ title }} 
    {{ path }}
    {{ description }}

    <n-input v-model:value="value" type="text" placeholder="Basic Input" />
  </div>
</template>

<script>
import { NInput } from "naive-ui";

export default {
  components: {
    NInput,
  },
  props: {
    title: String,
    description: String,
    path: String,
    value: String,
  },
};
</script>