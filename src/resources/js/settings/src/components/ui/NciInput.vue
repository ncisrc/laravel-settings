<template>
  <n-input v-model:value="value" type="text" :placeholder="placeholder" @keyup="sendValueUpdate"/>
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

  emits:['update:value'],

  methods:{
    sendValueUpdate() {
      this.$emit('update:value', this.value)
    }
  }
};
</script>
