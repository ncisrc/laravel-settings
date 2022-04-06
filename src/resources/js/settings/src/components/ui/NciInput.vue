<template>
  <div class="NciComponent NciInput">
    <n-input v-model:value="value" type="text" :placeholder="placeholder" />
  </div>
</template>

<script>
import { NInput } from "naive-ui";

export default {
  components: {
    NInput,
  },
  props: {
    value: String,
    placeholder: String,
  },
};
</script>