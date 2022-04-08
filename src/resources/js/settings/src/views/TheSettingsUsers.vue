<template>
  <div class = "TheSettingsUsers">
    <nci-input v-model:value="search" type="text" placeholder="search" class="nciInput" />
    <nci-select v-model:value="select" placeholder="Choix de l'utilisateur" class="nciSelect" />
  </div>
  <nci-settings-tree :pathItems="pathItems" class="nciTree"/>
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

<style lang="scss" scoped>
.TheSettingsUsers {
    display: flex;
}

.n-input {
  margin-right: 2rem;
}

.n-tree {
  width: 15%;
}
</style>