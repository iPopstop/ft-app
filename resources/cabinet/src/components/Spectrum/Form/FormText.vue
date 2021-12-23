<script>
import FormGroup from "@/components/Spectrum/Form/FormGroup"
import _has from 'lodash/has'
import ShowError from '@/components/Spectrum/Form/ShowError'
const slugify = require('slugify')

export default {
  name: "FormText",
  components: { FormGroup, ShowError },
  props: {
    validations: {
      type: Object,
      default: () => ({})
    },
    maxSymbols: {
      type: Number,
      default: 5000
    },
    type: {
      type: String,
      default: 'text'
    },
    autocomplete: {
      type: String,
      default: ''
    },
    sid: {
      type: String,
      default: ''
    },
    allowOnly: {
      type: Boolean,
      default: false
    },
    template: {
      type: String,
      default: ""
    },
    label: {
      type: String,
      default: ""
    },
    firstUpper: {
      type: Boolean,
      default: false
    },
    regExp: {
      type: RegExp,
      default: null
    },
    replacement: {
      type: String,
      default: ''
    },
    err: {
      type: String,
      default: "Произошла ошибка"
    },
    placeholder: {
      type: String,
      default: ""
    },
    value: {
      type: [String,Number],
      default: ""
    },
    errorForm: {
      type: [Object],
      default: () => ({})
    },
    propName: {
      type: String,
      default: ""
    }
  },
  data: () => ({
    val: '',
    templates: {
      cyrillicLetters: /[^А-Яа-яЁё]/g,
      cyrillicLettersAndSpace: /[^А-Яа-яЁё ]/g,
      cyrillicAndOther: /[A-Za-z]/g,
      positiveInteger: /^[\D]*|\D*/g
    }
  }),
  methods: {
    formatValue (val) {
      let value = val !== null ? val.toString() : ''
      if(value && this.firstUpper) {
        value = value.split(/\s/).map(function(item){
          return (item.charAt(0).toUpperCase() + item.slice(1))
        }).join(' ')
      }
      if(this.template) {
        return _has(this.templates, this.template) ? value.replace(this.templates[this.template], this.replacement) : value
      }
      return value.replace(this.regExp, this.replacement)
    },
    // update the value of input
    updateValue (val) {
      if(val && val.length > this.maxSymbols) {
        this.val = val.substring(0, this.maxSymbols);
        this.emitInput(this.val)
      }
      if(!val || (val && val.length <= this.maxSymbols)) {
        const formattedValue = this.formatValue(val)
        this.val = formattedValue
        this.emitInput(formattedValue)
      }
    },
    // emit input event
    emitInput (val) {
      this.$emit('update:value', val);
    }
  },
  computed: {
    id() {
      if(this.sid) {
        return this.sid
      }
      if (this.validations) {
        return this.slug + "-f" + this.type
      }
      return ""
    },
    slug () {
      let label = this.label
      return slugify(label.substring(0,20))
    }
  },
  watch: {
    value: {
      handler (value = '') {
        if ((value !== this.val)) {
          this.updateValue(value)
        }
      },
      immediate: true
    }
  }
}
</script>
<template>
  <div>
    <form-group :validations="validations">
      <div class="form-group" slot-scope="{ errors, invalid }">
        <label :for="id">{{ label }}</label>
        <template v-if="type === 'text' || type === 'password'">
          <input :type="type" :autocomplete="autocomplete" :id="id" :placeholder="placeholder || label" class="form-control" :class="{invalid, 'mb-1': errorForm && propName}" v-model="val" @input="updateValue($event.target.value)" />
        </template>
        <template v-else-if="type === 'textarea'">
          <textarea :id="id" :placeholder="placeholder || label" class="form-control" :class="{invalid}" v-model="val" @input="updateValue($event.target.value)" />
        </template>
        <span v-for="error in errors" class="d-flex error font-weight-bold text-danger">{{ error }}</span>
        <template v-if="errorForm && propName">
          <show-error :form="errorForm" :prop="propName" />
        </template>
      </div>
    </form-group>
  </div>
</template>