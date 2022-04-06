<template>
  <div class="NciComponent NciSwitch">
    <n-switch v-model:value="value" />
  </div>
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