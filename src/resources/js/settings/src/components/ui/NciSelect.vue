<template>
    <Dropdown v-model:value="value" :options="options" optionLabel="label" :placeholder="placeholder" />
</template>

<script>
import { NSelect } from "naive-ui";
import Dropdown from 'primevue/dropdown';

export default {
  components: {
    NSelect,
    Dropdown,
  },
  props: {
    value      : String,
    options    : Array,
    placeholder: String,
  },
};
</script>