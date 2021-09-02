<template>
  <panel-item :field="field">
    <template slot="value">
      <div v-for="(value, index) in field.value" :style="{
        'marginTop': index === 0 ? '0' : '6px'
      }">
          <template v-if="!field.useAsField">
            {{ value[field.labelKey] }}
          </template>
          <template v-else-if="items[value]">
            {{items[value][field.labelKey]}}
          </template>
      </div>
    </template>
  </panel-item>
</template>

<script>
export default {
  props: ['resourceName', 'resourceId', 'field'],
    mounted() {
        if(this.field.useAsField) {
            for( let item of this.field.options ) {
                this.treeFlatten(item);
            }
        }
    },
    data(){
      return {
          items : {}
      }
    },
    methods: {
      treeFlatten(node) {

        this.$set(this.items, node[this.field.idKey], node);

        let items = node[this.field.childrenKey];

        if(Array.isArray(items) && items.length > 0 ) {
            for( let item of items ) {
                this.treeFlatten(item)
            }
        }
      }
    }
}
</script>
