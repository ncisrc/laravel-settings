<template>
    <n-select
      v-model:value="value"
      :multiple="multiple"
      :filterable="filterable"
      :options="options"
      :placeholder="placeholder"
    />
</template>

<script>
import { NSelect } from "naive-ui";

export default {
  components: {
    NSelect,
  },
  props: {
    options: Array,
    multiple: Boolean,
    filterable: Boolean,
    placeholder: String,
  },
};
</script>