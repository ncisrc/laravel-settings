<template>
    <n-tab-pane :name="tab" :tab="tab">
        <slot></slot>
    </n-tab-pane>
</template>

<script>
import { NTabPane } from "naive-ui";

export default {
  components: {
    NTabPane,
  },
  props: {
    tab: String
  },
};
</script>