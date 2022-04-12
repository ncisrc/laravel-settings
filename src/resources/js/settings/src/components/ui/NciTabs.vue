<template>
  <n-tabs type="line" animated>
    <slot></slot>
  </n-tabs>
</template>

<script>
import { NTabs } from "naive-ui";

export default {
  components: {
    NTabs,
  },
};
</script>