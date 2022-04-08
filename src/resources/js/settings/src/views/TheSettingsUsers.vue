<template>
  <div>
    <nci-input v-model:value="search" type="text" placeholder="search" />
    <nci-select v-model:value="select" placeholder="Choix de l'utilisateur" />

    <nci-settings-tree :pathItems="pathItems" />
  </div>
</template>

<script>
import {
  NciInput,
  NciSelect
} from "@/components/ui/NciUI";

import {
  NciSettingsTree
} from "@/components/NciSettings";

import { mapState } from 'pinia';
import { useSettings } from '@/business/stores/useSettings'

export default {
  components: {
    NciInput,
    NciSelect,
    NciSettingsTree,
  },

  computed: {
    ...mapState(useSettings, {pathItems: 'settingsPath'}),
  },

  data() {
    return {
      search: "",
      select: null,
    };
  },
};
</script>
