import MyNciInput from '../components/ui/NciInput';

export default {
  title: 'NciSettingsList/MyNciSettingsInput',
  component: MyNciSettingsInput,
};

const Template = (args) => ({
  // Components used in your story `template` are defined in the `components` object
  components: { MyNciSettingsInput },
  // The story's `args` need to be mapped into the template through the `setup()` method
  setup() {
    // Story args can be spread into the returned object
    return { ...args };
  },
  // Then, the spread values can be accessed directly in the template
  template: '<my-nci-settings-input v-model:value="value"/>',
});

export const NciSettingsInput = Template.bind({});
NciSettingsInput.args = {
  value: "",
};
