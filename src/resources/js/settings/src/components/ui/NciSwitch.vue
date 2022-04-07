<template>
  <n-switch v-model:value="value" />
</template>

<script>
import { NSwitch } from "naive-ui";

export default {
  components: {
    NSwitch,
  },
  props: {
    value: String,
  },
};
</script>