<script>
import { template, templateSettings } from "lodash";
import _isEmpty from 'lodash/isEmpty'
import lang from "@/locales/validations.js";

// curly brace syntax
templateSettings.interpolate = /{{([\s\S]+?)}}/g;

const TEMPLATES_MAP = lang.validation;

export default {
  props: {
    validations: {
      type: Object,
      default: () => ({})
    },
  },

  computed: {
    errors() {
      if (!this.invalid) {
        return [];
      }

      return !_isEmpty(this.validations) ? Object.keys(this.validations.$params).reduce(
        (errors, validator) => {
          if (!this.validations[validator]) {
            const compiled = template(TEMPLATES_MAP[validator]);

            errors.push(compiled(this.validations.$params[validator]));
          }

          return errors;
        },
        []
      ) : [];
    },

    invalid() {
      return this.validations.$dirty && this.validations.$invalid;
    },
  },

  render() {
    return this.$scopedSlots.default({
      errors: this.errors,
      invalid: this.invalid,
    });
  },
};
</script>
