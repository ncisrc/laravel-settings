<template>
  <div>
    <h1>{{ maintitle }}</h1>
    <NciInput
      :title="title"
      :description="description"
      :path="path"
      :value="value"
    />

    <NciSwitch
      :title="title"
      :description="description"
      :path="path"
      :value="true"
    />

    <NciSelect
      :title="title"
      :description="description"
      :path="path"
      :value="value"
      :options="options"
    />
  </div>
</template>

<script>
import NciInput from "./components/NciInput.vue";
import NciSelect from "./components/NciSelect.vue";
import NciSwitch from "./components/NciSwitch.vue";

export default {
  data() {
    return {
      maintitle: "Nom du Sous-Groupe",
      title: "title",
      path: "path",
      description: "description",
      value: "test",
      options: [
        {
          label: "toto",
          value: "toto",
        },
        {
          label: "tata",
          value: "tata",
        },
        {
          label: "titi",
          value: "titi",
        },
      ],
    };
  },

  components: {
    NciInput,
    NciSelect,
    NciSwitch,
  },
};
</script>

<style >
@import "./App.scss";
</style>