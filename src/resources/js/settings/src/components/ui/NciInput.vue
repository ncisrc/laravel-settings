<template>
  <InputText v-model:value="value" :placeholder="placeholder" @keyup="sendValueUpdate" />
</template>

<script>
import InputText from 'primevue/inputtext';

export default {
  components: {
    InputText,
  },
  props: {
    value      : String,
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
