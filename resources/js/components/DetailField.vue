<template>
  <panel-item :field="field">
    <template slot="value">
      <div v-for="(value, index) in field.value" :style="{
        'marginTop': index === 0 ? '0' : '6px'
      }">
        {{ value[field.labelKey] }}
      </div>
    </template>
  </panel-item>
</template>

<script>
export default {
  props: ['resourceName', 'resourceId', 'field']
}
</script>
