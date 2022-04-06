<template>
  <div>
    <nci-input :value="search" type="text" :placeholder="search" />
    <nci-select :value="select" placeholder="Choix de l'utilisateur" />
    <nci-settings-tree />

  </div>
</template>

<script>
import NciInput from "../components/ui/NciInput.vue";
import NciSelect from "../components/ui/NciSelect.vue";
import NciTree from "../components/ui/NciTree.vue";
import NciSettingsInput from "../components/NciSettingsInput.vue";
import NciSettingsTree from "../components/NciSettingsTree.vue";
import NciSettingsSelect from "../components/NciSettingsSelect.vue";
import NciSettingsSwitch from "../components/NciSettingsSwitch.vue";

export default {
  components: {
    NciInput,
    NciSelect,
    NciTree,
    NciSettingsInput,
    NciSettingsTree,
    NciSettingsSelect,
    NciSettingsSwitch,
  },

  data() {
    return {
      search: "",
      select: null,

      setting: {
        title: "coucou",
        path: "10",
        description: "hello",
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
      },
    };
  },
};
</script>
