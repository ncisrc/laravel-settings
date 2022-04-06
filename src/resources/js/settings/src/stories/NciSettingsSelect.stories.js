import MyNciSettingsSelect from '../components/NciSettingsSelect';

export default {
  title: 'NciSettingsList/MyNciSettingsSelect',
  component: MyNciSettingsSelect,
};

const Template = (args) => ({
  // Components used in your story `template` are defined in the `components` object
  components: { MyNciSettingsSelect },
  // The story's `args` need to be mapped into the template through the `setup()` method
  setup() {
    // Story args can be spread into the returned object
    return { ...args };
  },
  // Then, the spread values can be accessed directly in the template
  template: '<my-nci-settings-select v-model:value="value"/>',
});

export const NciSettingsSelect = Template.bind({});
NciSettingsSelect.args = {
  value: "",
};
