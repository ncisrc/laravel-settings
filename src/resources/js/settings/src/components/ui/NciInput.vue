<template>
  <n-input v-model:value="value" type="text" :placeholder="placeholder" />
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
