<template>
  <div class="NciComponent NciSwitch">
    {{ title }}
    {{ path }}
    {{ description }}

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
    title: String,
    description: String,
    path: String,
    value: Boolean,
  },
};
</script>