import MyNciSelect from '../components/ui/NciSelect';

export default {
  title: 'NciSettingsList/MyNciSelect',
  component: MyNciSelect,
};

const Template = (args) => ({
  // Components used in your story `template` are defined in the `components` object
  components: { MyNciSelect },
  // The story's `args` need to be mapped into the template through the `setup()` method
  setup() {
    // Story args can be spread into the returned object
    return { ...args };
  },
  // Then, the spread values can be accessed directly in the template
  template: '<my-nci-select v-model:value="value" :multiple="multiple" :filterable="filterable" :options="options" :placeholder="placeholder"/>',
});

export const NciSelect = Template.bind({});
NciSelect.args = {
  value: "test",
  multiple: false,
  filterable: false,
  options: "test",
  placeholder: "placeholder",
};
