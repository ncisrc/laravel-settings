<template>
  <div class="NciComponent NciSelect">
    {{ title }}
    {{ path }}
    {{ description }}

    <n-select
      v-if="multipleSelect"
      v-model:value="value"
      multiple
      :options="options"
    />
    <n-select v-else v-model:value="value" :options="options" />
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
    multipleSelect: Boolean,
  },
};
</script>